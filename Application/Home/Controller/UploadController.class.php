<?php
namespace Home\Controller;
use Think\Controller;
class UploadController extends GlobalAction
{
    public function _initialize()
    {
        //parent::_initialize();
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
			$url="http://img3.douban.com/view/photo/photo/public/p".I('post.posterurl').".jpg";
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
		$url="http://img3.douban.com/view/photo/photo/public/p".$url.".jpg";
		$data = file_get_contents($url);
		header("Content-type: image/jpg");
		echo  $data;
	}

    public function uploader()
    {
// Make sure file is not cached (as it happens for example on iOS devices)
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");

        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
            exit; // finish preflight CORS requests here
}

// 5 minutes execution time
        @set_time_limit(5 * 60);

// Settings
// $targetDir = ini_get("upload_tmp_dir") . DIRECTORY_SEPARATOR . "plupload";
        $targetDir = C('targetDir');
        $uploadDir = C('uploadDir');

        $cleanupTargetDir = true; // Remove old files
        $maxFileAge = 5 * 3600; // Temp file age in seconds


// Create target dir
        if (!file_exists($targetDir)) {
            @mkdir($targetDir);
        }

// Create target dir
        if (!file_exists($uploadDir)) {
            @mkdir($uploadDir);
        }

// Get a file name
        if (isset($_REQUEST["newname"])) {
            $fileName = $_REQUEST["newname"];
        } else {
            die('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "Name error."}, "id" : "id"}');
        }
        /*
                $md5File = @file('md5list2.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                $md5File = $md5File ? $md5File : array();

                if (isset($_REQUEST["md5"]) && array_search($_REQUEST["md5"], $md5File) !== FALSE) {
                    die('{"jsonrpc" : "2.0", "result" : null, "id" : "id", "exist": 1}');
                }
        */

        //check file ext
        $allow_file = explode(",", C('allow_ext')); //允许上传的文件类型组
        $new_upload_file_ext = strtolower(end(explode(".", $fileName))); //取得被.隔开的最后字符串
        if (!in_array($new_upload_file_ext, $allow_file)) { //如果不在组类，提示处理
            die('{"jsonrpc" : "2.0", "error" : {"code": -601, "message": "File extension error."}, "id" : "id"}');
        }

        $filePath = $targetDir . DIRECTORY_SEPARATOR . $fileName;
        $uploadPath = $uploadDir . DIRECTORY_SEPARATOR . $fileName;

// Chunking might be enabled
        $chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
        $chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 0;


// Remove old temp files
        if ($cleanupTargetDir) {
            if (!is_dir($targetDir) || !$dir = opendir($targetDir)) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "Failed to open temp directory."}, "id" : "id"}');
            }

            while (($file = readdir($dir)) !== false) {
                $tmpfilePath = $targetDir . DIRECTORY_SEPARATOR . $file;

                // If temp file is current file proceed to the next
                if ($tmpfilePath == "{$filePath}.part") {
                    continue;
                }

                // Remove temp file if it is older than the max age and is not the current file
                if (preg_match('/\.part$/', $file) && (filemtime($tmpfilePath) < time() - $maxFileAge)) {
                    @unlink($tmpfilePath);
                }
            }
            closedir($dir);
        }


// Open temp file
        if (!$out = @fopen("{$filePath}.part", $chunks ? "ab" : "wb")) {
            die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
        }

        if (!empty($_FILES)) {
            if ($_FILES["file"]["error"] || !is_uploaded_file($_FILES["file"]["tmp_name"])) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 103, "message": "Failed to move uploaded file."}, "id" : "id"}');
            }

            // Read binary input stream and append it to temp file
            if (!$in = @fopen($_FILES["file"]["tmp_name"], "rb")) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
            }
        } else {
            if (!$in = @fopen("php://input", "rb")) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
            }
        }

        while ($buff = fread($in, 4096)) {
            fwrite($out, $buff);
        }

        @fclose($out);
        @fclose($in);

// Check if file has been uploaded
        if (!$chunks || $chunk == $chunks - 1) {
            /*
            array_push($md5File, mymd5($uploadPath));
            $md5File = array_unique($md5File);
            file_put_contents('md5list2.txt', join($md5File, "\n"));*/
            //var_dump($_GET);
            $movieid = I('request.movieid');
            list($uid, $username) = getuserinfo();
            if (empty($uid)) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "Not login."}, "id" : "id"}');
            }
            $locallist = M('localvideo');
            $c['userid'] = $uid;
            $c['movieid'] = $movieid;
            $c['url'] = $uploadPath;
            if (!empty($_REQUEST['editname'])) {
                $c['title'] = I('request.editname');
            } else {
                die('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "No name."}, "id" : "id"}');
            }
            if (in_array($uid, C('ADMIN_ID'))) {
                $c['verify'] = 1;
                changeuploadstatus($movieid);
                changemovieverify($movieid);
            } else {
                $c['verify'] = 0;
            }
            $c['time'] = date('Y-m-d H:i:s');
            //判断能否在线播放
            list($video, $audio) = videoinfo($uploadPath);
            if (strpos($video, "h264")) { //&&strpos($audio,"aac")){
                $c['online'] = 1;
                //视频截图
                videoshot($uploadPath);
            } else {
                $c['online'] = 0;
            }
            $locallist->add($c);
            addtimeline($movieid, '上传视频', $c['title'], $username, 'fa fa-cloud-upload time-icon bg-dark');
            //$this->success("上传成功", U("movie/show?id=" . $movieid));

            // Strip the temp .part suffix off
            rename("{$filePath}.part", $filePath);
            rename($filePath, $uploadPath);
        }
        /*
                function mymd5($file)
                {
                    $fragment = 65536;

                    $rh = fopen($file, 'rb');
                    $size = filesize($file);

                    $part1 = fread($rh, $fragment);
                    fseek($rh, $size - $fragment);
                    $part2 = fread($rh, $fragment);
                    fclose($rh);

                    return md5($part1 . $part2);
                }*/


// Return Success JSON-RPC response
        die('{"jsonrpc" : "2.0", "result" : null, "id" : "id"}');
    }
}