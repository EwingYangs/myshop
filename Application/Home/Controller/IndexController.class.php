<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends NavController{
    public function index(){
        $pGoods = D('Admin/Goods')->getPromoteGoods();
        $rGoods = D('Admin/Goods')->getRecGoods();
        $nGoods = D('Admin/Goods')->getNewGoods();
        $hGoods = D('Admin/Goods')->getHotGoods();
        $fData = D('Admin/Category')->floorData();
        //var_dump($fData);die;
        $this->assign(array(
            'fData'   => $fData,
            'pGoods'   => $pGoods,
            'rGoods'   => $rGoods,
            'nGoods'   => $nGoods,
            'hGoods'   => $hGoods,
            '_page_title' => '首页',
            '_page_keywords' => '首页',
            '_page_description' => '首页',
            '_show_nav'   => 1,
        ));
        $this->display();
    }
    public function goods(){
        $id = I('get.id');
        //获取该商品的全部信息
        $data = D('Admin/Goods')->find($id);
        //获取面包屑的信息
        $pData = D('Admin/Category')->getParent($data['cat_id']);
        $pData = array_reverse($pData);
        //取出商品的相册
        $goods_pic = D('goods_pic')->where(array(
            'goods_id' => array('eq',$id),
        ))->select();
        //取出商品的属性
        $goods_attr = D('goods_attr')
        ->alias('a')
        ->field('a.*,b.attr_name,b.attr_type')
        ->where(array(
            'goods_id' => array('eq',$id),
        ))
        ->join('LEFT JOIN __ATTRIBUTE__ b on a.attr_id=b.attr_id')
        ->select();
        //整理商品属性，把唯一属性和可选属性分开
        $uniArr = array();
        $mulArr = array();
        foreach($goods_attr as $k=>$v){
            if($v['attr_type'] == 1){
                $mulArr[$v['attr_name']][] = $v;
            }else{
                $uniArr[] = $v;
            }
        }
        //取出商品的会员价格
        $member_price = D('member_price')
        ->alias('a')
        ->field('a.*,b.level_name')
        ->where(array(
            'goods_id' => array('eq',$id),
        ))
        ->join('LEFT JOIN __MEMBER_LEVEL__ b on a.level_id=b.id')
        ->select();
        $config = C('IMAGE_CONFIG');
        $viewPath = $config['viewPath'];
        $this->assign(array(
            'member_price' => $member_price,
            'viewPath' => $viewPath,
            'uniArr' => $uniArr,
            'mulArr' => $mulArr,
            'goods_pic' => $goods_pic,
            'data'  => $data,
            'pData' => $pData,
        ));
        $this->assign(array(
            '_page_title' => '商品详情',
            '_page_keywords' => '商品详情',
            '_page_description' => '商品详情',
            '_show_nav'   => 0,
        ));
        $this->display();
    }
    public function displayHistory(){
        $id = I('get.id');
        $data = isset($_COOKIE['display_history']) ? unserialize($_COOKIE['display_history']) : array();
        //把最新浏览的商品放到第一个位置
        if($id){
            array_unshift($data, $id);
            //去重
            $data = array_unique($data);
            //只取出六个
            if(count($data) > 6){
                $data = array_slice($data,0,6);
            }
        }
       
        

        //放进cookie中
        setcookie('display_history',serialize($data),time()+30*84600,'/');
        $data = implode(',', $data);
        //取出数据
        //var_dump($data);
        $gData = D('Admin/Goods')
        ->field('mid_logo,id,goods_name')
        ->where(array(
            'id' => array('in',$data),
            'is_on_sale' => array('eq','是'),
        ))
        ->order("FIELD(id,$data)")
        ->select();
        //echo D('Admin/Goods')->getLastSql();
        //var_dump($gData);
        echo json_encode($gData);
    }
    
    public function ajaxGetMemberPrice(){
        $goodsId = I('get.goods_id');
        echo D('Admin/Goods')->getMemberPrice($goodsId);
    }
    
}