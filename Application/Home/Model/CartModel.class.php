<?php
namespace Home\Model;
use Think\Model;
class CartModel extends Model 
{
	protected $insertFields = 'goods_id,goods_attr_id,goods_number';
	protected $_validate = array(
		array('goods_id', 'require', '必须选择商品！', 1),
		array('goods_number', 'chkGoodsNumber', '库存量不足！', 1, 'callback'),
	);
	public function chkGoodsNumber($goods_number){
	    $goods_attr_id = I('post.goods_attr_id');
	    //升序排列
	    sort($goods_attr_id,SORT_NUMERIC);
	    $goods_attr_id = (string)implode(',', $goods_attr_id);
	    $gn = D('goods_number')
	    ->field('goods_number')
	    ->where(array(
	        'goods_id' => I('post.goods_id'),
	        'goods_attr_id' => $goods_attr_id,
	    ))->find();
	    return ($gn['goods_number'] >= $goods_number);
	}
	
	//***************重写父类的add方法，因为add方法要分两种情况，一种是没有登录的时候，放到cookie中，一种是已经登录了，放到数据库中
	public function add(){
	    $member_id = session('m_id');
	    sort($this->goods_attr_id,SORT_NUMERIC);
	    $this->goods_attr_id = (string)implode(',', $this->goods_attr_id);
	    if($member_id){
	        //判断有没有这条数据
	        $has = D('cart')->field('id')
	        ->where(array(
	           'member_id' => $member_id,
	           'goods_id' => $this->goods_id,
	           'goods_attr_id' => $this->goods_attr_id,
	        ))->find();
	        if($has){
	            //如果有这条数据就在库存量中加
	            $this->where(array(
	                'id' => array('eq',$has['id']),
	            ))->setInc('goods_number',$this->goods_number);
	        }else{
	            //如果没有这条数据，就插入到数据库中
	            parent :: add(array(
	                'member_id' => $member_id,
	                'goods_id' => $this->goods_id,
	                'goods_attr_id' => $this->goods_attr_id,
	                'goods_number' => $this->goods_number,
	            ));
	        }
	    }else{
	        //放cookie
	        $cart = isset($_COOKIE['cart']) ? unserialize($_COOKIE['cart']) : array();
	        //拼装下标
	        $k = $this->goods_id."-".$this->goods_attr_id;
	        if(isset($cart[$k])){
	            //增加库存
	            $cart[$k] += $this->goods_number; 
	        }else{
	            $cart[$k] = $this->goods_number;
	            //加入cookie
	        }
	        setcookie('cart',serialize($cart),time()+30*86400,'/');
	    }
	    return true;
	}
	public function moveDatatoDb(){
	    $member_id = session('m_id');
	    if($member_id){
	        $cart = isset($_COOKIE['cart']) ? unserialize($_COOKIE['cart']) : array();
	        foreach($cart as $k=>$v){
	            $_k = explode('-', $k);
	            $has = D('cart')->field('id')
	            ->where(array(
	                'member_id' => $member_id,
	                'goods_id' => $_k[0],
	                'goods_attr_id' => $_k[1],
	            ))->find();
	            if($has){
	                //如果有这条数据就在库存量中加
	                $this->where(array(
	                    'id' => array('eq',$has['id']),
	                ))->setInc('goods_number',$v);
	            }else{
	                //如果没有这条数据，就插入到数据库中
	                parent :: add(array(
	                    'member_id' => $member_id,
	                    'goods_id' => $_k[0],
	                    'goods_attr_id' => $_k[1],
	                    'goods_number' => $v,
	                ));
	            }  
	        }
	        //清除cookie
	        setcookie('cart','',time()-1,'/');
	    }
	}
	
	//*****************取出购物车中列表的信息*******************
	public function getCartList(){
	    $member_id = session('m_id');
	    if($member_id){
	        //如果登录了就从数据库中取出
	        $data = $this->where(array(
	            'member_id' => array('eq',$member_id),
	        ))
	        ->select();
	    }else{
	        $_data = isset($_COOKIE['cart']) ? unserialize($_COOKIE['cart']) : array();
	        //一维数组转二维,转换成跟从数据库中取出的$data一样的格式
	        $data = array();
	        foreach($_data as $k=>$v){
	             $_k = explode(',', $k);
	             $data[] = array(
	                 'goods_id' => $_k[0],
	                 'goods_attr_id' => $_k[1],
	                 'goods_number' => $v,
	             );
	        }
	    }
	    $goods_model = D('Admin/Goods');
	    $goods_attr_model = D('goods_attr');
	    //取出商品的信息
	    foreach($data as $k=>&$v){
	        //取出每件商品的名字和图片
	        $info = $goods_model->field('goods_name,mid_logo')->find($v['goods_id']);
	        $v['goods_name'] = $info['goods_name'];
	        $v['mid_logo'] = $info['mid_logo'];
	        //取出商品的购买价格
	        $v['price'] = $goods_model->getMemberPrice($v['goods_id']);
	        //如果商品属性存在，则取出属性的名称还有值
	        if($v['goods_attr_id']){
	            $v['gaData'] = $goods_attr_model->alias('a')
	            ->field('a.attr_value,b.attr_name')
	            ->where(array(
	                'a.id' => array('in',$v['goods_attr_id']),
	            ))
	            ->join('LEFT JOIN __ATTRIBUTE__ b on a.attr_id=b.attr_id')
	            ->select();
	        }
	    }
	    return $data;
	}
	public function clear(){
	    $this->where(array(
	        'member_id' => array('eq',session('m_id')),
	    ))->delete();
	}
	//根据id和商品数量判断库存量，然后更新库存量
	public function checkNumber(){
	    $goods_id = I('post.goods_id');
	    $id = I('post.id');
	    $goods_number = I('post.goods_number');
	    $gnModel = D('Goods_number');
	    foreach($id as $k=>$v){
	        //获取商品属性
	        $goods_attr_id = $this->field('goods_attr_id')->find($v);
	        //根据商品属性和id值查询库存
	        $number = $gnModel->field('goods_number')
	        ->where(array(
	            'goods_id' => array('eq',$goods_id[$k]),
	            'goods_attr_id' => array('eq',$goods_attr_id['goods_attr_id']),
	        ))->find();
	        if($number['goods_number'] < $goods_number[$k]){
	            $this->error = '商品库存量不足！';
	            return false;
	        }
	        //如果库存量足就更新购物车信息
	        $this->where(array(
	            'id' => array('eq',$v),
	        ))->save(array(
	           'goods_number' =>  $goods_number[$k],
	        ));
	    }
	    return true;
	}
}