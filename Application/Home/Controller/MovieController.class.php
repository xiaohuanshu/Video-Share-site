<?php
namespace Home\Controller;
use Think\Controller;
class MovieController extends GlobalAction
{
    public function _initialize()
    {
        parent::_initialize();
        
    }
    public function index()
    {
        header("location:".U('Movie/mlist'));
    }
    public function show($id)
    {
		list($uid, $username) = getuserinfo();
    	//视频基础信息
    	$movieinfo = M('videolist');
    	$data      = $movieinfo->where('id=%d', $id)->field('id,name,image,type,playcount,downloadcount,verify')->limit(1)->select();
    	$this->assign('movieinfo', $data[0]);
		//视频简介
		if(empty($_GET['contentid'])){
        	$contentlist = M('videocontent');
        	$data        = $contentlist->where('verify=1 and movieid=%d', $id)->order('time desc')->limit(1)->select();
        	$this->assign('mvcontent', $data[0]);
		}else{
        	$contentlist = M('videocontent');
        	$data        = $contentlist->where('verify=1 and movieid=%d and id=%d', $id, $_GET['contentid'])->order('time desc')->limit(1)->select();
        	$this->assign('mvcontent', $data[0]);
			$this->assign('mvcontentid', I('get.contentid'));
		}
        //时间线信息
        $timeline = M('videotimeline');
        $data     = $timeline->where('movieid=%d', $id)->order('time')->cache(true,600)->select();
        $this->assign('timeline', $data);
        //下载地址信息
        $locallist = M('localvideo');
        $data      = $locallist->where('movieid=%d and verify=1', $id)->cache(true,60)->select();
        //下载资源数量
        $listcount = $locallist->where('verify=1 and movieid=%d', $id)->cache(true,60)->count();
        $this->assign('listempty', '<tr><td>没有视频资源</td><td></td><td></td></tr>');
        $this->assign('locallist', $data);
        $this->assign('listcount', $listcount);
        //情愿数量
        $wishlist  = M('wishlist');
        $wishcount = $wishlist->where('movieid=%d', $id)->cache(true,600)->count();
        $this->assign('wishcount', $wishcount);
        //喜爱人数
        /*$mvlikelist  = M('mvlikelist');
        $mvlikecount = $mvlikelist->where('movieid=%d',$_GET['id'])->count();
        $this->assign('mvlikecount', $mvlikecount);*/
        //收藏人数
        $mvfalist  = M('videofavorite');
        $mvfacount = $mvfalist->where('movieid=%d', $id)->cache(true,600)->count();
        $this->assign('mvfacount', $mvfacount);
        //评论加载
        $mvcommentlist  = M('videocomment');
        $mvcommentcount = $mvcommentlist->where('movieid=%d', $id)->cache(true,600)->count();
        $this->assign('mvcommentcount', $mvcommentcount);
        $commentlist = $mvcommentlist->where('movieid=%d', $id)->select();
        $this->assign('commentlist', $commentlist);
        //播放功能加载
        if (!empty($_GET['playid'])) {
            $this->assign('playid', I('get.playid'));
            //$locallist = M('locallist');
            $data = $locallist->where('movieid=%d and verify=1 and id=%d', $id, I('get.playid'))->limit(1)->select();
            //dump($data);
			$movieinfo->where('id=%d',$id)->setInc('playcount',1);
            $this->assign('playlist', $data);
        }
        //判断是否存在未审核资源
		if(!empty($uid)){
			if($locallist->where('verify=0 and movieid=%d and userid=%d', $id, $uid)->count()){
				$this->assign('localV', 1);
			}
			if($contentlist->where('verify=0 and movieid=%d and userid=%d', $id, $uid)->count()){
				$this->assign('contentV', 1);
			}
			if($locallist->where('verify=0 and movieid=%d', $id)->count()){
				$this->assign('localO', 1);
			}
			if($contentlist->where('verify=0 and movieid=%d', $id)->count()){
				$this->assign('contentO', 1);
			}
		}
        $this->display();
        
    }
    public function mlist()
    {
        $movielist           = M('videolist');
        $sql['uploadstatus'] = 1;
        if (empty($_GET['userid'])) {
            $sql['verify'] = 1;
        }
        if (!empty($_GET['type'])) {
            $sql['type'] = array(
                'like',
                '%' . I('get.type') . '%'
            );
        }
        if (!empty($_GET['name'])) {
            $sql['name'] = array(
                'like',
                '%' . I('get.name') . '%'
            );
        }
        if (!empty($_GET['userid'])) {
            $count = $movielist->join("join `think_localvideo` on  `think_videolist`.`id`=`think_localvideo`.`movieid` and `think_localvideo`.`userid` = " . intval($_GET['userid']))->group('`think_videolist`.`id`')->where($sql)->count(); // 查询满足要求的总记录数
        } else {
            $count = $movielist->where($sql)->count(); // 查询满足要求的总记录
        }
        $Page = new \Think\Page($count, 12); // 实例化分页类 传入总记录数和每页显示的记录数
        $show = $Page->show(); // 分页显示输出
        if (empty($_GET['userid'])) {
            $data = $movielist->where($sql)->order('uploadtime desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();
            //dump($data);
        } else {
            $data = $movielist->join("join `think_localvideo` on  `think_videolist`.`id`=`think_localvideo`.`movieid` and `think_localvideo`.`userid` = " . intval($_GET['userid']))->group('`think_videolist`.`id`')->where($sql)->order('uploadtime desc')->limit($Page->firstRow . ',' . $Page->listRows)->field('`think_videolist`.*')->select();
            //echo $data;
            //die();
        }
        
        $this->assign('movielist', $data);
        $this->assign('type', I('get.type'));
        $this->assign('searchid', I('get.userid'));
        $this->assign('page', $show); // 赋值分页输出
        $this->display();
        
    }
    public function myfa()
    {
        list($uid, $username) = getuserinfo();
        if (empty($uid)) {
            $this->error('您还没有登录');
        }
        $movielist = M('videolist');
        $count     = $movielist->join('`think_videofavorite` on  `think_videofavorite`.`userid`=' . $uid . ' and `think_videolist`.`id`=`think_videofavorite`.`movieid`')->count(); // 查询满足要求的总记录数
        $Page      = new \Think\Page($count, 12); // 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show      = $Page->show(); // 分页显示输出
        $data      = $movielist->join('`think_videofavorite` on  `think_videofavorite`.`userid`=' . $uid . ' and `think_videolist`.`id`=`think_videofavorite`.`movieid`')->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $this->assign('movielist', $data);
        $this->assign('page', $show); // 赋值分页输出
        $this->display();
        
    }
    public function downloadinc($movieid)
    {
        $videolist = M('videolist');
        $videolist->where('id=%d',$movieid)->setInc('downloadcount',1);
    }
    public function ifa($movieid)
    {
        list($uid, $username) = getuserinfo();
        if (empty($uid)) {
            die();
        }
        if (empty($_GET['movieid'])) {
            die();
        }
        $movielist = M('videofavorite');
        $count     = $movielist->where("movieid=%d and userid=%d", $movieid, $uid)->count();
        if ($count == 0) {
            $data['userid']  = $uid;
            $data['movieid'] = $movieid;
            $movielist->add($data);
        } else {
            $movielist->where('userid=%d and movieid=%d', $uid, $movieid)->delete();
        }
    }
    public function iwish($movieid)
    {
        list($uid, $username) = getuserinfo();
        if (empty($uid)) {
            die();
        }
        $movielist = M('wishlist');
        $count     = $movielist->where('userid=%d and movieid=%d', $uid, $movieid)->count();
        if ($count == 0) {
            $data['userid']  = $uid;
            $data['movieid'] = $movieid;
            $data['time']    = date('Y-m-d H:i:s');
            $movielist->add($data);
        } else {
            $movielist->where('userid=%d and movieid=%d', $uid, $movieid)->delete();
        }
    }
    public function upload($movieid)
    {
        list($uid, $username) = getuserinfo();
        if (empty($uid)) {
            $this->error('您还没有登录');
        }
        $this->assign('movieid', I('get.movieid'));
        $this->display();
    }
    public function wish()
    {
        $movielist = M('videolist');
        $wedit     = $movielist->where('verify=1 and uploadstatus=0')->select(); // 查询满足要求的总记录数
        $this->assign('wishlist', $wedit); // 赋值分页输出
        $this->display();
    }
    public function addtitle()
    {
        list($uid, $username) = getuserinfo();
        if (empty($uid)) {
            $this->error('您还没有登录');
        }
        if (empty($_POST['mv_name'])) {
            if (!empty($_GET['wish'])) {
                $this->assign('iswish', 1);
            }
            $this->display();
        } else {
            $movielist = M('videolist');
            if (!$movielist->autoCheckToken($_POST)) {
                $this->error("令牌验证错误,请返回重试"); // 令牌验证错误
            }
            $data = $movielist->where('name=%s', I('post.mv_name'))->limit(1)->select();
            if ($_POST['iswish'] == 1) {
                if($data){
                    header("location:".U('Movie/show?id='.$data[0]['id']));
                }else{
                    $c['name']     = I('post.mv_name');
                    $c['verify']  = 1;
                    $c['time'] = date('Y-m-d H:i:s');
                    $c['wishtime'] = date('Y-m-d H:i:s');
                    $movieid       = $movielist->add($c);
                    $wishlist      = M('wishlist');
    				$wc['movieid']  = $movieid;
    				$wc['userid']   = $uid;
                    $wc['time'] = date('Y-m-d H:i:s');
                    $wishlist->add($wc);
                    addtimeline($movieid, '请愿发布', I('post.mv_name'), $username, 'fa fa-gift time-icon bg-primary');
                    header("location:".U('Movie/wishsuccess?movieid='.$movieid));
                }
            } else {
                if($data){
                    header("location:".U('Movie/upload?movieid='.$data[0]['id']));
                }else{
                    $c['name']     = I('post.mv_name');
                    //$c['statue']  = 1;
                    $c['wishtime'] = date('Y-m-d H:i:s');
                    $c['time'] = date('Y-m-d H:i:s');
                    $movieid       = $movielist->add($c);
                    header("location:".U('Movie/upload?movieid='.$movieid));
                }
            }
        }
    }
    public function wishsuccess($movieid)
    {
        $this->assign('movieid', I('get.movieid'));
        $this->display();
        
    }
    public function edit($movieid)
    {
        list($uid, $username) = getuserinfo();
        if (empty($uid)) {
            $this->error('您还没有登录');
        }
        $this->assign('movieid', I('get.movieid'));
        $movielist = M("videolist");
        $data      = $movielist->where('id=%d', $movieid)->select();
        if($data[0]['image']!=''&&$_GET['admin']!='yes'){
            header("location:".U('Movie/editcontent?movieid='.$movieid));
        }
		$doubandata=douban($data[0]['name']);
		if($doubandata){
			$this->assign('doubandata', $doubandata);
			if($_GET['getcontent']==1){
				$this->assign('getcontent', 1);
			}
		}
        $this->assign('movieinfo', $data[0]);
        $this->display();
    }
    public function editcontent($movieid)
    {
        list($uid, $username) = getuserinfo();
        if (empty($uid)) {
            $this->error('您还没有登录');
        }
        $this->assign('movieid', I('get.movieid'));
        $movielist = M("videolist");
        $data      = $movielist->where('id=%d', $movieid)->limit(1)->select();
		$name = $data[0]['name'];
        $this->assign('movieinfo', $data[0]);
        $contentlist = M('videocontent');
		if(empty($_GET['contentid'])){
			$data        = $contentlist->where('verify=1 and movieid=%d', $movieid)->order('time desc')->limit(1)->select();
			if($_GET['admin']!="yes"&&$_GET['getcontent']==1){
				$doubandata=douban($name);
				if($doubandata){
					//str_replace(array('\r\n', '\r', '\n'),'<br/>',$doubandata['info']);
					//dump($doubandata['info']);
					//exit;
					$this->assign('doubandata', $doubandata);
					$this->assign('getcontent', 1);
				}
			}
		}else{
			$data        = $contentlist->where('verify=1 and id=%d', $_GET['contentid'])->limit(1)->select();
		}
        $this->assign('mvcontent', $data[0]);
        $this->display();
        
    }
    public function editcontentdeal($movieid)
    {
        list($uid, $username) = getuserinfo();
        if (empty($uid)) {
            $this->error('您还没有登录');
        }
        $contentlist = M('videocontent');
        if (!$contentlist->autoCheckToken($_POST)) {
            $this->error("令牌验证错误,请返回重试"); // 令牌验证错误
        }
        $c['movieid'] = $movieid;
        $c['userid']  = $uid;
        $xss      = new \Think\Xsshtml($_POST['intro']);
        $c['intro']   = $xss->getHtml();
        $xss      = new \Think\Xsshtml($_POST['content']);
        $c['content'] = $xss->getHtml();
		if (in_array($uid,C('ADMIN_ID'))) {
        	$c['verify']  = 1;
		}else{
			$c['verify']  = 0;
		}
        $c['time']    = date('Y-m-d H:i:s');
        $contentlist->add($c);
        addtimeline($movieid, '编辑内容', '视频介绍', $username, 'fa fa-file-text time-icon bg-success');
		if($_GET['admin']=='yes'){
			$this->success('编辑成功', U('admin/video'));
		}else{
			$this->success('编辑成功', U('Movie/show?id='.$movieid));
		}
    }
    public function addcomment($id)
    {
        $mvcommentlist = M('videocomment');
        // 手动进行令牌验证
        if (!$mvcommentlist->autoCheckToken($_POST)) {
            $this->error("令牌验证错误,请返回重试"); // 令牌验证错误
        }
        
        list($uid, $username) = getuserinfo();
        if (empty($uid)) {
            $this->error('您还没有登录');
        }
        if (empty($_POST['content'])) {
            $this->error('没有内容');
        }
		if(false === \Org\Util\SensitiveFilter::filter($_POST['content'])){
			$this->error("含有敏感词汇");
	 	}
        $c['userid']  = $uid;
        $c['content'] = I('post.content');
        $c['movieid'] = $id;
        $c['time']    = date('Y-m-d H:i:s');
        $mvcommentlist->add($c);
        header("location:" . $_SERVER['HTTP_REFERER'] . "#comment");
    }
}
?>
