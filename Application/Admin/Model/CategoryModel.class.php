<?php
namespace Admin\Model;
use Think\Model;
use Tools\Page;
class CategoryModel extends Model 
{
	protected $insertFields = array('cat_name','parent_id','unit','is_floor');
	protected $updateFields = array('cat_id','cat_name','parent_id','unit','is_floor');
	protected $_validate = array(
		array('cat_name', 'require', '分类名称不能为空！', 1, 'regex', 3),
		array('cat_name', '1,30', '分类名称的值最长不能超过 30 个字符！', 1, 'length', 3),
		array('parent_id', 'number', '父类id必须是一个整数！', 2, 'regex', 3),
		array('unit', '1,15', '数量单位的值最长不能超过 15 个字符！', 2, 'length', 3),
	);
	//************实现构建分类树的递归函数***************
	public function getTree(){
	    $data = $this->select();
	    return $this->_getTree($data);
	}
	private function _getTree($data,$parent_id=0,$level=0){
	    static $res = array();
	    foreach($data as $k=>$v){
	        if($v['parent_id'] == $parent_id){
	            $v['level'] = $level;
	            $res[] = $v;
	            $this->_getTree($data,$v['cat_id'],$level+1);
	        }
	    }
	    return $res;
	}
	
	//************实现根据id查询子id的递归函数*********
	public function getChildren($cat_id){
	    $data = $this->select();
	    return $this->_getChildren($data,$cat_id,true);
	}
	private function _getChildren($data,$cat_id,$isClear=false){
	    static $ret = array();
	    if($isClear){
	        //清除数组
	        $ret = array();
	    }
	    foreach($data as $k=>$v){
	        if($v['parent_id'] == $cat_id){
	              $ret[] = $v['cat_id'];
	              $this->_getChildren($data, $v['cat_id']);
	        }
	    }
	    return $ret;
	}
	//***********实现导航页显示分类*******************
	public function getNavData(){
	    $catData = S('catData');
	    if(!$catData){
	        $data = $this->select();
	        $catData = $this->_getNavData($data);
	        S('catData',$catData,86400);
	    }
	    return $catData;
	}
	private function _getNavData($data,$parent_id=0){
	    $arr = array();
	    foreach ($data as $k=>$v){
	        if($v['parent_id'] == $parent_id){
	            $v['children'] =  $this->_getNavData($data,$v['cat_id']);
	            $arr[] = $v;
	        }
	    }
	    return $arr;
	}
	//*****************钩子函数的操作****************
	// 添加前
	protected function _before_insert(&$data, $option)
	{
	}
	// 修改前
	protected function _before_update(&$data, $option)
	{
	}
	// 删除前
	protected function _before_delete($option)
	{
		//删除之前把子类的id也删除
		$id = I('get.id');
		//调用getChildren方法获取子id
		$sub_ids = $this->getChildren($id);
		if($sub_ids){
		    //把id的数组变成字符串
		    $sub_ids = implode(',',$sub_ids);
		    $model = new \Think\Model();//实例化一个父类的模型
		    $model->table('_CATEGORY_')->delete($sub_ids);
		}
		
	}
	/************************************ 其他方法 ********************************************/
    //**********获取首页楼层中的分类***************
    public function floorData(){
        //取出推荐到楼层的顶级分类
        //$floorData = S('floorData');
        if($floorData){
            return $floorData;
        }else{
        $goodsModel = D('Admin/Goods');
        $ret = $this->where(array(
            'parent_id' => array('eq',0),
            'is_floor' => array('eq','是'),
        ))->select();
        foreach ($ret as $k=>$v){
            //************找出品牌所对应的商品的所有品牌
            $goodsId = $goodsModel->getGoodsIdByCatId($v['cat_id']);
            $ret[$k]['brand'] = $goodsModel
            ->alias('a')
            ->field('distinct a.brand_id,b.brand_name,b.logo')
            ->where(array(
                'a.id' => array('in',$goodsId),
                'a.brand_id' => array('neq',0),
            ))
            ->join('LEFT JOIN __BRAND__ b on a.brand_id=b.id')
            ->limit(9)
            ->select();
            //************循环顶级分类，找出所有二级分类
            $ret[$k]['subCat'] = $this->where(array(
                'parent_id' => array('eq',$v['cat_id']),
            ))->select();
            
            //**************找出推荐的二级分类
            $ret[$k]['recSubCat'] = $this->where(array(
                'parent_id' => array('eq',$v['cat_id']),
                'is_floor' => array('eq','是'),
            ))->select();
            
            foreach ($ret[$k]['recSubCat'] as $k2=>$v2){
                //**************找出属于推荐二级分类的所有八件商品
                $gids = $goodsModel->getGoodsIdByCatId($v2['cat_id']);
                $ret[$k]['recSubCat'][$k2]['goods'] = $goodsModel
                ->field('id,goods_name,shop_price,mid_logo')
                ->where(array(
                'is_on_sale' => array('eq','是'),
                'id' => array('in',$gids),
                'is_rec' => array('eq','推荐'),
                ))
                ->order('sort_num asc')
                ->limit('0,8')
                ->select();
            }
        }
        //S('floorData',$ret,86400);
        return $ret;
        }
    }
    //**************获取面包屑的信息******************
    public function getParent($cat_id){
        static $res = array();
        $data = $this->field('cat_id,parent_id,cat_name')->find($cat_id);
        $res[] = $data;
        if($data['parent_id'] > 0 ){
            //如果有父类的id就继续找其父类
            $this->getParent($data['parent_id']);
        }
        return $res;
    } 
    
    
    //*************获取分类搜索中的筛选信息*****************
    public function getSearchInfo($goodsId){
        //先获取分类下的所有商品id
        $res = array();
        //$goodsId = D('Admin/Goods')->getGoodsIdByCatId($cat_id);
        //*****************获取品牌*******************
        $res['brand'] = D('Admin/Goods')
        ->alias('a')
        ->field('distinct a.brand_id,b.brand_name')
        ->where(array(
            'a.id' => array('in',$goodsId),
            'a.brand_id' => array('neq',0),
        ))
        ->join('LEFT JOIN __BRAND__ b on a.brand_id=b.id')
        ->select();
        
        
        //***************价格区间段********************
        $priceInfo = D('Goods')->field('max(shop_price) as max_price,min(shop_price) as min_price')
        ->where(array(
            'id' => array('in',$goodsId),
        ))->find();
        //取出差价
        $priceSection = $priceInfo['max_price'] - $priceInfo['min_price'];
        //取出商品的总数
        $goodsCount = count($goodsId);
        //var_dump($goodsCount);die;
        if($goodsCount > 1){
            if($priceSection < 100){
                $sectionCount = 2;
            }else if($priceSection < 1000){
                $sectionCount = 4;
            }else if($priceSection < 10000){
                $sectionCount = 6;
            }else{
                $sectionCount = 7;
            }
            //根据这些分段数分段
            $pricePerSection = ceil($priceInfo['max_price']/$goodsCount);//取出每段的范围
            $price = array();
            $firstPrice = 0;
            for($i = 0;$i<$goodsCount;$i++){
                $_temEnd = $firstPrice + $pricePerSection;
                //取整
                $_temEnd = ((ceil($_temEnd/100))*100-1);
                $price[] = $firstPrice . '-' . $_temEnd;
                $firstPrice = $_temEnd+1;
            }
            $res['price'] = $price; 
        }
        
        //************商品属性******************
        $gaData = D('goods_attr')->alias('a')
        ->field('distinct a.attr_id,a.attr_value,b.attr_name')
        ->join('LEFT JOIN __ATTRIBUTE__ b on a.attr_id=b.attr_id')
        ->where(array(
            'a.goods_id' => array('in',$goodsId),
            'a.attr_value' => array('neq',''),
        ))
        ->select();
        //把二维数组转换成三维
        $_gaData = array();
        foreach($gaData as $k=>$v){
            $_gaData[$v['attr_name']][] = $v; 
        }
        $res['gaData'] = $_gaData;
        return $res;
    }
}