<?php
namespace Home\Controller;
use Think\Controller;
class UploadController extends GlobalAction
{
    public function _initialize()
    {
        parent::_initialize();
    }
    public function uploadview()
    {
        list($uid, $username) = getuserinfo();
        if (empty($uid)) {
            $this->error('您还没有登录');
        }
        $this->assign('movieid', $_GET['movieid']);
        $this->display();
    }
    public function deal()
    {
        list($uid, $username) = getuserinfo();
        if (empty($uid)) {
            $this->error('您还没有登录');
        }
        for ($i = 0; $i <= intval($_POST['uploader_count']) - 1; $i++) {
            $uploader_tmpname[$i] = $_POST['uploader_' . $i . '_tmpname'];
            $uploader_name[$i]    = $_POST['uploader_' . $i . '_name'];
        }
        $this->assign('uploader_name', $uploader_name);
        $this->assign('uploader_tmpname', $uploader_tmpname);
        $this->assign('uploader_count', $_POST['uploader_count']);
        $this->assign('movieid', $_GET['movieid']);
        $this->display();
    }
    public function deal2()
    {
        list($uid, $username) = getuserinfo();
        if (empty($uid)) {
            $this->error('您还没有登录');
        }
        $locallist = M('localvideo');
        for ($i = 0; $i <= intval($_POST['uploader_count']) - 1; $i++) {
            $c['userid']  = $uid;
            $c['movieid'] = $_GET['movieid'];
            $c['url']     = '/share/Uploads/movie/' . $_POST['uploader_' . $i . '_tmpname'];
            $c['title']   = $_POST['uploader_' . $i . '_name'];
            $c['verify']  = 0;
            $c['time']    = date('Y-m-d H:i:s');
            //判断能否在线播放
            list($video, $audio) = videoinfo($_POST['uploader_' . $i . '_tmpname']);
            if (strpos($video, "h264")) { //&&strpos($audio,"aac")){
                $c['canplay'] = 1;
            } else {
                $c['canplay'] = 0;
            }
            $locallist->add($c);
        }
        addtimeline($_GET['movieid'], '上传视频', $_POST['uploader_' . $i . '_tmpname'], $username, 'fa fa-cloud-upload time-icon bg-dark');
        $this->success("上传成功", U("home/movie/show/id/" . $_GET['movieid']));
    }
    public function poster()
    {
        list($uid, $username) = getuserinfo();
        if (empty($uid)) {
            $this->error('您还没有登录');
        }
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
        } else { // 上传成功
            $filepath = './Uploads/' . $info['uimage']['savepath'] . $info['uimage']['savename'];
            $image    = new \Think\Image();
            $image->open($filepath);
            // 生成一个居中裁剪的缩略图
            $image->thumb(357, 526, \Think\Image::IMAGE_THUMB_CENTER)->save($filepath . '.thumb.jpg');
            if (empty($_POST['options'])) {
                $c['type'] = "其他";
            } else {
                $c['type'] = implode($_POST['options'], ',');
            }
            $c['time'] = $_POST['time'];
            $videolist = M('videolist');
            if (!$videolist->autoCheckToken($_POST)) {
                $this->error("令牌验证错误,请返回重试"); // 令牌验证错误
            }
            $c['image'] = '/share/Uploads/' . $info['uimage']['savepath'] . $info['uimage']['savename'];
            $videolist->where('id=%d', $_GET['movieid'])->save($c);
            addtimeline($_GET['movieid'], '编辑内容', '基础信息', $username, 'fa fa-file-text time-icon bg-info');
            $this->success('上传成功！', U("home/movie/editcontent/movieid/" . $_GET['movieid']));
        }
    }
}
?>
