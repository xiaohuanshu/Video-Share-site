<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends GlobalAction
{
    public function _initialize()
    {
        parent::_initialize();
        
    }
    public function notfound()
    {
        header("HTTP/1.0 404 Not Found");
        $this->error("404 - 页面没有找到");
    }
    public function index()
    {
        list($uid, $username) = getuserinfo();
		//用户搜索相关
        if (empty($_GET['searchuser'])) {
            $userinfo = M('userinfo');
            $data     = $userinfo->order('registertime desc')->limit(10)->select();
            $this->assign('issearch', 0);
            $this->assign('newuserlist', $data);
        } else {
            $userinfo        = M('userinfo');
            $sql['username'] = array(
                'like',
                '%' . I('get.searchuser') . '%'
            );
            $sql['realname'] = array(
                'like',
                '%' . I('get.searchuser') . '%'
            );
            $sql['_logic']   = 'OR';
            $data            = $userinfo->where($sql)->select();
            $this->assign('issearch', 1);
            $this->assign('newuserlist', $data);
        }
		//视频信息
        $movielist = M('videolist');
        $data      = $movielist->where('verify=1 and uploadstatus=1')->order('uploadtime desc')->limit(18)->cache(true,30)->select();
        $this->assign('movielist', $data);
		
		//公告相关
        $announce = M('announce');
        $data     = $announce->order('time desc')->limit(1)->cache(true,600)->select();
        $this->assign('announce', $data[0]);
        $notice = M('notice');
        $data   = $notice->order('time desc')->limit(3)->cache(true,600)->select();
        $this->assign('noticelist', $data);
		
		//请愿信息
        $data = $movielist->where('verify=1 and uploadstatus=0')->order('wishtime desc')->limit(8)->select();
        $this->assign('wishlist', $data);
		//分享者排名
        $sharelist = M('localvideo');
        $data      = $sharelist->group('`think_localvideo`.`userid`')->order('COUNT(`think_localvideo`.`id`) desc')->limit(5)->field('userid , COUNT(  `think_localvideo`.`id` ) as c')->cache(true,21600)->select();
        $this->assign('sharelist', $data);
        $this->display();
    }
    public function about()
    {
        $this->display();
    }
}
?>
