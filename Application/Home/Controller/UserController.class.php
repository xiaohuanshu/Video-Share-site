<?php
namespace Home\Controller;
use Think\Controller;
class UserController extends GlobalAction
{
    public function _initialize()
    {
        parent::_initialize();
    }
    public function login()
    {       
        $uc = new \Ucenter\Client\Client();
        list($uid, $username, $password, $email) = $uc->uc_user_login($_GET['username'], $_GET['password']);
        if ($uid > 0) {
            $this->success('登录成功' . $uc->uc_user_synlogin($uid), U('index'), 5);
        } elseif ($uid == -1) {
            $this->error('用户不存在,或者被删除');
        } elseif ($uid == -2) {
            $this->error('密码错');
        } else {
            $this->error('未定义');
        }
    }
    public function logout()
    {       
        $uc = new \Ucenter\Client\Client();
        $this->success('注销成功' . $uc->uc_user_synlogout(), U('index'), 5);
    }
    public function messagecenter($action=0,$inf='',$inf2='')
    {       
        $uc = new \Ucenter\Client\Client();
		list($uid, $username) = getuserinfo();
        header('Location:'.$uc->uc_pm_location($uid,$action,$inf,$inf2));
    }
	public function register(){
		$this->show();
	}
	public function registerdeal(){
        $uc = new \Ucenter\Client\Client();
		$uid = $uc->uc_user_register($_POST['username'], $_POST['password'], $_POST['email'], get_client_ip());
		if($uid <= 0) {
			if($uid == -1) {
				$this->error('用户名不合法');
			} elseif($uid == -2) {
				$this->error('包含不允许注册的词语');
			} elseif($uid == -3) {
				$this->error('用户名已经存在');
			} elseif($uid == -4) {
				$this->error('Email 格式有误');
			} elseif($uid == -5) {
				$this->error('Email 不允许注册');
			} elseif($uid == -6) {
				$this->error('该 Email 已经被注册');
			} else {
				$this->error('未定义错误');
			}
		} else {
			$userinfo=M("userinfo");
	        if (!$userinfo->autoCheckToken($_POST)) {
	            $this->error("令牌验证错误,请返回重试"); // 令牌验证错误
	        }
			$c['userid']=$uid;
			$c['email']=$_POST['email'];
			$c['password']='real.'.$_POST['password'];
			$c['username']=$_POST['username'];
			$c['ip']=get_client_ip();
			$c['registertime']=date('Y-m-d H:i:s');
			if($userinfo->add($c)){
				$this->success('注册成功' . $uc->uc_user_synlogin($uid), U('user/setting'), 5);
			}else{
				$this->error('未定义错误');
			}
		}
	}
	public function setting(){
        list($uid, $username) = getuserinfo();
        if (empty($uid)) {
            $this->error('您还没有登录');
        }
		$userinfo=M("userinfo");
		$data=$userinfo->where("userid=%d",$uid)->limit(1)->select();
		$this->assign('userinfo', $data[0]);
		//头像
		$uc = new \Ucenter\Client\Client();
		$this->assign('avatar', $uc->uc_avatar($uid));
		$this->show();
	}
	public function settingdeal(){
        list($uid, $username) = getuserinfo();
        if (empty($uid)) {
            $this->error('您还没有登录');
        }
		$userinfo=M('userinfo');
        if (!$userinfo->autoCheckToken($_POST)) {
            $this->error("令牌验证错误,请返回重试"); // 令牌验证错误
        }
		$c['sex']=$_POST['sex'];
		$c['studentid']=$_POST['studentid'];
		$c['realname']=$_POST['realname'];
		$c['qq']=$_POST['qq'];
		$c['college']=$_POST['college'];
		$c['major']=$_POST['major'];
		$c['intro']=$_POST['intro'];
		if(!empty($_POST['password'])){
			$uc = new \Ucenter\Client\Client();
			$ucresult = $uc->uc_user_edit($username, '', $_POST['password'], '',1);
			$c['password']="real.".$_POST['password'];
		}
		if($userinfo->where("userid=%d",$uid)->save($c)){
			$this->success('修改成功', U('user/setting'), 3);
		}else{
			$this->error('修改失败');
		}
	}
	public function profile($uid){
		$userinfo=M("userinfo");
		$data=$userinfo->where("userid=%d",$uid)->limit(1)->select();
		$this->assign('userinfo', $data[0]);
		$movielist=M('videolist');
		$localvideo=M('localvideo');
		$uploadcount=$localvideo->where('userid=%d',$uid)->cache(true,600)->count();
		$wishlist=M('wishlist');
		$wishcount=$wishlist->where('userid=%d',$uid)->cache(true,600)->count();
		$uploadlist = $movielist->join("join `think_localvideo` on  `think_videolist`.`id`=`think_localvideo`.`movieid` and `think_localvideo`.`userid` = " . intval($uid))->group('`think_videolist`.`id`')->limit(12)->cache(true,600)->select();
		$wishlist = $movielist->join("join `think_wishlist` on  `think_videolist`.`id`=`think_wishlist`.`movieid` and `think_wishlist`.`userid` = " . intval($uid))->group('`think_videolist`.`id`')->limit(12)->cache(true,600)->select();
		$videocomment=M('videocomment');
		$commentlist=$videocomment->where('userid=%d',$uid)->limit(12)->cache(true,600)->select();
		$this->assign('uploadcount', $uploadcount);
		$this->assign('wishcount', $wishcount);
		$this->assign('uploadlist', $uploadlist);
		$this->assign('wishlist', $wishlist);
		$this->assign('commentlist', $commentlist);
		$this->show();
	}
}
?>
