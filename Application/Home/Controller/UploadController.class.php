<?php
namespace Home\Controller;
use Think\Controller;
class UploadController extends GlobalAction
{
    public function _initialize()
    {
        parent::_initialize();
    }
    public function uploadview($movieid)
    {
        list($uid, $username) = getuserinfo();
        if (empty($uid)) {
            $this->error('您还没有登录');
        }
        $this->assign('movieid', I('get.movieid'));
        $this->display();
    }
    public function deal($movieid)
    {
        list($uid, $username) = getuserinfo();
        if (empty($uid)) {
            $this->error('您还没有登录');
        }
        for ($i = 0; $i <= intval($_POST['uploader_count']) - 1; $i++) {
            //$uploader_tmpname[$i] = $_POST['uploader_' . $i . '_tmpname'];
            //$uploader_name[$i]    = $_POST['uploader_' . $i . '_name'];
            $uploader_tmpname[$i] = I('post.uploader_' . $i . '_tmpname');
            $uploader_name[$i]    = I('post.uploader_' . $i . '_name');
        }
        $this->assign('uploader_name', $uploader_name);
        $this->assign('uploader_tmpname', $uploader_tmpname);
        $this->assign('uploader_count', I('post.uploader_count'));
        $this->assign('movieid', I('get.movieid'));
        $this->display();
    }
    public function deal2($movieid)
    {
        list($uid, $username) = getuserinfo();
        if (empty($uid)) {
            $this->error('您还没有登录');
        }
        $locallist = M('localvideo');
        for ($i = 0; $i <= intval($_POST['uploader_count']) - 1; $i++) {
            $c['userid']  = $uid;
            $c['movieid'] = $movieid;
            $c['url']     = I('post.uploader_' . $i . '_tmpname');
            $c['title']   = I('post.uploader_' . $i . '_name');
			if (in_array($uid,C('ADMIN_ID'))) {
	        	$c['verify']  = 1;
				changeuploadstatus($movieid);
			}else{
				$c['verify']  = 0;
			}
            $c['time']    = date('Y-m-d H:i:s');
            //判断能否在线播放
            list($video, $audio) = videoinfo(I('post.uploader_' . $i . '_tmpname'));
            if (strpos($video, "h264")) { //&&strpos($audio,"aac")){
                $c['online'] = 1;
				//视频截图
				videoshot(I('post.uploader_' . $i . '_tmpname'));
            } else {
                $c['online'] = 0;
            }
            $locallist->add($c);
        }
        addtimeline($movieid, '上传视频', I('post.uploader_' . $i . '_tmpname'), $username, 'fa fa-cloud-upload time-icon bg-dark');
        $this->success("上传成功", U("movie/show?id=" . $movieid));
    }
    public function poster($movieid)
    {
        list($uid, $username) = getuserinfo();
        if (empty($uid)) {
            $this->error('您还没有登录');
        }
		if ($_GET['getcontent']!=1){
        	$upload           = new \Think\Upload(); // 实例化上传类
        	$upload->maxSize  = 3145728; // 设置附件上传大小
        	$upload->exts     = array(
        		'jpg',
        		'gif',
        		'png',
        		'jpeg'
        	); // 设置附件上传类型
        	$upload->rootPath = './Uploads/'; // 设置附件上传根目录
        	$upload->autoSub  = false;
        	$upload->savePath = 'poster/'; // 设置附件上传（子）目录
        	// 上传文件 
        	$info             = $upload->upload();
        	if (!$info) { // 上传错误提示错误信息
        		$this->error($upload->getError());
        	}
        	$filepath = './Uploads/' . $info['uimage']['savepath'] . $info['uimage']['savename'];
			$dbfilepath = __ROOT__.'/Uploads/' . $info['uimage']['savepath'] . $info['uimage']['savename'];
		}else{
			if(empty($_POST['posterurl'])){
				$this->error('海报地址出错');
			}
			$url="http://img4.douban.com/view/photo/photo/public/p".I('post.posterurl').".jpg";
			$data = file_get_contents($url);
			if(!file_put_contents('./Uploads/poster/douban.'.I('post.posterurl').'.jpg',$data)){
				$this->error('海报下载出错');
			}else{
	        	$filepath = './Uploads/poster/douban.'.I('post.posterurl').'.jpg';
				$dbfilepath = __ROOT__.'/Uploads/poster/douban.'.I('post.posterurl').'.jpg';
			}
		}
        $image    = new \Think\Image();
        $image->open($filepath);
        // 生成一个居中裁剪的缩略图
        $image->thumb(357, 526, \Think\Image::IMAGE_THUMB_CENTER)->save($filepath . '.thumb.jpg');
        if (empty($_POST['options'])) {
            $c['type'] = "其他";
        } else {
            $c['type'] = implode(I('post.options'), ',');
        }
        $c['time'] = date('Y-m-d H:i:s');
        $videolist = M('videolist');
        if (!$videolist->autoCheckToken($_POST)) {
            $this->error("令牌验证错误,请返回重试"); // 令牌验证错误
        }
        $c['image'] = $dbfilepath;
		$c['playtime'] = I('post.time');
        $videolist->where('id=%d', $movieid)->save($c);
        addtimeline($movieid, '编辑内容', '基础信息', $username, 'fa fa-file-text time-icon bg-info');
		if($_GET['admin']=='yes'){
			$this->success('上传成功！', U("admin/video"));
		}else{
			if ($_GET['getcontent']!=1){
				$this->success('上传成功！', U("movie/editcontent?movieid=" . $movieid));
			}else{
				$this->success('上传成功！', U("movie/editcontent?getcontent=1&movieid=" . $movieid));
			}
		}
    }
	public function showdoubanimg($url){
		$url="http://img4.douban.com/view/photo/photo/public/p".$url.".jpg";
		$data = file_get_contents($url);
		header("Content-type: image/jpg");
		echo  $data;
	}
}
?>
