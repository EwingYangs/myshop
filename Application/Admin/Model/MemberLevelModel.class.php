<?php
namespace Admin\Model;
use Think\Model;
use Tools\Page;
class MemberLevelModel extends Model 
{
	protected $insertFields = array('level_name','credit_up','credit_down');
	protected $updateFields = array('id','level_name','credit_up','credit_down');
	protected $_validate = array(
		array('level_name', 'require', '级别名称不能为空！', 1, 'regex', 3),
		array('level_name', '1,30', '级别名称的值最长不能超过 30 个字符！', 1, 'length', 3),
		array('credit_up', 'require', '积分上限不能为空！', 1, 'regex', 3),
		array('credit_up', 'number', '积分上限必须是一个整数！', 1, 'regex', 3),
		array('credit_down', 'require', '积分下限不能为空！', 1, 'regex', 3),
		array('credit_down', 'number', '积分下限必须是一个整数！', 1, 'regex', 3),
	);
	public function search($pageSize = 10)
	{
		/**************************************** 搜索 ****************************************/
		$where = array();
		/************************************* 翻页 ****************************************/
		$count = $this->alias('a')->where($where)->count();
		$page = new Page($count, $pageSize);
		$limit = strchr($page->limit," ");
		$data['page'] = $page->fpage(array(3,4,5,6,7,8));
		/************************************** 取数据 ******************************************/
		$data['data'] = $this->alias('a')->where($where)->group('a.id')->limit($limit)->select();
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
		if(is_array($option['where']['id']))
		{
			$this->error = '不支持批量删除';
			return FALSE;
		}
	}
	/************************************ 其他方法 ********************************************/
}