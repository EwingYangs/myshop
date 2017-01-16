<?php
namespace Admin\Controller;
class GoodsController extends BaseController{
    public function add(){
        //判断是否提交表单，相当于isset($_POST)
        if(IS_POST){
            //设置php脚本运行的时间限制为0，这样就防止在上传过多的图片是停止运行
            set_time_limit(0);
            $goods = D('Goods');
            //接受数据，校验
            if($goods->create(I('post.'),1)){
                  if($goods->add()){
                       $this->success('操作成功',U('lst'));
                       exit;
                  }
            }
            //获取模型中的报错信息
            $error = $goods->getError();
            //默认跳回上一个页面
            $this->error($error);
        }
        
        //获取会员级别信息
        $member_level = D('member_level')->select();
        //获得品牌信息
        $brand_info = D('Brand')->select();
        //获取分类信息
        $category_info =D('Category')->getTree();
        //分配页面配置信息
        $this->assign(
            array(
                'category_info'  => $category_info,
                'brand_info'     => $brand_info,
                'member_level'   => $member_level,
                '_page_title'    => '添加新商品',
                '_page_btn_name' => '商品列表',
                '_page_btn_link' => U('lst'),
            )        
        ); 
        //不提交就显示
        $this->display();
    }
    public function lst(){
        //获得全部的商品信息
        $goods = D('Goods');
        //$goods_info = $goods->field('goods_name','goods_sn','shop_price','is_on_sale','is_rec','is_hot','is_new','goods_number')->select();
        //用search获得数据还有分页
        $data = $goods->search();
        $this->assign('data',$data);
        
        //获得品牌信息
        $brand_info = D('Brand')->select();
        //获取分类信息
        $category_info =D('Category')->getTree();
        //分配页面配置信息
        $this->assign(
            array(
                'category_info'     => $category_info,
                'brand_info' => $brand_info,
                '_page_title' => '商品列表',
                '_page_btn_name' => '添加新商品',
                '_page_btn_link' => U('add'),
            )
        );
        $this->display();
    }
    public function edit(){
        //获取id
        $id = I('get.id');
        //生成模型
        $goods = D('Goods');
        //var_dump($_POST);die;
        //判断是否提交表单，相当于isset($_POST)
        if(IS_POST){
            //接受数据，校验
            if($goods->create(I('post.'),2)){
                if($goods->save() !== false){
                    $this->success('操作成功',U('lst'));
                    exit;
                }
            }
            //获取模型中的报错信息
            $error = $goods->getError();
            //默认跳回上一个页面
            $this->error($error);
        }
        //根据id获取商品相册中的数据
        $pics = D('goods_pic')->field('id,mid_pic')->where(array('goods_id' => array('eq',$id)))->select();
        //根据id获取商品表单数据
        $info = $goods->find($id);
        $this->assign('info',$info);
       
        
        //根据类型的id取出相对应的属性
        $AttrData = D('attribute')
        ->alias('a')
        ->field('a.*,group_concat(b.id) as goods_attr_id,group_concat(b.attr_value) as goods_attr_value')
        ->join("left join __GOODS_ATTR__ b on (a.attr_id=b.attr_id and b.goods_id=$id)")
        ->where(array('a.type_id' => array('eq',$info['type_id'])))
        ->group('a.attr_id')
        ->select();
        //var_dump($AttrData);die;
        //var_dump($AttrData[3]['attr_value']);
        //$attr_value = preg_split('/\s+/', $AttrData[3]['attr_value']);
        //var_dump($attr_value);die;
        //根据id获取会员价格和级别数据
        $member_level = D('member_level')->select();
        $member_price = D('member_price')->where("goods_id=$id")->select();
        //二维数组转换
        $arr = array();
        foreach($member_price as $k=>$v){
            $arr[$v['level_id']] = $v['price'];
        }
        //取出该id的全部扩展分类id
        $goods_cats = D('goods_cat')->field('cat_id')->where(array('goods_id'=>array('eq',$id)))->select();
        
        //获取分类信息
        $category_info =D('Category')->getTree();
        //分配页面配置信息
        $this->assign(
            array(
                'AttrData'          => $AttrData,
                'goods_cats'        => $goods_cats,
                'category_info'     => $category_info,
                'pics'              => $pics,
                'member_level'      => $member_level,
                'arr'               => $arr,
                '_page_title'       => '修改商品',
                '_page_btn_name'    => '商品列表',
                '_page_btn_link'    => U('lst'),
            )
        );
        //获得品牌信息
        $brand_info = D('Brand')->select();
        $this->assign('brand_info',$brand_info);
        //不提交就显示
        $this->display();
    }
    public function delete(){
        $id = I('get.id');
        $goods = D('Goods');
        $flag = $goods->delete($id);
        if($flag !== false){
            $this->success('删除成功！',U('lst'));
        }else{
            $this->error('删除失败，原因是：'.$goods->getError());   
        }
    }
    public function ajaxDelPic(){
        $id = I('get.picid');
        //找出对应的图片字段
        $pics = D('goods_pic')->field('pic,sm_pic,mid_pic,big_pic')->find($id);
        //调用deleteImage删除
        deleteImage($pics);
        //根据id删除相册表中的数据
        D('goods_pic')->delete($id);
    }
    public function ajaxGetAttr(){
        $type_id = I('get.type_id');
        $attrData = D('attribute')->where(array('type_id' => array('eq',$type_id)))->select();
        echo json_encode($attrData);
    }
    public function goods_number(){
        $goods_id = I('get.id');
        $gnModel = D('goods_number');
        
        IF(IS_POST){
            //先删除库存表中的数据
            $gnModel->where(array('goods_id' => array('eq',$goods_id)))->delete();
            $gaid = I('post.goods_attr_id');
            $gn = I('post.goods_number');
            $id_count = count($gaid);
            $gn_count = count($gn);
            $rate = $id_count/$gn_count;
            $a = 0;
            foreach($gn as $k=>$v){
                if($v == ''){
                   continue;
                }
                $_goodsAttrId = array();
                for($i = 0;$i<$rate;$i++){
                    if($gaid[$a]){
                        $_goodsAttrId[] = $gaid[$a];
                    }
                    $a++;
                }
                //插入数据
               //var_dump($_goodsAttrId);
               //升序排列
                sort($_goodsAttrId,SORT_NUMERIC);
               //转换成字符创
               $_goodsAttrId = (string)implode(',', $_goodsAttrId);
               $gnModel->add(array(
                   'goods_id'       => $goods_id,
                   'goods_number'   => $v,
                   'goods_attr_id'  => $_goodsAttrId,
               ));
            }
            $this->success('整理库存成功！',U('lst'));
            die;
        }
        
        $gaData = D('goods_attr')
        ->field('a.*,b.attr_name')
        ->alias('a')
        ->where(array('a.goods_id' => array('eq',$goods_id)))
        ->where(array('b.attr_type' => array('eq',1)))
        ->where(array('b.attr_input_type' => array('eq',1)))
        ->join('left join __ATTRIBUTE__ b on a.attr_id=b.attr_id')
        ->select();
        
        //获取商品库存量中的信息，并分配出去
        $goods_number = $gnModel->where(array('goods_id' => array('eq',$goods_id)))->select();
        //二维数组转三维
        $_gaData = array();
        foreach($gaData as $k=>$v){
            $_gaData[$v['attr_name']][] = $v;
        }
        
        //var_dump($_gaData);die;
        $this->assign(
            array(
                'goods_number'  => $goods_number, 
                '_gaData'        => $_gaData,
                '_page_title'    => '商品库存量',
                '_page_btn_name' => '返回列表',
                '_page_btn_link' => U('lst'),
            )
            );
        $this->display();
    }
    
}