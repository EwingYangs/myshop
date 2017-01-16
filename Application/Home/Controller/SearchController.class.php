<?php
namespace Home\Controller;
use Think\Controller;
class SearchController extends NavController{
   public function cat_search(){
       $cat_model = D('Admin/Category');
       
       $parent_cat = $cat_model->getParent(I('get.id'));
       $parent_cat = array_reverse($parent_cat);
       $data = D('Admin/Goods')->cat_search(I('get.id'));
       
       //根据取出来的商品id求出筛选信息
       $info = $cat_model->getSearchInfo($data['goods_id']);
       
       $config = C('IMAGE_CONFIG');
       $viewPath = $config['viewPath'];
       //取出新品还有热卖
       $nGoods = D('Admin/Goods')->getNewGoods();
       $hGoods = D('Admin/Goods')->getHotGoods();
       $this->assign(array(
           'parent_cat' => $parent_cat,
           'nGoods'   => $nGoods,
           'hGoods'   => $hGoods,
           'viewPath' => $viewPath,
           'data' => $data['data'],
           'page' => $data['page'],
           'info' => $info,
           '_page_title' => '分类搜索页',
           '_page_keywords' => '分类搜索页',
           '_page_description' => '分类搜索页',
           '_show_nav'   => 0,
       ));
       $this->display();
   }
   
   
   public function key_search(){
       $cat_model = D('Admin/Category');
       $data = D('Admin/Goods')->key_search(I('get.key'));
        
       //根据取出来的商品id求出筛选信息
       $info = $cat_model->getSearchInfo($data['goods_id']);
        
       $config = C('IMAGE_CONFIG');
       $viewPath = $config['viewPath'];
       //取出新品还有热卖
       $nGoods = D('Admin/Goods')->getNewGoods();
       $hGoods = D('Admin/Goods')->getHotGoods();
       $this->assign(array(
           'nGoods'   => $nGoods,
           'hGoods'   => $hGoods,
           'viewPath' => $viewPath,
           'data' => $data['data'],
           'page' => $data['page'],
           'parent_cat' => $parent_cat,
           'info' => $info,
           '_page_title' => '分类搜索页',
           '_page_keywords' => '分类搜索页',
           '_page_description' => '分类搜索页',
           '_show_nav'   => 0,
       ));
       $this->display();
   }
}