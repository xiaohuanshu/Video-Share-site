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
    public function show()
    {
		list($uid, $username) = getuserinfo();
        //视频基础信息
        $movieinfo = M('videolist');
        $data      = $movieinfo->where('id=%d', $_GET['id'])->field('id,name,image,type,playcount,downloadcount')->limit(1)->select();
        $this->assign('movieinfo', $data[0]);
        //视频简介
        $contentlist = M('videocontent');
        $data        = $contentlist->where('verify=1 and movieid=%d', $_GET['id'])->order('time desc')->limit(1)->select();
        $this->assign('mvcontent', $data[0]);
        //时间线信息
        $timeline = M('videotimeline');
        $data     = $timeline->where('movieid=%d', $_GET['id'])->order('time')->cache(true,600)->select();
        $this->assign('timeline', $data);
        //下载地址信息
        $locallist = M('localvideo');
        $data      = $locallist->where('movieid=%d and verify=1', $_GET['id'])->cache(true,60)->select();
        //下载资源数量
        $listcount = $locallist->where('verify=1 and movieid=%d', $_GET['id'])->cache(true,60)->count();
        $this->assign('listempty', '<tr><td>没有视频资源</td><td></td><td></td></tr>');
        $this->assign('locallist', $data);
        $this->assign('listcount', $listcount);
        //情愿数量
        $wishlist  = M('wishlist');
        $wishcount = $wishlist->where('movieid=%d', $_GET['id'])->cache(true,600)->count();
        $this->assign('wishcount', $wishcount);
        //喜爱人数
        /*$mvlikelist  = M('mvlikelist');
        $mvlikecount = $mvlikelist->where('movieid=%d',$_GET['id'])->count();
        $this->assign('mvlikecount', $mvlikecount);*/
        //收藏人数
        $mvfalist  = M('videofavorite');
        $mvfacount = $mvfalist->where('movieid=%d', $_GET['id'])->cache(true,600)->count();
        $this->assign('mvfacount', $mvfacount);
        //评论加载
        $mvcommentlist  = M('videocomment');
        $mvcommentcount = $mvcommentlist->where('movieid=%d', $_GET['id'])->cache(true,600)->count();
        $this->assign('mvcommentcount', $mvcommentcount);
        $commentlist = $mvcommentlist->where('movieid=%d', $_GET['id'])->select();
        $this->assign('commentlist', $commentlist);
        //播放功能加载
        if (!empty($_GET['playid'])) {
            $this->assign('playid', $_GET['playid']);
            //$locallist = M('locallist');
            $data = $locallist->where('movieid=%d and verify=1 and id=%d', $_GET['id'], $_GET['playid'])->limit(1)->select();
            //dump($data);
			$movieinfo->where('id=%d',$_GET['id'])->setInc('playcount',1);
            $this->assign('playlist', $data);
        }
        //判断是否存在未审核资源
		if(!empty($uid)){
			if($locallist->where('verify=0 and movieid=%d and userid=%d', $_GET['id'], $uid)->count()){
				$this->assign('localV', 1);
			}
			if($contentlist->where('verify=0 and movieid=%d and userid=%d', $_GET['id'], $uid)->count()){
				$this->assign('contentV', 1);
			}
			if($locallist->where('verify=0 and movieid=%d', $_GET['id'])->count()){
				$this->assign('localO', 1);
			}
			if($contentlist->where('verify=0 and movieid=%d', $_GET['id'])->count()){
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
                '%' . $_GET['type'] . '%'
            );
        }
        if (!empty($_GET['name'])) {
            $sql['name'] = array(
                'like',
                '%' . $_GET['name'] . '%'
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
        $this->assign('type', $_GET['type']);
        $this->assign('searchid', $_GET['userid']);
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
    public function ifa()
    {
        list($uid, $username) = getuserinfo();
        if (empty($uid)) {
            die();
        }
        if (empty($_GET['movieid'])) {
            die();
        }
        $movielist = M('videofavorite');
        $count     = $movielist->where("movieid=%d and userid=%d", $_GET['movieid'], $uid)->count();
        if ($count == 0) {
            $data['userid']  = $uid;
            $data['movieid'] = $_GET['movieid'];
            $movielist->add($data);
        } else {
            $movielist->where('userid=%d and movieid=%d', $uid, $_GET['movieid'])->delete();
        }
    }
    public function iwish()
    {
        list($uid, $username) = getuserinfo();
        if (empty($uid)) {
            die();
        }
        if (empty($_GET['movieid'])) {
            die();
        }
        $movielist = M('wishlist');
        $count     = $movielist->where('userid=%d and movieid=%d', $uid, $_GET['movieid'])->count();
        if ($count == 0) {
            $data['userid']  = $uid;
            $data['movieid'] = $_GET['movieid'];
            $data['time']    = date('Y-m-d H:i:s');
            $movielist->add($data);
        } else {
            $movielist->where('userid=%d and movieid=%d', $uid, $_GET['movieid'])->delete();
        }
    }
    public function upload()
    {
        list($uid, $username) = getuserinfo();
        if (empty($uid)) {
            $this->error('您还没有登录');
        }
        $this->assign('movieid', $_GET['movieid']);
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
            if ($_POST['iswish'] == 1) {
                $c['name']     = $_POST['mv_name'];
                $c['verify']  = 1;
                $c['wishtime'] = date('Y-m-d H:i:s');
                $movieid       = $movielist->add($c);
                $wishlist      = M('wishlist');
				$wc['movieid']  = $movieid;
				$wc['userid']   = $uid;
                $wc['time'] = date('Y-m-d H:i:s');
                $wishlist->add($wc);
                addtimeline($movieid, '请愿发布', $_POST['mv_name'], $username, 'fa fa-gift time-icon bg-primary');
                header("location:".U('Movie/wishsuccess?movieid='.$movieid));
            } else {
                $c['name']     = $_POST['mv_name'];
                //$c['statue']  = 1;
                $c['wishtime'] = date('Y-m-d H:i:s');
                $movieid       = $movielist->add($c);
                header("location:".U('Movie/upload?movieid='.$movieid));
            }
        }
    }
    public function wishsuccess($movieid)
    {
        $this->assign('movieid', $movieid);
        $this->display();
        
    }
    public function edit($movieid)
    {
        list($uid, $username) = getuserinfo();
        if (empty($uid)) {
            $this->error('您还没有登录');
        }
        $this->assign('movieid', $movieid);
        $movielist = M("videolist");
        $data      = $movielist->where('id=%d', $movieid)->select();
        if($data[0]['image']!=''&&$_GET['admin']!='yes'){
            header("location:".U('Movie/editcontent?movieid='.$movieid));
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
        $this->assign('movieid', $movieid);
        $movielist = M("videolist");
        $data      = $movielist->where('id=%d', $movieid)->limit(1)->select();
        $this->assign('movieinfo', $data[0]);
        $contentlist = M('videocontent');
        $data        = $contentlist->where('verify=1 and movieid=%d', $movieid)->order('time desc')->limit(1)->select();
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
        addtimeline($movieid, '编辑内容', '视频介绍', $username, 'fa fa-file-text time-icon bg-info');
		if($_GET['admin']=='yes'){
			$this->success('编辑成功', U('admin/video'));
		}else{
			$this->success('编辑成功', U('Movie/show?id='.$movieid));
		}
    }
    public function addcomment()
    {
        if (empty($_POST)) {
            $this->error('没有获取到评论');
        }
        if (empty($_GET)) {
            $this->error('没有获取到视频地址');
        }
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
        $c['userid']  = $uid;
        $c['content'] = htmlspecialchars($_POST['content']);
        $c['movieid'] = $_GET['id'];
        $c['time']    = date('Y-m-d H:i:s');
        $mvcommentlist->add($c);
        header("location:" . $_SERVER['HTTP_REFERER'] . "#comment");
    }
}
?>
