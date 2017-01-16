<?php
namespace Home\Controller;
use Think\Controller;
class OrderController extends Controller{
    public function add(){
        $member_id = session('m_id');
        if(!$member_id){
            //把要跳回来的页面传进session中
            session('returnUrl',U('Order/add'));
            $this->redirect('Member/login');
        }
        //取出购物车的数据之前，因为购物车中的数据可以修改，所以要更新购物车中的
        
        
        if(IS_POST && isset($_POST['ab'])){
            $model = D('Admin/Order');
            if($model->create(I('post.'),1)){
                if($order_id = $model->add()){
                    //把订单号传给alipay
                    $order_sn = D('order')->field('order_sn')->find($order_id);
                    $this->success('下订单成功！',U('order_success?order_id='.$order_sn['order_sn']));
                    exit;
                }
            }
            $this->error('下单失败！原因是：'.$model->getError());
        }
        
        if(isset($_POST['ac']) && $_POST['ac'] == 'number'){
            if(!D('Cart')->checkNumber()){
                //如果库存不足就跳回到购物车页面
                $this->error(D('Cart')->getError());
            }
        }
        $data = D('Cart')->getCartList();
        $this->assign(array(
            'data' => $data,
            '_page_title' => '订单确认页',
            '_page_keywords' => '订单确认页',
            '_page_description' => '订单确认页',
            '_show_nav'   => 0,
        ));
        $this->display();
    }

    public function order_success(){
         $btn = builtAlipayBtn(I('get.order_id'));
         $this->assign(array(
            'btn' => $btn,
            'data' => $data,
            '_page_title' => '订单生成页',
            '_page_keywords' => '订单生成页',
            '_page_description' => '订单生成页',
            '_show_nav'   => 0,
        ));
        $this->display();
    }
    public function receive(){
        //接受支付成功返回的消息
        require('./alipay/notify_url.php');
    }
}