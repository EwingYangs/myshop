<?php
namespace Admin\Controller;
class IndexController extends BaseController{
    public function index(){
        $this->display();
    }
    public function top(){
        //C函数使得头部不要跟踪信息
        C('SHOW_PAGE_TRACE',false);
        $this->display();
    }
    public function menu(){
        //分配显示的数据
        $btns = D('privilege')->getBtn();
        $this->assign('btns',$btns);
        $this->display();
    }
    public function main(){
        $this->display();
    }
}