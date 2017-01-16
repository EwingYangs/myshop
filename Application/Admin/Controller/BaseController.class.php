<?php
namespace Admin\Controller;
use Think\Controller;
class BaseController extends Controller 
{
    public function __construct(){
        //调用父类的构造函数
        parent :: __construct();
        //判断session登录状态
        if(!session('id')){
            $this->error('必须先登录！',U('Login/login'));
        }
        //默认都可以登录到首页
        if(CONTROLLER_NAME == 'Index'){
            return true;
        }
        if(!D('privilege')->chkPri()){
            //默认跳回上一个页面
            $this->error('无权访问！');
        }
    }
}