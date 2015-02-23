<?php
namespace Home\Controller;
use Think\Controller;
class GlobalAction extends Controller
{
    function _empty()
    {
        header("HTTP/1.0 404 Not Found");
        $this->error("404 - 页面没有找到");
    }
    public function _initialize()
    {
        $this->assign('searchname', htmlspecialchars($_GET['name']));
        list($uid, $username) = getuserinfo();
        if ($uid == '') {
            $this->assign('islogin', 0);
        } else {
            $this->assign('islogin', 1);
            $this->assign('username', $username);
            $this->assign('uid', $uid);
            $uc             = new \Ucenter\Client\Client();
            $messagenewlist = $uc->uc_pm_list($uid, 1, 4, 'newbox', 'newpm', 10);
            $this->assign('messagemember', $messagenewlist['count']);
            $this->assign('messagelist', $messagenewlist['data']);
            $myfalist  = M('videofavorite');
            $myfacount = $myfalist->where('userid=%d', $uid)->count();
            if ($myfacount != 0) {
                $this->assign('myfacount', $myfacount);
            }
        }
        $movielist = M('videolist');
        $wishcount = $movielist->cache(true, 60)->where('verify=1 and uploadstatus=0')->count();
        if ($wishcount != 0) {
            $this->assign('wishnumber', $wishcount);
        }
    }
}
?>
