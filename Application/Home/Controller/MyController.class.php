<?php
namespace Home\Controller;
use Think\Controller;
class MyController extends NavController{
    public function __construct(){
        parent :: __construct();
        //进入个人中心之前判断用户有没有登录，如果没有登录，就跳转到登录的界面
        $member_id = session('m_id');
        if(!$member_id){
            //把要跳回的地址存入session
            session('returnUrl',U('My/'.ACTION_NAME));
            redirect(U('Member/login'));
        }
    }
    public function order(){
        $data = D('Admin/Order')->search();
        $this->assign(array(
            'data' => $data,
            '_page_title' => '个人中心-我的订单',
            '_show_nav'   => 0,
        ));
        $this->display();
    }
}