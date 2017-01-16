<?php
namespace Admin\Model;
use Think\Model;
use Tools\PageAjax;
class CommentModel extends Model 
{
	protected $insertFields = array('goods_id','content','star');
	protected $_validate = array(
		array('goods_id', 'require', '参数错误！', 1, 'regex', 3),
	    array('content', 'require', '评论不能为空！', 1, 'regex', 3),
		array('content', '1,200', '评论不能超过 200 个字符！', 1, 'length', 3),
		array('star', '1,2,3,4,5', '分值只能是1-5颗星！', 1, 'in', 3),
	);
	
	// 添加前
	protected function _before_insert(&$data, $option)
	{
		$member_id = session('m_id');
		if(!$member_id){
		    $this->error = '必须先登录！';
		    return false;
		}
		
		
		//插入之前补充值
		$data['member_id'] = $member_id;
		$data['addtime'] = date('Y-m-d H:i:s');
		
	}
	//添加后
	protected  function _after_insert($data, $options){
	    //添加评论后，为商品添加影响
	    $yx_name = I('post.yx_name');
	    $yx_id = I('post.yx_id');
	    if($yx_id){
	        //循环增加
	        foreach($yx_id as $k=>$v){
	            D('Yinxiang')->where(array(
                    'id' => array('eq',$v),
	            ))
	            ->setInc('yx_count');
	        }
	    }
	    if($yx_name){
	        //转换
	        $yx_name = str_replace('，', ',', $yx_name);
	        $yx_name = explode(',', $yx_name);
	        foreach($yx_name as $k=>$v){
	            $v = trim($v);
	            if(empty($v)){
	                continue;
	            }
	            //如果数据库存在就加一
	            $has = D('Yinxiang')->where(array(
	                'yx_name' => array('eq',$v),
	                'goods_id' => array('eq',$data['goods_id']),
	            ))->find();
	            if($has){
	                D('Yinxiang')->where(array(
	                    'yx_name' => array('eq',$v),
	                    'goods_id' => array('eq',$data['goods_id']),
	                ))->setInc('yx_count');
	            }else{
	                //如果没有就添加
	                D('Yinxiang')->add(array(
	                    'yx_name' => $v,
	                    'goods_id' => $data['goods_id'],
	                    'yx_count' => 1,
	                ));
	            }
	        }
	    }
	}
	
	
	// 取数据
	public function search($pageSize = 10)
	{
	    /**************************************** 搜索 ****************************************/
	    $where = array();
	    $goods_id = I('get.id');
	    $where['a.goods_id'] = array('eq',$goods_id);
        /************************************* 翻页 ****************************************/
        $count = $this->alias('a')->where($where)->count();
        $page = new PageAjax($count);
        // 配置翻页的样式
        //$page->setConfig('prev', '上一页');
        //$page->setConfig('next', '下一页');
        //$data['page'] = $page->show();
        $data['page'] = $page->fpage(array(0,3,4,5,6,7,8));
        $limit = strchr($page->limit," ");
        /************************************** 取数据 ******************************************/
        //如果是首次刷新的页面，也就是没有传递page参数的url地址，就取出好评还有印象
        if(!I('get.page')){
            //先取出好评
            $star = $this->field('star')->where(array(
                'goods_id' => array('eq',$goods_id),
            ))
            ->select();
            //循环$star
            $hao = 0;
            $zhong = 0;
            $cha = 0;
            foreach($star as $v=>$k){
                if($k['star'] == 3){
                    $zhong ++;
                }else if($k['star'] > 3){
                    $hao ++;
                }else{
                    $cha ++;
                }
            }
            $total = count($star);
            //把算出的好评放进$data数组中
            $data['hao'] = round(($hao/$total)*100,2);
            $data['zhong'] = round(($zhong/$total)*100,2);
            $data['cha'] = round(($cha/$total)*100,2);
            
            //取出该商品的印象
            $data['yxData'] = D('Yinxiang')->where(array(
                'goods_id' => array('eq',$goods_id),
            ))->select();
            
        }
        
        $data['data'] = $this
        ->alias('a')
        ->field('a.id,a.content,a.addtime,a.star,a.click_count,b.face,b.username,count(c.id) as reply_count')
        ->where($where)
        ->join('LEFT JOIN __MEMBER__ b on a.member_id=b.id
                LEFT JOIN __COMMENT_REPLY__ c on a.id=c.comment_id')
        ->group('a.id')
        ->order('a.addtime desc')
        ->limit($limit)
        ->select();
        
        
        //如果有回复
        return $data;
	}
	
	/************************************ 其他方法 ********************************************/
}