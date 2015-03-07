<?php
namespace Home\Controller;
use Think\Controller;
class AdminController extends GlobalAction
{
    public function _initialize()
    {
        parent::_initialize();
        
    }
    public function video()
    {
		list($uid, $username) = getuserinfo();
		if (!in_array($uid,C('ADMIN_ID'))) {
        	$this->error('您不是管理员');
		}
		$videolist=M('videolist');
		$data=$videolist->select();
		$this->assign('videolist', $data);
        $this->display();
    }
	public function video_forbidden($movieid){
		list($uid, $username) = getuserinfo();
		if (!in_array($uid,C('ADMIN_ID'))) {
        	$this->error('您不是管理员');
		}
		$videolist=M('videolist');
		if($videolist->where('id=%d',$movieid)->setField('verify','0')){
			$this->success('已禁用');
		}else{
			$this->error('失败');
		}
	}
	public function video_verify($movieid){
		list($uid, $username) = getuserinfo();
		if (!in_array($uid,C('ADMIN_ID'))) {
        	$this->error('您不是管理员');
		}
		$videolist=M('videolist');
		if($videolist->where('id=%d',$movieid)->setField('verify','1')){
			$this->success('已审核通过');
		}else{
			$this->error('失败');
		}
	}
	public function video_delete($movieid){
		list($uid, $username) = getuserinfo();
		if (!in_array($uid,C('ADMIN_ID'))) {
        	$this->error('您不是管理员');
		}
		$videolist=M('videolist');
		if($videolist->where('id=%d',$movieid)->limit(1)->delete()){
			$this->success('已删除');
		}else{
			$this->error('失败');
		}
	}
}
?>
