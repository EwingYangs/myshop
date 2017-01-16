<?php
namespace Admin\Model;
use Think\Model;
class CommentReplyModel extends Model 
{
	protected $insertFields = array('comment_id','content');
	protected $_validate = array(
		array('comment_id', 'require', '参数错误！', 1, 'regex', 3),
	    array('content', 'require', '评论不能为空！', 1, 'regex', 3),
		array('content', '1,200', '评论不能超过 200 个字符！', 1, 'length', 3),
	);
	
	// 添加前
	protected function _before_insert(&$data, $option)
	{
		$member_id = session('m_id');
		if(!$member_id){
		    $this->error = '必须先登录！';
		    return false;
		}
		
		
		//插入之前补充值
		$data['member_id'] = $member_id;
		$data['addtime'] = date('Y-m-d H:i:s');
		
	}
	
	public function search(){
	    $comment_id = I('get.comment_id');
	    $data = $this->alias('a')
	    ->field('a.*,b.face,b.username')
	    ->where(array(
	        'comment_id' => array('eq',$comment_id),
	    ))
	    ->join('LEFT JOIN __MEMBER__ b on a.member_id=b.id')
	    ->select();
	    return $data;
	}
	
	
	/************************************ 其他方法 ********************************************/
}