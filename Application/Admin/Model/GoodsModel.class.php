<?php
namespace Admin\Model;
use Think\Model;
use Tools\Page;
class GoodsModel extends Model{
    //设置表单允许接受的字段
    protected $insertFields = 'goods_name,market_price,shop_price,is_on_sale,goods_desc,goods_sn,cat_id,type_id,brand_id,is_rec,is_new,is_hot,promote_price,promote_start_date,promote_end_date,sort_num';
    protected $updateFields = 'id,goods_name,market_price,shop_price,is_on_sale,goods_desc,goods_sn,cat_id,type_id,brand_id,is_rec,is_new,is_hot,promote_price,promote_start_date,promote_end_date,sort_num';
    protected $_validate = array(
        array('goods_name','require','商品名称不能为空',1),
        array('cat_id','require','商品分类必须选择',1),
        array('market_price','currency','市场价格必须是货币类型',1),
        array('shop_price','currency','本店价格必须是货币类型',1),
        
    );
    //添加之前调用此方法--》钩子方法
    //第一个参数，表单中即将要插入到数据库中的数据，用引用传递（时间，图片）
    protected function _before_insert(&$data,$option){
        //处理logo图片，判断有没有选择图片
        if($_FILES['logo']['error'] == 0){
            $ret = uploadOne('logo', 'Goods', array(
                array(700, 700),
                array(350, 350),
                array(130, 130),
                array(50, 50),
            ));
            if($ret['ok'] == 1)
            {
                //把路径放到表单中
                $data['logo'] = $ret['images'][0];
                $data['mbig_logo'] = $ret['images'][1];
                $data['big_logo'] = $ret['images'][2]; 
                $data['mid_logo'] = $ret['images'][3];
                $data['sm_logo'] = $ret['images'][4];
            }
            else
            {
                $this->error = $ret['error'];
                return FALSE;
            }
        } 
        //获取当前时间，添加到表单中
        $data['addtime'] = date('Y-m-d H:i:s');
        // 我们自己来过滤这个字段
        $data['goods_desc'] = removeXXS($_POST['goods_desc']);
        //判断货号是否为空，为空就自动生成
        if(empty($_POST['goods_sn'])){
            $data['goods_sn'] = date('Ymd') . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
        }
        
        //处理批量图片上传
    }
    
    
    public function _after_insert($data, $options){
        //插入商品之后，向商品属性表插入相应的数据
        $attr_value = I('post.attr_value');
        if($attr_value){
            foreach ($attr_value as $k=>$v){
                if($v == ''){
                    continue;
                }
                foreach ($v as $k1=>$v1){
                    if($v1 == ''){
                        continue;
                    }
                    D('goods_attr')->add(array(
                        'goods_id'  => $data['id'],
                        'attr_id'   => $k,
                        'attr_value'=> $v1,
                    ));
                }
            }
        }
        //插入商品之后，向扩展分类表插入相应的数据
        $ext_cat_id = I('post.ext_cat_id');
        if($ext_cat_id){
            $cats_model = D('goods_cat');
            foreach($ext_cat_id as $k=>$v){
                if($v == ''){
                    continue;
                }
                //插入数据
                $cats_model->add(array(
                    'cat_id' => $v,
                    'goods_id' => $data['id'],
                ));
            }
        }
       
        //插入商品之后，向会员价格表插入相应的数据
        $member_price = I('post.member_price');
        if($member_price){
            $member_model = D('member_price');
            foreach($member_price as $k=>$v){
                $v = (float)$v;
                if($v > 0){
                    //插入数据
                    $member_model->add(array(
                        'price' => $v,
                        'level_id' => $k,
                        'goods_id' => $data['id'],
                    ));
                }
            }
        }
       
        //插入商品之后，向商品相册表插入相应的数据，并上传照片
        if(isset($_FILES['goods_pics'])){
            $pics = array();
            foreach($_FILES['goods_pics']['name'] as $k=>$v){
                $pics[] = array(
                    'name'          =>      $v,
                    'type'          =>      $_FILES['goods_pics']['type'][$k],
                    'tmp_name'      =>      $_FILES['goods_pics']['tmp_name'][$k],
                    'error'         =>      $_FILES['goods_pics']['error'][$k],
                    'size'          =>      $_FILES['goods_pics']['size'][$k],
                );
            }
            $pic_model = D('goods_pic');
            //把$pics赋予给$_FILES,因为uploadOne函数是到$_FILES中找图片
            $_FILES = $pics;
            foreach($pics as $k=>$v){
                //错误的验证
                if($v['error'] == 0){
                    //调用uploadOne函数上传图片
                    $ret = uploadOne($k,'Goods',array(
                        array(650, 650),
                        array(350, 350),
                        array(50, 50),
                    ));
                    if($ret['ok'] == 1)
                    {
                        //把路径放到图片表中
                        $pic_model->add(array(
                            'pic'       => $ret['images'][0],
                            'big_pic'   => $ret['images'][1],
                            'mid_pic'   => $ret['images'][2],
                            'sm_pic'    => $ret['images'][3],
                            'goods_id'  => $data['id'],
                        ));
                    }
                    else
                    {
                        $this->error = $ret['error'];
                        return FALSE;
                    }
                }
            }
        }
        
    }
    
    
    public function _before_update(&$data, $options){
        //获取id
        $id = $options['where']['id'];
        
        
        //更新update字段
        $data['is_updated'] = 1;
        //设置sphinx中的updated属性为1
        /*require('./sphinxapi.php');
        $sph = new \SphinxClient();
        //连接sphinx服务器
        $sph->SetServer('localhost',9312);
        //把id=$id这件商品的updated属性更新成1
        $sph->UpdateAttributes('goods', array('is_updated'), array($id=>array(1)));*/
        
        //处理logo图片，判断有没有选择图片
        if($_FILES['logo']['error'] == 0){
        $ret = uploadOne('logo', 'Goods', array(
                array(700, 700),
                array(350, 350),
                array(130, 130),
                array(50, 50),
            ));
            if($ret['ok'] == 1)
            {
                //把路径放到表单中
                $data['logo'] = $ret['images'][0];
                $data['mbig_logo'] = $ret['images'][1];
                $data['big_logo'] = $ret['images'][2]; 
                $data['mid_logo'] = $ret['images'][3];
                $data['sm_logo'] = $ret['images'][4];
            }
            else
            {
                $this->error = $ret['error'];
                return FALSE;
            }
            //删除原来的图片
            $oldlogo = $this->field('logo,mbig_logo,big_logo,mid_logo,sm_logo')->find($id);
            deleteImage($oldlogo);
        }
        //获取当前时间，添加到表单中
        //$data['addtime'] = date('Y-m-d H:i:s');
        // 我们自己来过滤这个字段
        $data['goods_desc'] = removeXXS($_POST['goods_desc']);
        //判断货号是否为空，为空就自动生成
        if(empty($_POST['goods_sn'])){
            $data['goods_sn'] = date('Ymd') . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
        }
        
        //处理批量图片上传
    }
    
