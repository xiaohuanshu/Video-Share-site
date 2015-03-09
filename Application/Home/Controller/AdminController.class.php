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
		list($uid, $username) = getuserinfo();
		$videocontent=M('videocontent');
		if($videocontent->where('id=%d',$contentid)->setField('verify','0')){
			addtimeline($movieid, '内容屏蔽', '影视介绍存在违规内容', $username, 'fa fa-eye-slash time-icon bg-danger');
			$this->success('已禁用');
		}else{
			$this->error('失败');
		}
	}
	public function content_pass($contentid){
		list($uid, $username) = getuserinfo();
		$videocontent=M('videocontent');
		if($videocontent->where('id=%d',$contentid)->setField('verify','1')){
			addtimeline($movieid, '审核通过', '影视介绍内容通过审核', $username, 'fa fa-eye time-icon bg-info');
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
		list($uid, $username) = getuserinfo();
		$videolist=M('videolist');
		if($videolist->where('id=%d',$movieid)->setField('verify','0')){
			addtimeline($movieid, '资源屏蔽', '影视资源存在违规内容', $username, 'fa fa-eye-slash time-icon bg-danger');
			$this->success('已禁用');
		}else{
			$this->error('失败');
		}
	}
	public function video_verify($movieid){
		list($uid, $username) = getuserinfo();
		$videolist=M('videolist');
		if($videolist->where('id=%d',$movieid)->setField('verify','1')){
			addtimeline($movieid, '审核通过', '影视通过审核', $username, 'fa fa-eye time-icon bg-info');
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
    public function local($movieid)
    {
		$localvideo=M('localvideo');
		$data=$localvideo->where('movieid=%d',$movieid)->select();
		$this->assign('localvideo', $data);
        $this->display();
    }
	public function local_forbidden($localid){
		list($uid, $username) = getuserinfo();
		$localvideo=M('localvideo');
		if($localvideo->where('id=%d',$localid)->setField('verify','0')){
			addtimeline($movieid, '资源屏蔽', '影视资源存在违规内容', $username, 'fa fa-eye-slash time-icon bg-danger');
			$this->success('已禁用');
		}else{
			$this->error('失败');
		}
	}
	public function local_pass($localid){
		list($uid, $username) = getuserinfo();
		$localvideo=M('localvideo');
		if($localvideo->where('id=%d',$localid)->setField('verify','1')){
			changeuploadstatus($localvideo->where('id=%d',$localid)->field('movieid')->limit(1)->select()[0]['movieid']);
			addtimeline($movieid, '审核通过', '影视资源通过审核', $username, 'fa fa-eye time-icon bg-info');
			$this->success('已审核通过');
		}else{
			$this->error('失败');
		}
	}
	public function local_delete($localid){
		$localvideo=M('localvideo');
		$data=$localvideo->where('id=%d',$localid)->limit(1)->select();
		$url="Uploads/movie/" . $data[0]['url'];
		if($localvideo->where('id=%d',$localid)->limit(1)->delete()){
			if (file_exists($url)){
				unlink($url);
			}
			$this->success('已删除');
		}else{
			$this->error('失败');
		}
	}
	public function local_shot($localid){
		$localvideo=M('localvideo');
		$data=$localvideo->where('id=%d',$localid)->select();
		$this->assign('localvideo', $data[0]);
		
		$localshot=videocheckshot($data[0][url]);
		$this->assign('localshot', $localshot);
		
        $this->display();
	}
}
?>
