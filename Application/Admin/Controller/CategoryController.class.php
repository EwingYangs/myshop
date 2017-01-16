<?php
namespace Admin\Controller;
class CategoryController extends BaseController 
{
    public function add()
    {
    	if(IS_POST)
    	{
    		$model = D('Category');
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
        //获取全部的分类树形信息
    	$model = D('Category');
    	$data = $model->getTree();//获得分类的树形结构
		// 设置页面中的信息
		$this->assign(array(
		    'data'           => $data,
			'_page_title'    => '添加分类',
			'_page_btn_name' => '分类列表',
			'_page_btn_link' => U('lst'),
		));
		$this->display();
    }
    public function edit()
    {
    	$cat_id = I('get.id');
    	$model = D('Category');
    	if(IS_POST)
    	{
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
    	$data = $model->find($cat_id);
    	//获取全部的分类树形信息
    	$cat_data = $model->getTree();
    	//获取子分类的id
    	$sub_ids = $model->getChildren($cat_id);
		// 设置页面中的信息
		$this->assign(array(
		    'sub_ids'     => $sub_ids,
		    'data'        => $data,
		    'cat_data'    => $cat_data,
			'_page_title' => '修改分类',
			'_page_btn_name' => '分类列表',
			'_page_btn_link' => U('lst'),
		));
		$this->display();
    }
    public function delete()
    {
    	$model = D('Category');
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
    	$model = D('Category');
    	//$data = $model->search();
    	$data = $model->getTree();//获得分类的树形结构
		// 设置页面中的信息
		$this->assign(array(
		    'data'           => $data,
			'_page_title'    => '分类列表',
			'_page_btn_name' => '添加分类',
			'_page_btn_link' => U('add'),
		));
    	$this->display();
    }
}