    public function _after_update($data, $options){
        
        $id = $data['id'];
        
        //**************更新商品属性****************
        $goods_attr_model = D('goods_attr');
        $goods_attr_id = I('post.goods_attr_id');
        $attr_value = I('post.attr_value');
        $v_value = array();
            foreach ($attr_value as $k=>$v){
                $goods_attr_id = explode(',', $goods_attr_id[$k]);
                foreach ($v as $k1=>$v1){
                    $id1 = $goods_attr_model->field('id')->where(array('attr_value' => array('eq',$v1)))->where(array('goods_id' => array('eq',$id)))->find();
                    //如果表中没有该数据就插入
                    if(!$id1){
                        if($v1){
                            $goods_attr_model->add(array(
                                'goods_id'  => $id,
                                'attr_id'   => $k,
                                'attr_value'=> $v1,
                            ));
                        }
                    }
                    $v_value[] = $v1;
                }
            }
            //如果表中的数据在表单中不存在，就删除表中的数据
            
            $value = $goods_attr_model->field('attr_value')->where(array('goods_id' => array('eq',$id)))->select();
            foreach($value as $u=>$p){
                if(!in_array($p['attr_value'],$v_value)){
                    //删除$p
                    $goods_attr_model->where(array('attr_value' => array('eq',$p['attr_value'])))->where(array('goods_id' => array('eq',$id)))->delete();
                    //同时要删除库存表中的信息
                    $gnModel = D('goods_number');
                    $gnModel->where(array(
                        'goods_id' => array('EXP',"=$id or AND FIND_IN_SET($p,attr_list)"),
                    ))->delete();
                }
            }
        //**************更新扩展分类****************
        $cats_model = D('goods_cat');
        $ecid = I('post.ext_cat_id');
        //把会员价格表的信息删除
        $cats_model->where(array('goods_id' => array('eq',$id)))->delete();
        //再插入
        if($ecid){
        foreach($ecid as $k=>$v){
                if($v == ''){
                    continue;
                }
                //插入数据
                $cats_model->add(array(
                    'cat_id' => $v,
                    'goods_id' => $data['id'],
                ));
        }
        }
        //**************更新的会员价格***************
        $member_model = D('member_price');
        $member_price = I('post.member_price');
        //把会员价格表的信息删除
        D('member_price')->where(array('goods_id' => array('eq',$id)))->delete();
        //再插入
        if($member_price){
        foreach($member_price as $k=>$v){
            $v = (float)$v;
            if($v > 0){
                //插入数据
                $member_model->add(array(
                    'price' => $v,
                    'level_id' => $k,
                    'goods_id' => $data['id'],
                ));
            }
        }
        }
        //************更新商品相册之后，向商品相册表插入相应的数据，并上传照片************
        if(isset($_FILES['goods_pics'])){
            $pics = array();
            foreach($_FILES['goods_pics']['name'] as $k=>$v){
                $pics[] = array(
                    'name'          =>      $v,
                    'type'          =>      $_FILES['goods_pics']['type'][$k],
                    'tmp_name'      =>      $_FILES['goods_pics']['tmp_name'][$k],
                    'error'         =>      $_FILES['goods_pics']['error'][$k],
                    'size'          =>      $_FILES['goods_pics']['size'][$k],
                );
            }
            $pic_model = D('goods_pic');
            //把$pics赋予给$_FILES,因为uploadOne函数是到$_FILES中找图片
            $_FILES = $pics;
            foreach($pics as $k=>$v){
                //错误的验证
                if($v['error'] == 0){
                    //调用uploadOne函数上传图片
                    $ret = uploadOne($k,'Goods',array(
                        array(650, 650),
                        array(350, 350),
                        array(50, 50),
                    ));
                    if($ret['ok'] == 1)
                    {
                        //把路径放到图片表中
                        $pic_model->add(array(
                            'pic'       => $ret['images'][0],
                            'big_pic'   => $ret['images'][1],
                            'mid_pic'   => $ret['images'][2],
                            'sm_pic'    => $ret['images'][3],
                            'goods_id'  => $data['id'],
                        ));
                    }
                    else
                    {
                        $this->error = $ret['error'];
                        return FALSE;
                    }
                }
            }
        }
    }
    
