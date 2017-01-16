<?php
namespace Admin\Model;
use Think\Model;
use Tools\Page;
class OrderModel extends Model 
{
	protected $insertFields = array('shr_name','shr_tel','shr_province','shr_city','shr_area','shr_address');
	protected $updateFields = array('id','shr_name','shr_tel','shr_province','shr_city','shr_area','shr_address');
	protected $_validate = array(
		array('shr_name', 'require', '收货人名字不能为空！', 1, 'regex', 3),
	    array('shr_tel', 'require', '收货人电话不能为空！', 1, 'regex', 3),
	    array('shr_province', 'require', '省份不能为空！', 1, 'regex', 3),
	    array('shr_city', 'require', '城市不能为空！', 1, 'regex', 3),
	    array('shr_area', 'require', '地区不能为空！', 1, 'regex', 3),
	    array('shr_address', 'require', '详细地址不能为空！', 1, 'regex', 3),
	);
	
	//插入前
	protected function _before_insert(&$data, &$options){
	    //***************下单前的检查******************
	    //检查有没有登录
	    $member_id = session('m_id');
	    if(!$member_id){
	        $this->error = '必须先登录！';
	        return false;
	    }
	    //检查有没有商品
	    $options['goods'] = $goods= D('Cart')->getCartList();//存放到$option变量中
	    if(!$goods){
	        $this->error = '必须先选择商品！';
	        return false;
	    }
	    
	    //检查库存之前要加锁，解决并发的问题
	    $this->fp = fopen('./order.lock');
	    flock($this->fp, LOCK_EX);
	    
	    //检查库存量是否够,读库存之前加锁，把锁赋予给模型的属性
	    $gnModel = D('goods_number');
	    $total_price = 0;
	    foreach($goods as $k=>$v){
	        $goods_number = $gnModel
	        ->field('goods_number')
	        ->where(array(
	            'goods_id' => array('eq',$v['goods_id']),
	            'goods_attr_id' => array('eq',$v['goods_attr_id']),
	        ))
	        ->find();
	        if($goods_number['goods_number'] < $v['goods_number']){
	            $this->error = '商品'.$v['goods_name'].'库存量不足！';
	            return false;
	        }
	        //统计总价
	        $total_price += $v['price']*$v['goods_number']; 
	    }
	    $data['total_price'] = $total_price;
	    $data['member_id'] = $member_id;
	    $data['addtime'] = time();
	    //生成唯一的订单号
	    $data['order_sn'] = str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT).date('Ymd');
	    
	    //为了确定三张表的操作都能成功：订单基本信息，订单商品表，库存量表
	    $this->startTrans();
	}
	
	//插入后
	protected function _after_insert($data, $option){
	    //插入后向订单商品表插入信息并且减轻库存
	    $ogModel = D('order_goods');
	    $gnModel = D('goods_number');
	    foreach($option['goods'] as $k=>$v){
	        //插入数据
	        $res = $ogModel->add(array(
	            'order_id' => $data['id'],
	            'goods_id' => $v['goods_id'],
	            'goods_attr_id' => $v['goods_attr_id'],
	            'goods_number' => $v['goods_number'],
	            'price' => $v['price'],
	        ));
	        if(!$res){
	            $this->rollback();
	            return false;
	        }
	        
	        //减库存
	        $ret = $gnModel->where(array(
	           'goods_id' => $v['goods_id'],
	           'goods_attr_id' => $v['goods_attr_id'],
	        ))
	        ->setDec('goods_number',$v['goods_number']);
	        if($ret === false){
	            $this->rollback();
	            return false;
	        }
	    }
	    
	    //所有操作都成功提交事务
	    $this->commit();
	    //释放锁
	    flock($this->fp, LOCK_UN);
	    fclose($this->fp);
	    
	    //清空购物车
	    D('Cart')->clear();
	}
	//*************search获取前台订单数据的方法*******************
	public function search($pageSize = 10)
	{
	    /**************************************** 搜索 ****************************************/
	    $where = array();
	    if($brand_name = I('get.brand_name'))
	        $where['member_id'] = array('eq', session('m_id'));
	        $noPayCount = $this->where(array(
	            'member_id' => array('eq',session('m_id')),
	            'pay_status' => array('eq','否')
	        ))->count();
	        /************************************* 翻页 ****************************************/
	        $count = $this->alias('a')->where($where)->count();
	        $page = new Page($count, $pageSize);
	        // 配置翻页的样式
	        //$page->setConfig('prev', '上一页');
	        //$page->setConfig('next', '下一页');
	        //$data['page'] = $page->show();
	        $data['page'] = $page->fpage(array(3,4,5,6,7,8));
	        $limit = strchr($page->limit," ");
	        /************************************** 取数据 ******************************************/
	        $data['data'] = $this
	        ->alias('a')
	        ->field('a.id,a.order_sn,a.shr_name,a.total_price,a.addtime,a.pay_status,group_concat(DISTINCT c.sm_logo) AS logo')
	        ->join('LEFT JOIN __ORDER_GOODS__ b on a.id=b.order_id
	                LEFT JOIN __GOODS__ c on b.goods_id=c.id')
	        ->where($where)
	        ->group('a.id')
	        ->limit($limit)
	        ->select();
	        $data['noPayCount'] = $noPayCount;
	        return $data;
	}
	
	
	
	
	public function setPaid($order_id){
	    //************支付成功后修改订单表中的支付状态还有支付时间*****************
	    $this->where(array(
	        'order_sn' => array('eq',$order_id),
	    ))->save(array(
	        'pay_status' => '是',
	        'pay_time' => time(),
	    ));
	    
	    //************更新会员的积分**************
	    //取出总价
	    $tp = $this->field('total_price,member_id')->find($order_id);
	    M('member')->where(array(
	        'member_id' => array('eq',$tp['member_id']),
	    ))
	    ->setInc('jifen',$tp['total_price']*0.01);
	} 
}