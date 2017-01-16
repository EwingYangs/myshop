<?php
namespace Home\Controller;
use Think\Controller;
class CommentController extends Controller{
    public function add(){
        if(IS_POST){
            $model = D('Admin/Comment');
            if($model->create(I('post.'),1)){
                if($id = $model->add()){
                    $this->success(array(
                        'id' => $id,
                        'face' => session('face'),
                        'username' => session('m_username'),
                        'content' => I('post.content'),
                        'star' => I('post.star'),
                        'addtime' => date('Y-m-d H:i:s'),
                    ));
                    exit;
                }
            }
            $this->error($model->getError());
        }
     
    }
    public function reply(){
        if(IS_POST){
            $model = D('Admin/CommentReply');
            if($model->create(I('post.'),1)){
                if($model->add()){
                    $this->success(array(
                        'face' => session('face'),
                        'username' => session('m_username'),
                        'content' => I('post.content'),
                        'addtime' => date('Y-m-d H:i:s'),
                    ));
                    exit;
                }
            }
            $this->error($model->getError());
        }
    }
    public function ajaxGetPl(){
        $data = D('Admin/Comment')->search();
        echo json_encode($data);
    }

    public function ajaxGetReply(){
        $data = D('Admin/CommentReply')->search();
        echo json_encode($data);
    }
    
    public function ajaxAddCount(){
        $comment_id = I('get.comment_id');
        D('Admin/Comment')->where(array(
            'id' => $comment_id,
        ))->setInc('click_count');
    }
}