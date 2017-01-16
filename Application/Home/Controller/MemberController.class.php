<?php
namespace Home\Controller;
use Think\Controller;
class MemberController extends Controller{
    public function login(){
        if(IS_POST){
            $model = D('Admin/Member');
            if($model->validate($model->_login_validata)->create()){
                if($model->login()){
                    $url = U('/');
                    if(session('returnUrl')){
                        //如果存在跳回的地址就传进去
                        $url = session('returnUrl');
                        session('returnUrl',null);
                    }
                    $this->success('登录成功！',$url);
                    exit;
                }
            }
            $this->error($model->getError());
        }
        $this->assign(array(
            '_page_title' => '登录',
            '_page_keywords' => '登录',
            '_page_description' => '登录',
            '_show_nav'   => 0,
        ));
        $this->display();
    }
    public function register(){
        if(IS_POST){
            $model = D('Admin/Member');
            if($model->create(I('post.'),1)){
                if($model->add()){
                    $this->success('注册成功',U('login'));
                    exit;
                }
            }
            $this->error($model->getError());
        }
        $this->assign(array(
            '_page_title' => '注册',
            '_page_keywords' => '注册',
            '_page_description' => '注册',
            '_show_nav'   => 0,
        ));
        $this->display();
    }
    public function logout(){
        //session(null);
        session('m_id',null);
        session('m_username',null);
        session('level_id',null);
        session('face',null);
        redirect('login');
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
    public function ajaxConfirm(){
        if(session('m_id')){
            echo json_encode(array(
                'login' => 1,
                'username' => session('m_username'),
            ));
        }else{
            echo json_encode(array(
                'login' => 0,
            ));
        }   
    }
}