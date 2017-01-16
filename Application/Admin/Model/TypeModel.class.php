<?php
namespace Admin\Model;
use Think\Model;
use Tools\Page;
class TypeModel extends Model 
{
	protected $insertFields = array('type_name');
	protected $updateFields = array('type_id','type_name');
	protected $_validate = array(
		array('type_name', 'require', '类型名称不能为空！', 1, 'regex', 3),
		array('type_name', '1,30', '类型名称的值最长不能超过 30 个字符！', 1, 'length', 3),
        array('type_name', '', '类型名称已经存在！', 1, 'unique', 3),
	);
	public function search($pageSize = 20)
	{
		/**************************************** 搜索 ****************************************/
		$where = array();
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
		->field('a.*,count(b.attr_id) as type_num')
		->where($where)
		->join('left join __ATTRIBUTE__ b on a.type_id=b.type_id')
		->group('a.type_id')
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
		//删除类型的时候，把属性也删除
		D('Attribute')->where(array('type_id' => array('eq',$option['where']['type_id'])))->delete();
	}
	/************************************ 其他方法 ********************************************/
}