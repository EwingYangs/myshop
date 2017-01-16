<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller{
   public function login(){
       if(IS_POST){
           $model = D('Admin');
           if($model->validate($model->_login_validata)->create()){
               if($model->login()){
                   $this->success('登录成功!',U('Index/index'));
                   exit;
               }
           }
           $this->error($model->getError());
       }
       $this->display();
   }

   public function verifyImg(){
       $cfg = array(
           'imageH'    =>  30 ,               // 验证码图片高度
           'imageW'    =>  145,               // 验证码图片宽度
           'length'    =>  3,               // 验证码位数
           'fontttf'   =>  '4.ttf',              // 验证码字体，不设置随机获取
           'fontSize'  =>  15,              // 验证码字体大小(px)
       );
       //实例化verify对象
       $very = new \Think\Verify($cfg);//完全限定名称方式
       $very->entry();
   }
   public function logout(){
       //清除session
       session('id',null);
	   session('username',null);
       redirect('login');
   }
}