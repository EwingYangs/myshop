<?php
namespace Admin\Model;
use Think\Model;
use Tools\Page;
class AttributeModel extends Model 
{
	protected $insertFields = array('attr_name','type_id','attr_type','attr_input_type','attr_value');
	protected $updateFields = array('attr_id','attr_name','type_id','attr_type','attr_input_type','attr_value');
	protected $_validate = array(
		array('attr_name', '1,50', '商品属性名称的值最长不能超过 50 个字符！', 2, 'length', 3),
	    array('attr_name', 'require', '属性名称不能为空！', 1, 'regex', 3),
		array('type_id', 'require', '所属商品类型必须选择！', 1, 'regex', 3),
	);
	public function search($pageSize = 20)
	{
		/**************************************** 搜索 ****************************************/
		$where = array();
		$goods_type = I('get.type_id');
		if($goods_type){
		    
		    $where['a.type_id'] = array('eq',$goods_type);
		}
		/************************************* 翻页 ****************************************/
	    $count = $this->alias('a')->where($where)->count();
		$page = new Page($count, $pageSize);
		// 配置翻页的样式
		//$page->setConfig('prev', '上一页');
		//$page->setConfig('next', '下一页');
		//$data['page'] = $page->show();
		$data['page'] = $page->fpage(array(3,4,5,6,7,8));
		$limit = strchr($page->limit," ");
		/************************************** 取数据 ******************************************/
		$data['data'] = $this
		->alias('a')
		->field('a.*,b.type_name')
		->where($where)
		->group('a.attr_id')
		->join('left join __TYPE__ b on a.type_id=b.type_id')
		->limit($limit)
		->select();
		return $data;
	}
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
	
	}
	/************************************ 其他方法 ********************************************/
}