<?php
namespace Admin\Model;
use Think\Model;
class PrivilegeModel extends Model 
{
	protected $insertFields = array('pri_name','module_name','controller_name','action_name','parent_id');
	protected $updateFields = array('id','pri_name','module_name','controller_name','action_name','parent_id');
	protected $_validate = array(
		array('pri_name', 'require', '权限名称不能为空！', 1, 'regex', 3),
		array('pri_name', '1,30', '权限名称的值最长不能超过 30 个字符！', 1, 'length', 3),
		array('module_name', '1,30', '模块名称的值最长不能超过 30 个字符！', 2, 'length', 3),
		array('controller_name', '1,30', '控制器名称的值最长不能超过 30 个字符！', 2, 'length', 3),
		array('action_name', '1,30', '方法名称的值最长不能超过 30 个字符！', 2, 'length', 3),
		array('parent_id', 'number', '上级权限Id必须是一个整数！', 2, 'regex', 3),
	);
	/************************************* 递归相关方法 *************************************/
	public function getTree()
	{
		$data = $this->select();
		return $this->_reSort($data);
	}
	private function _reSort($data, $parent_id=0, $level=0, $isClear=TRUE)
	{
		static $ret = array();
		if($isClear)
			$ret = array();
		foreach ($data as $k => $v)
		{
			if($v['parent_id'] == $parent_id)
			{
				$v['level'] = $level;
				$ret[] = $v;
				$this->_reSort($data, $v['id'], $level+1, FALSE);
			}
		}
		return $ret;
	}
	public function getChildren($id)
	{
		$data = $this->select();
		return $this->_children($data, $id);
	}
	private function _children($data, $parent_id=0, $isClear=TRUE)
	{
		static $ret = array();
		if($isClear)
			$ret = array();
		foreach ($data as $k => $v)
		{
			if($v['parent_id'] == $parent_id)
			{
				$ret[] = $v['id'];
				$this->_children($data, $v['id'], FALSE);
			}
		}
		return $ret;
	}
	/************************************ 其他方法 ********************************************/
	public function _before_delete($option)
	{
		// 先找出所有的子分类
		$children = $this->getChildren($option['where']['id']);
		// 如果有子分类都删除掉
		if($children)
		{
			$this->error = '有下级数据无法删除';
			return FALSE;
		}
		//把中间表的数据删除
		$rpModel = D('role_pri');
		$rpModel->where(array('pri_id' => array('eq',$option['where']['id'])))->delete();
	}
	public function chkPri(){
	    $adminId = session('id');
	    if($adminId == 1){
	        return true;
	    }
	    //判断当前的控制器和方法是否属于该管理员
	    $has = D('admin_role')
	    ->alias('a')
	    ->join('LEFT JOIN __ROLE_PRI__ b on a.role_id=b.role_id
                LEFT JOIN __PRIVILEGE__ c on b.pri_id=c.id')
        ->where(array(
            'a.admin_id' => array('eq',$adminId),
            'c.module_name' => array('eq',MODULE_NAME),
            'c.controller_name' => array('eq',CONTROLLER_NAME),
            'c.action_name' => array('eq',ACTION_NAME),
        ))
        ->count();
	    return ($has > 0);
	}
	public function getBtn(){
	    $adminId = session('id');
	    if($adminId == 1){
	        //获取全部的控制器和方法
	        $priData = D('privilege')->select();
	    }else{
	        //获取当前管理员的所有控制器和方法
	        $priData = D('admin_role')
	        ->alias('a')
            ->field('distinct c.id,c.pri_name,c.module_name,c.controller_name,c.action_name,c.parent_id')
            ->join('LEFT JOIN __ROLE_PRI__ b on a.role_id=b.role_id
                    LEFT JOIN __PRIVILEGE__ c on b.pri_id=c.id')
            ->where(array(
                'a.admin_id' => array('eq',$adminId),
            ))
            ->select();
	    }
	    //从所有权限中挑出前两级
	    $btns = array();
	    foreach ($priData as $k=>$v){
	        if($v['parent_id'] == 0){
	            foreach($priData as $k1=>$v1){
	                if($v1['parent_id'] == $v['id']){
	                   $v['children'][] = $v1; 
	                }
	            }
	            $btns[] = $v;
	        }
	    }
	    return $btns;
	}
}