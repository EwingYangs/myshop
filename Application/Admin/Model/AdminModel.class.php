<?php
namespace Admin\Model;
use Think\Model;
use Tools\Page;
class AdminModel extends Model 
{
	protected $insertFields = array('username','password','cpassword','captcha');
	protected $updateFields = array('id','username','password','cpassword');
	protected $_validate = array(
		array('username', 'require', '用户名不能为空！', 1, 'regex', 3),
		array('username', '1,30', '用户名的值最长不能超过 30 个字符！', 1, 'length', 3),
        array('username', '', '用户名的已经存在！', 1, 'unique', 3),
		array('password', 'require', '密码不能为空！', 1, 'regex', 1),
        array('cpassword', 'password', '两次密码不一致！', 1, 'confirm', 3),
	);
	
	public $_login_validata = array(
	    array('username', 'require', '用户名不能为空！', 1, 'regex', 3),
	    array('password', 'require', '密码不能为空！', 1, 'regex', 3),
	    array('captcha', 'require', '验证码不能为空！', 1, 'regex', 3),
	    array('captcha', 'check_verify', '验证码不正确！', 1, 'callback'),
	);
	function check_verify($code, $id = '')
	{    
	    $verify = new \Think\Verify();    
	    return $verify->check($code, $id);
	}
	//登录验证的方法
	public function login(){
	    //获取表单中的用户名和密码
	    $username = $this->username;//相当于I('post.username')
	    $password = $this->password;
	    $user = $this->where(array('username' => array('eq',$username)))->find();
	    if($user){
	        if($user['password'] == md5($password)){
	            //登录成功！return true
	            //把信息传到session中
	            session('id',$user['id']);
	            session('username',$user['username']);
	            return true;
	        }else{
	            $this->error = "密码不正确！";
	            return false;
	        }
	    }else{
	        $this->error = "用户名不正确！";
	        return false;
	    }
	    
	}
	public function search($pageSize = 20)
	{
		/**************************************** 搜索 ****************************************/
		$where = array();
		//用户名
		if($username = I('get.username'))
			$where['a.username'] = array('like', "%$username%");
		
		//角色
		if($role_id = I('get.role_id')){
		    //获取admin的id
		    $arData = D('admin_role')->field('admin_id')->where(array('role_id' => array('eq',$role_id)))->select();
		    $_arData = array();
		    foreach($arData as $k=>$v){
		        $_arData[] = $v['admin_id'];
		    }
		    $arData = implode(',', $_arData);
		    $where['a.id'] = array('in', $arData);
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
		->field('a.*,group_concat(c.role_name separator " | ") as role_name')
		->where($where)
		->join('LEFT JOIN __ADMIN_ROLE__ b on a.id=b.admin_id
		        LEFT JOIN __ROLE__ c on b.role_id=c.id')
		->group('a.id')
		->limit($limit)
		->select();
		return $data;
	}
	// 添加前
	protected function _before_insert(&$data, $option)
	{      
	    //插入之前先加密
	      $data['password'] = md5($data['password']);
	}
	// 添加后
	protected function _after_insert($data, $options)
	{
	    //添加后往管理员角色表循环插入相关信息
	    $adModel = D('admin_role');
	    $role_ids = I('post.role_id');
	    foreach($role_ids as $k=>$v){
	        $adModel->add(array(
	            'role_id' => $v,
	            'admin_id' => $data['id'],
	        ));
	    }
	}
	// 修改前
	protected function _before_update(&$data, $option)
	{
	    //更新前往管理员角色表循环插入相关信息
	    $adModel = D('admin_role');
	    $role_ids = I('post.role_id');
	    $adModel->where(array('admin_id' => array('eq',$option['where']['id'])))->delete();
	    foreach($role_ids as $k=>$v){
	        $adModel->add(array(
	            'role_id' => $v,
	            'admin_id' => $option['where']['id'],
	        ));
	    }
	    //如果密码为空就删除表单中的空数据
	    if($data['password']){
	        $data['password'] = md5($data['password']);
	    }else{
	        unset($data['password']);
	    }
	    
	}
	
	// 删除前
	protected function _before_delete($option)
	{
        if($option['where']['id'] == 1){
            $this->error = '超级管理员无法删除！';
            return false;
        }
	    D('admin_role')->where(array('admin_id' => array('eq',$option['where']['id'])))->delete();
	}
	/************************************ 其他方法 ********************************************/
}