    public function _before_delete($options){
         $id = $options['where']['id'];
         //***********删除图片*************
         $oldlogo = $this->field('logo,mbig_logo,big_logo,mid_logo,sm_logo')->find($id);
         //调用删除图片的函数
         deleteImage($oldlogo);

         //************删除商品前要把商品库存信息删除*********
         D('goods_number')->where(array('goods_id' => array('eq',$id)))->delete();
         
         //************删除商品前要把商品属性表的信息删除*********
         D('goods_attr')->where(array('goods_id' => array('eq',$id)))->delete();
         
         //************删除商品前要把会员价格表的信息删除*********
         D('member_price')->where(array('goods_id' => array('eq',$id)))->delete();
         
         //************删除商品前要把扩展分类表的信息删除*********
         D('goods_cat')->where(array('goods_id' => array('eq',$id)))->delete();
         
         //******删除商品的前要把图片相册中的数据删除，并且删除硬盘中的图片*****
         $pics = D('goods_pic')->field('pic,big_pic,mid_pic,sm_pic')->where(array('goods_id' => array('eq',$id)))->select();
         //循环删除图片
         foreach($pics as $k=>$v){
             deleteImage($v);
         }
         D('goods_pic')->where(array('goods_id' => array('eq',$id)))->delete();
    }
    
