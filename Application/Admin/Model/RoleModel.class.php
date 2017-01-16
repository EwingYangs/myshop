<?php
namespace Admin\Model;
use Think\Model;
use Tools\Page;
class RoleModel extends Model 
{
	protected $insertFields = array('role_name');
	protected $updateFields = array('id','role_name');
	protected $_validate = array(
		array('role_name', 'require', '角色名称不能为空！', 1, 'regex', 3),
		array('role_name', '1,30', '角色名称的值最长不能超过 30 个字符！', 1, 'length', 3),
        array('role_name', '', '角色名称已经存在！', 1, 'unique', 3),
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
		->field('a.*,group_concat(c.pri_name separator " | ") as pri_name')
		->join('LEFT JOIN __ROLE_PRI__ b on a.id=b.role_id')
		->join('LEFT JOIN __PRIVILEGE__ c on b.pri_id=c.id')
		->group('a.id')
		->where($where)
		->limit($limit)
		->select();
		return $data;
	}
	// 添加前
	protected function _before_insert(&$data, $option)
	{

	}
	// 添加后
	protected function _after_insert(&$data, $option)
	{
	     $priId = I('post.pri_id');
	     
	     $rpModel = D('role_pri');
	     foreach($priId as $k=>$v){
	         $rpModel->add(array(
	             'pri_id'      =>  $v,
	             'role_id'     =>  $data['id'],
	         ));
	     }
	}
	// 修改前
	protected function _before_update(&$data, $option)
	{   
	    //更新前先删除角色权限表中的数据，再插入
	    $priId = I('post.pri_id');
	    D('role_pri')->where(array('role_id' => array('eq',$option['where']['id'])))->delete();
	    $rpModel = D('role_pri');
	    foreach($priId as $k=>$v){
	        $rpModel->add(array(
	            'pri_id'      =>  $v,
	            'role_id'     =>  $option['where']['id'],
	        ));
	    }
	}
	// 删除前
	protected function _before_delete($option)
	{
	    D('role_pri')->where(array('role_id' => array('eq',$option['where']['id'])))->delete();
	    D('admin_role')->where(array('role_id' => array('eq',$option['where']['id'])))->delete();
	}
	/************************************ 其他方法 ********************************************/
}