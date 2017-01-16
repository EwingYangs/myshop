<?php
namespace Home\Controller;
use Think\Controller;
class CartController extends Controller{
    public function add(){
        if(IS_POST){
            $model = D('Cart');
            if($model->create(I('post.'),1)){
                if($model->add()){
                    $this->success('添加购物车成功！',U('lst'));
                    exit;
                }
            }
            $this->error('添加失败！原因是：'.$model->getError());
        }
    }
   public function lst(){
       $data = D('Cart')->getCartList();
       $this->assign(array(
           'data' => $data,
           '_page_title' => '购物车列表',
           '_page_keywords' => '购物车列表',
           '_page_description' => '购物车列表',
           '_show_nav'   => 0,
       ));
       $this->display();
   }
   public function ajaxGetCart(){
        $data = D('Cart')->getCartList();
        echo json_encode($data);
   }
   public function ajaxDeleteCart(){
       $id = I('get.id');
       //删除这个id的购物车数据
       if(D('Cart')->delete($id)){
           echo 1;
       }
   }
   
   public function ajaxGetCartCount(){
        $member_id = session('m_id');
	    if($member_id){
	        //如果登录了就从数据库中取出
	        $count = D('Cart')->where(array(
	            'member_id' => array('eq',$member_id),
	        ))
	        ->count();
	    }else{
	        $_data = isset($_COOKIE['cart']) ? unserialize($_COOKIE['cart']) : array();
	        //一维数组转二维,转换成跟从数据库中取出的$data一样的格式
	        $count = count($_data);
	    }
	    echo $count;
   }
}