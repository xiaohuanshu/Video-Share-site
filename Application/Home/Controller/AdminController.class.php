<?php
namespace Home\Controller;
use Think\Controller;
class AdminController extends GlobalAction
{
    public function _initialize()
    {
        parent::_initialize();
		list($uid, $username) = getuserinfo();
		if (!in_array($uid,C('ADMIN_ID'))) {
        	$this->error('您不是管理员');
		}
    }
	public function index(){
		header('location:'.U('video'));
	}
    public function video()
    {
		$videolist=M('videolist');
		$data=$videolist->select();
		$this->assign('videolist', $data);
        $this->display();
    }
    public function content($movieid)
    {
		$videocontent=M('videocontent');
		$data=$videocontent->where('movieid=%d',$movieid)->select();
		$this->assign('videocontent', $data);
        $this->display();
    }
	public function content_forbidden($contentid){
		$videocontent=M('videocontent');
		if($videocontent->where('id=%d',$contentid)->setField('verify','0')){
			$this->success('已禁用');
		}else{
			$this->error('失败');
		}
	}
	public function content_pass($contentid){
		$videocontent=M('videocontent');
		if($videocontent->where('id=%d',$contentid)->setField('verify','1')){
			$this->success('已审核通过');
		}else{
			$this->error('失败');
		}
	}
	public function content_delete($contentid){
		$videocontent=M('videocontent');
		if($videocontent->where('id=%d',$contentid)->limit(1)->delete()){
			$this->success('已删除');
		}else{
			$this->error('失败');
		}
	}
	public function video_forbidden($movieid){
		$videolist=M('videolist');
		if($videolist->where('id=%d',$movieid)->setField('verify','0')){
			$this->success('已禁用');
		}else{
			$this->error('失败');
		}
	}
	public function video_verify($movieid){
		$videolist=M('videolist');
		if($videolist->where('id=%d',$movieid)->setField('verify','1')){
			$this->success('已审核通过');
		}else{
			$this->error('失败');
		}
	}
	public function video_delete($movieid){
		$videolist=M('videolist');
		if($videolist->where('id=%d',$movieid)->limit(1)->delete()){
			$this->success('已删除');
		}else{
			$this->error('失败');
		}
	}
    public function comment($movieid='')
    {
		$videocomment=M('videocomment');
		if(empty($movieid)){
			$data=$videocomment->select();
		}else{
			$data=$videocomment->where('movieid=%d',$movieid)->select();
		}
		$this->assign('videocomment', $data);
        $this->display();
    }
	public function comment_delete($id){
		$videocomment=M('videocomment');
		if($videocomment->where('id=%d',$id)->limit(1)->delete()){
			$this->success('已删除');
		}else{
			$this->error('失败');
		}
	}
}
?>
