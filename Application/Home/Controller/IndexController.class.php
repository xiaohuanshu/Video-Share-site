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
        if (empty($_GET['searchuser'])) {
            $userinfo = M('userinfo');
            $data     = $userinfo->order('registertime desc')->limit(10)->select();
            $this->assign('issearch', 0);
            $this->assign('newuserlist', $data);
        } else {
            $userinfo        = M('userinfo');
            $sql['username'] = array(
                'like',
                '%' . $_GET['searchuser'] . '%'
            );
            $sql['realname'] = array(
                'like',
                '%' . $_GET['searchuser'] . '%'
            );
            $sql['_logic']   = 'OR';
            $data            = $userinfo->where($sql)->select();
            $this->assign('issearch', 1);
            $this->assign('newuserlist', $data);
        }
        $movielist = M('videolist');
        $data      = $movielist->where('verify=1 and uploadstatus=1')->order('uploadtime desc')->limit(12)->select();
        $this->assign('movielist', $data);
        $announce = M('announce');
        $data     = $announce->order('time desc')->limit(1)->select();
        $this->assign('announce', $data[0]);
        $notice = M('notice');
        $data   = $notice->order('time desc')->limit(3)->select();
        $this->assign('noticelist', $data);
        $data = $movielist->where('uploadstatus=0')->order('wishtime desc')->limit(8)->select();
        $this->assign('wishlist', $data);
        $sharelist = M('localvideo');
        $data      = $sharelist->group('`think_localvideo`.`userid`')->order('COUNT(`think_localvideo`.`id`) desc')->limit(5)->field('userid , COUNT(  `think_localvideo`.`id` ) as c')->select();
        $this->assign('sharelist', $data);
        $this->display();
    }
    public function about()
    {
        $this->display();
    }
}
?>