    public function _after_delete($data, $options){
        
    }
    //*********定义根据分类id找出对应商品的id方法****************
    function getGoodsIdByCatId($cat_id){
        //先找出所有的子分类
        $ids = D('Admin/category')->getChildren($cat_id);
        $ids[] = $cat_id;
       
        //取出主分类下的所有商品id
        $gids = $this->field('id')->where(array(
            'cat_id' => array('in',$ids),
        ))->select();
        
        //取出扩展分类下所有的商品id
        $gids1 = D('goods_cat')->field('distinct goods_id as id')->where(array(
            'cat_id' => array('in',$ids),
        ))->select();
        if($gids && $gids1){
            $gids = array_merge($gids,$gids1);
        }else if($gids1){
            $gids = $gids1;
        }
        //二维数组转换成一位数组
        $id = array();
        foreach($gids as $k=>$v){
            //过滤重复值
            if(!in_array($v['id'], $id)){
                $id[] = $v['id'];
            }
        }
       
        return $id;
    }
    
    public function search(){
        //----------搜索----------------
        //定义一个空的where 条件
        $where = array();
        //商品名称
        $goods_name = I('get.goods_name');
        if($goods_name){
            $where['a.goods_name'] = array('like',"%$goods_name%");//where goods_name like'%%';
        }
        //品牌
        $brand_id = I('get.brand_id');
        if($brand_id){
            $where['a.brand_id'] = array('eq',$brand_id);
        }
        //分类
        $cat_id = I('get.cat_id');
        if($cat_id){
            //获取该分类id的所有商品id
            $ids = $this->getGoodsIdByCatId($cat_id);
            $where['a.id'] = array('in',$ids);
        }
        //上下架
        $is_on_sale = I('get.is_on_sale');
        if($is_on_sale){
            $where['a.is_on_sale'] = array('eq',$is_on_sale);
        }
        //推荐
        $intro_type = I('get.intro_type');
        if($intro_type){
            if($intro_type == '推荐'){
                $where['a.is_rec'] = array('eq',$intro_type);
            }
            if($intro_type == '热销'){
                $where['a.is_hot'] = array('eq',$intro_type);
            }
            if($intro_type == '新品'){
                $where['a.is_new'] = array('eq',$intro_type);
            }
        }
        //时间
        $fa = I('get.fa');
        $dao = I('get.dao');
        if($fa && $dao){
              $where['a.addtime'] = array('between',array($fa,$dao));
        }else if($fa){
              $where['a.addtime'] = array('egt',$fa);
        }else if($dao){
              $where['a.addtime'] = array('elt',$dao);
        }
        //----------排序----------------
        //默认的排序字段
        $orderby = 'a.id';
        $orderway = 'desc';
        $odby = I('get.odby');
        if($odby){
              if($odby == 'id_asc'){
                   $orderway = 'asc';
              }else if ($odby == 'price_desc'){
                  $orderby = 'shop_price';
              }else if ($odby == 'price_asc'){
                  $orderby = 'shop_price';
                  $orderway = 'asc';
              }
        }
        //----------翻页----------------
        $count = $this->where($where)->count();
        $page = new Page($count);
        
        $limit = strchr($page->limit," ");
        //----------取数据---------------
        //$data = $this->limit($page->firstRow.','.$page->listRows)->select();
        //$sql = "select * from p39_goods order by id desc ".$page->limit;//注意desc后面要加空格
        //$data = $this->query($sql);
        $pagelist = $page->fpage(array(3,4,5,6,7,8));
        //去除limit的字段,因为拿了外部的分类页，所以构造出limit的元素
        $data = $this->where($where)
        ->order("$orderby $orderway")
        ->field('a.*,b.brand_name,c.cat_name,group_concat(e.cat_name separator "</br>") as ext_cat_name,sum(f.goods_number) as goods_number')
        ->alias('a')
        ->join('LEFT JOIN __BRAND__ b on a.brand_id=b.id
                LEFT JOIN __CATEGORY__ c on a.cat_id=c.cat_id
                LEFT JOIN __GOODS_CAT__ d on a.id=d.goods_id
                LEFT JOIN __CATEGORY__ e on d.cat_id=e.cat_id
                LEFT JOIN __GOODS_NUMBER__ f on a.id=f.goods_id'
            )
        ->group('a.id')
        ->limit($limit)
        ->select();
        return array(
            'data' => $data,
            'page' => $pagelist,
        );
    }
    //********取出促销的商品*********
    public function getPromoteGoods($limit = 5){
        $today = date('Y-m-d H:i');
        return $this->field('id,goods_name,mid_logo,promote_price')
        ->where(array(
            'is_on_sale' => array('eq','是'),
            'promote_price' => array('gt',0),
            'promote_start_date' => array('elt',$today),
            'promote_end_date' => array('egt',$today),
        ))
        ->limit($limit)
        ->select();
        
    }
    //********取出推荐的商品*********
    public function getRecGoods($limit = 5){
        $today = date('Y-m-d H:i');
        return $this->field('id,goods_name,mid_logo,shop_price')
        ->where(array(
            'is_on_sale' => array('eq','是'),
            'is_rec' => array('eq','推荐'),
        ))
        ->limit($limit)
        ->order('sort_num asc')
        ->select();
    }
    //********取出热销的商品*********
    public function getHotGoods($limit = 5){
        $today = date('Y-m-d H:i');
        return $this->field('id,goods_name,mid_logo,shop_price')
        ->where(array(
            'is_on_sale' => array('eq','是'),
            'is_hot' => array('eq','热销'),
        ))
        ->limit($limit)
        ->order('sort_num asc')
        ->select();
    }
    //********取出新品的商品*********
    public function getNewGoods($limit = 5){
        $today = date('Y-m-d H:i');
        return $this->field('id,goods_name,mid_logo,shop_price')
        ->where(array(
            'is_on_sale' => array('eq','是'),
            'is_new' => array('eq','新品'),
        ))
        ->limit($limit)
        ->order('sort_num asc')
        ->select();
    }
    
    
    //*************取出前台的根据会员的购买价格***************
    public function getMemberPrice($goods_id){
        //取出商品的促销价格
        $today = date('Y-m-d H:i');
        $promotePrice = $this->field('promote_price')
        ->where(array(
            'promote_price' => array('gt',0),
            'promote_start_date' => array('elt',$today),
            'promote_end_date' => array('egt',$today),
            'id' => array('eq',$goods_id),
        ))->find();
        $level_id = session('level_id');
        //判断会员有没有登录
        if($level_id){
            $member_price = D('member_price')
            ->field('price')
            ->where(array(
                'level_id' => array('eq',$level_id),
                'goods_id' => array('eq',$goods_id),
            ))->find();
            //判断这个级别有没有设置级别的价格，如果没有设置就返回普通价格
            if($member_price){
                if($promotePrice['promote_price']){
                    return min($promotePrice['promote_price'],$member_price['price']);
                }
                return $member_price['price'];
            }else{
                $p = $this->field('shop_price')->find($goods_id);
                if($promotePrice['promote_price']){
                    return min($promotePrice['promote_price'],$p['shop_price']);
                }
                return $p['shop_price'];
            } 
        }
        else{
            $p = $this->field('shop_price')->find($goods_id);
            if($promotePrice['promote_price']){
                return min($promotePrice['promote_price'],$p['shop_price']);
            }
            return $p['shop_price'];
        }
    }
    
    
    //***********************前台根据分类搜索找商品*************************
    public function cat_search($cat_id) {
        //----------搜索----------------
        $where = array();
        $goodsId = $this->getGoodsIdByCatId($cat_id);
        $where['a.id'] = array('in',$goodsId);
        $where['a.is_on_sale'] = array('eq','是');
        //品牌
        $brand = I('get.brand_id');
        if($brand){
            $where['brand_id'] = array('eq',$brand);
        }
        
        //价格
        $price = I('get.price');
        if($price){
            $price = explode('-', $price);
            $where['shop_price'] = array('between',$price);
        }
        
        //属性             attr_16/64G-内存
        $gaModel = D('Goods_attr');
        $attrGoodsId = null;
        foreach($_GET as $k=>$v){
            if(strpos($k,'attr_') === 0){
                //找出属性id和属性值
                $attr_id = str_replace('attr_','', $k);
                $attr_value = str_replace(strrchr($v,'-'), '', $v);
                //根据属性id还有属性值找出商品的id
                $gids = $gaModel->field('group_concat(goods_id) as gids')
                ->where(array(
                    'attr_id' => array('eq',$attr_id),
                    'attr_value' => array('eq',$attr_value),
                ))
                ->find();
                //转换为一维数组
                $gids = explode(',', $gids['gids']);
                if($attrGoodsId === null){
                    $attrGoodsId = $gids;
                }else{
                    //把新的数组加进去取交集
                    $attrGoodsId = array_intersect($attrGoodsId, $gids);
                    if(empty($attrGoodsId)){
                        //如果交集为空就构建一个不可能的where条件，使得搜索为空
                        $where['a.id'] = array('eq',0);
                    }
                }
            }
        }
        if($attrGoodsId){
            //如果最后的交集不为空，就构造条件
            $where['a.id'] = array('in',$attrGoodsId);
        }
        //----------排序----------------
        //默认的排序字段
        $orderby = 'xl';
        $orderway = 'desc';
        
        $odby = I('get.odby');
        if($odby){
            if($odby == 'addtime'){
                $orderby = 'a.addtime';
            }else if(strpos($odby,'price_') === 0){
                $orderby = 'a.shop_price';
                if($odby == 'price_asc'){
                    $orderway = 'asc';
                }
            }
            
        }
        
        //----------翻页----------------
        $count = $this->where($where)->count();
        $count = $this->alias('a')->field('count(a.id) as count,group_concat(a.id) as goods_id')->where($where)->find();
        $count['goods_id'] = explode(',', $count['goods_id']);
        $page = new Page($count['count'],3);
        
        $limit = strchr($page->limit," ");
        $pagelist = $page->fpage(array(3,4,5,6,7,8));
        //----------取数据---------------
        $data = $this
        ->alias('a')
        ->where($where)
        ->field('a.id,a.goods_name,a.mid_logo,a.shop_price,sum(b.goods_number) as xl')
        ->join('LEFT JOIN __ORDER_GOODS__ b on (a.id=b.goods_id
                and b.order_id in (select id from __ORDER__ where pay_status="是"))'
            )
        ->group('a.id')
        ->order("$orderby $orderway")
        ->limit($limit)
        ->select();
        //返回数据还有分页
        return array(
            'data' => $data,
            'page' => $pagelist,
            'goods_id' => $count['goods_id'],
        );
    }
    
    
    
    public function key_search($key) {
        //搜索sphinx
        /*require('./sphinxapi.php');
        $sph = new \SphinxClient();
        //连接sphinx服务器
        $sph->SetServer('localhost',9312);
        //过滤掉被修改的
        $sph->SetFilter('is_updated', array(0));
        //查询,第二个参数索引，第一个参数查询的关键字
        $ret = $sph->Query($key,'goods');
        $goodsId = array_keys($ret['matches']);*/
        //----------搜索----------------
        $where = array();
        //根据$key取出商品id；
        $goodsId = $this
        ->alias('a')
        ->field('group_concat(distinct a.id) as gids')
        ->join('LEFT JOIN __GOODS_ATTR__ b on a.id=b.goods_id')
        ->where(array(
            'a.is_on_sale' => array('eq','是'),
            'a.goods_name' => array('exp',"like '%$key%' or a.goods_desc like '%$key%' or b.attr_value like '%$key%'"),
        ))
        ->find();
        $goodsId = explode(',', $goodsId['gids']);
        
        //$goodsId = $this->getGoodsIdByCatId($cat_id);
        $where['a.id'] = array('in',$goodsId);
    
        //品牌
        $brand = I('get.brand_id');
        if($brand){
            $where['brand_id'] = array('eq',$brand);
        }
    
        //价格
        $price = I('get.price');
        if($price){
            $price = explode('-', $price);
            $where['shop_price'] = array('between',$price);
        }
    
        //属性             attr_16/64G-内存
        $gaModel = D('Goods_attr');
        $attrGoodsId = null;
        foreach($_GET as $k=>$v){
            if(strpos($k,'attr_') === 0){
                //找出属性id和属性值
                $attr_id = str_replace('attr_','', $k);
                $attr_value = str_replace(strrchr($v,'-'), '', $v);
                //根据属性id还有属性值找出商品的id
                $gids = $gaModel->field('group_concat(goods_id) as gids')
                ->where(array(
                    'attr_id' => array('eq',$attr_id),
                    'attr_value' => array('eq',$attr_value),
                ))
                ->find();
                //转换为一维数组
                $gids = explode(',', $gids['gids']);
                if($attrGoodsId === null){
                    $attrGoodsId = $gids;
                }else{
                    //把新的数组加进去取交集
                    $attrGoodsId = array_intersect($attrGoodsId, $gids);
                    if(empty($attrGoodsId)){
                        //如果交集为空就构建一个不可能的where条件，使得搜索为空
                        $where['a.id'] = array('eq',0);
                    }
                }
            }
        }
        if($attrGoodsId){
            //如果最后的交集不为空，就构造条件
            $where['a.id'] = array('in',$attrGoodsId);
        }
        //----------排序----------------
        //默认的排序字段
        $orderby = 'xl';
        $orderway = 'desc';
    
        $odby = I('get.odby');
        if($odby){
            if($odby == 'addtime'){
                $orderby = 'a.addtime';
            }else if(strpos($odby,'price_') === 0){
                $orderby = 'a.shop_price';
                if($odby == 'price_asc'){
                    $orderway = 'asc';
                }
            }
    
        }
    
        //----------翻页----------------
        $count = $this->where($where)->count();
        $count = $this->alias('a')->field('count(a.id) as count,group_concat(a.id) as goods_id')->where($where)->find();
        $count['goods_id'] = explode(',', $count['goods_id']);
        $page = new Page($count['count']);
    
        $limit = strchr($page->limit," ");
        $pagelist = $page->fpage(array(3,4,5,6,7,8));
        //----------取数据---------------
        $data = $this
        ->alias('a')
        ->where($where)
        ->field('a.id,a.goods_name,a.mid_logo,a.shop_price,sum(b.goods_number) as xl')
        ->join('LEFT JOIN __ORDER_GOODS__ b on (a.id=b.goods_id
                and b.order_id in (select id from __ORDER__ where pay_status="是"))'
            )
            ->group('a.id')
            ->order("$orderby $orderway")
            ->limit($limit)
            ->select();
            //返回数据还有分页
            return array(
                'data' => $data,
                'page' => $pagelist,
                'goods_id' => $count['goods_id'],
            );
    }
    
    
    
}








