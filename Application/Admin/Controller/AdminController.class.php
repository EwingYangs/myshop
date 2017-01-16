<?php
namespace Admin\Controller;
class AdminController extends BaseController 
{
    public function add()
    {
    	if(IS_POST)
    	{
    		$model = D('Admin');
    		if($model->create(I('post.'), 1))
    		{
    			if($id = $model->add())
    			{
    				$this->success('添加成功！', U('lst?p='.I('get.p')));
    				exit;
    			}
    		}
    		$this->error($model->getError());
    	}
        //获取所有的角色信息
        $rData = D('role')->select();
		// 设置页面中的信息
		$this->assign(array(
		    'rData'      => $rData,
			'_page_title' => '添加管理员',
			'_page_btn_name' => '管理员列表',
			'_page_btn_link' => U('lst'),
		));
		$this->display();
    }
    public function edit()
    {
    	$id = I('get.id');
    	if(IS_POST)
    	{
    		$model = D('Admin');
    		if($model->create(I('post.'), 2))
    		{
    			if($model->save() !== FALSE)
    			{
    				$this->success('修改成功！', U('lst', array('p' => I('get.p', 1))));
    				exit;
    			}
    		}
    		$this->error($model->getError());
    	}
    	$model = M('Admin');
    	$data = $model->find($id);
    	$this->assign('data', $data);
    	//获取全部角色信息
    	$rData = D('role')->select();
        //获取管理员的角色信息
        $arData = D('admin_role')->field('role_id')->where(array('admin_id' => array('eq',$id)))->select();
    	$_arData = array();
    	foreach($arData as $k=>$v){
    	    $_arData[] = $v['role_id'];
    	}
		// 设置页面中的信息
		$this->assign(array(
		    '_arData'     => $_arData,
		    'rData'       => $rData,
			'_page_title' => '修改管理员',
			'_page_btn_name' => '管理员列表',
			'_page_btn_link' => U('lst'),
		));
		$this->display();
    }
    public function delete()
    {
    	$model = D('Admin');
    	if($model->delete(I('get.id', 0)) !== FALSE)
    	{
    		$this->success('删除成功！', U('lst', array('p' => I('get.p', 1))));
    		exit;
    	}
    	else 
    	{
    		$this->error($model->getError());
    	}
    }
    public function lst()
    {
    	$model = D('Admin');
    	$data = $model->search();
    	$this->assign(array(
    		'data' => $data['data'],
    		'page' => $data['page'],
    	));
    	//获取所有的角色信息
    	$rData = D('role')->select();
		// 设置页面中的信息
		$this->assign(array(
		    'rData'       => $rData,
			'_page_title' => '管理员列表',
			'_page_btn_name' => '添加管理员',
			'_page_btn_link' => U('add'),
		));
    	$this->display();
    }
}