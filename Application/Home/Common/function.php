<?php
function getuserinfo()
{
    if (!empty($_COOKIE['userinfo'])) {
        $uc = new \Ucenter\Client\Client();
        list($uid, $username) = explode("/t", $uc->_uc_authcode($_COOKIE['userinfo'], 'DECODE'));
    } else {
        $uid = $username = '';
    }
    return array(
        $uid,
        $username
    );
}
function getusernamebyid($uid)
{
    if (empty($uid)) {
        return '';
    }
    $user = M('userinfo');
    $data = $user->where('userid=%d', $uid)->field('username')->limit(1)->select();
    return $data[0]["username"];
}
function getmovienamebyid($movieid)
{
    if (empty($movieid)) {
        return '';
    }
    $movie = M('videolist');
    $data  = $movie->where('id=%d', $movieid)->field('name')->limit(1)->select();
    return $data[0]["name"];
}
function isMy($movieid, $uid)
{
    if (empty($uid)) {
        return 0;
    }
    $mvmylist = M('videofavorite');
    $data     = $mvmylist->where('userid=%d and movieid=%d', $uid, $movieid)->count();
    if ($data <> 0) {
        return '1';
    } else {
        return '0';
    }
}
function iswish($movieid, $uid)
{
    if (empty($uid)) {
        return 0;
    }
    $mvmylist = M('wishlist');
    $data     = $mvmylist->where('userid=%d and movieid=%d', $uid, $movieid)->count();
    if ($data <> 0) {
        return '1';
    } else {
        return '0';
    }
}
function mvshowusertype($userid, $movieid)
{
    if (empty($userid)) {
        return '';
    }
    if (in_array($userid,C('ADMIN_ID'))) {
        return '<label class="label bg-primary m-l-xs">管理员</label>';
    }
    $m    = M('localvideo');
    $data = $m->where('userid=%d and movieid=%d', $userid, $movieid)->cache(true,20)->count();
    if ($data <> 0) {
        return '<label class="label bg-success m-l-xs">上传者</label>';
    }
    $m    = M('videocontent');
    $data = $m->where('userid=%d and movieid=%d', $userid, $movieid)->cache(true,20)->count();
    if ($data <> 0) {
        return '<label class="label bg-info m-l-xs">内容编辑者</label>';
    }
    $m    = M('wishlist');
    $data = $m->where('userid=%d and movieid=%d', $userid, $movieid)->cache(true,20)->count();
    if ($data <> 0) {
        return '<label class="label bg-dark m-l-xs">请愿者</label>';
    }
	return '';
    //return '<label class="label bg-dark m-l-xs">用户</label>';
}
function videoinfo($path)
{
    str_replace("|", '', $path);
	str_replace("`", '', $path);
    $path = "Uploads/movie/" . $path;
    $re   = array();
    exec("ffmpeg -i $path 2>&1", $re);
    $info = implode("\n", $re);
    
    if (preg_match("/Invalid data/i", $info)) {
        return false;
    }
    /*  
    $match = array();  
    preg_match("/\d{2,}x\d+/", $info, $match);  
    list($width, $height) = explode("x", $match[0]);  
    */
    /*
    $match = array();  
    preg_match("/Duration:(.*?),/", $info, $match);  
    $duration = date("H:i:s", strtotime($match[1]));  
    */
    $match = array();
    preg_match("/Video:(.*?),/", $info, $match);
    $video = $match[1];
    
    $match = array();
    preg_match("/Audio:(.*?),/", $info, $match);
    $audio = $match[1];
    
    if (!$video && !$auido) {
        return false;
    } else {
        return array(
            $video,
            $audio
        );
    }
}
function videoshot($path)
{
    str_replace("|", '', $path);
	str_replace("`", '', $path);
    $path1 = "Uploads/movie/" . $path;
	$path2 = "Uploads/shot/" . $path . ".jpg";
    $re   = array();
    exec("ffmpeg -ss 00:02:06  -i $path1 $path2  -r 1 -vframes 1 -an -f mjpeg", $re);
}
function videocheckshot($path)
{
    str_replace("|", '', $path);
	str_replace("`", '', $path);
    $path1 = "Uploads/movie/" . $path;
	$timeshot=C('timeshot');
	$re   = array();
	if (!file_exists("Uploads/temp/" . $path . "/")){
		mkdir ("Uploads/temp/" . $path . "/");
		$flag=0;
	}else{
		$flag=1;
	}
	$shotlist=array();
	foreach($timeshot as $time){ 
		$path2 = "Uploads/temp/" . $path . "/".str_replace(":", '.', $time).".jpg";
		//echo "ffmpeg -ss $time  -i $path1 $path2  -r 1 -vframes 1 -an -f mjpeg"."<br>";
		if($flag==0){
			exec("ffmpeg -ss $time  -i $path1 $path2  -r 1 -vframes 1 -an -f mjpeg", $re);
		}
		if (file_exists($path2)){
			$shotlist[]=array('time'=>$time,'url'=>__ROOT__.'/'.$path2);
		}
	} 
	return $shotlist;
}
function getwishcount($movieid)
{
    $wishlist  = M('wishlist');
    $wishcount = $wishlist->where('movieid=%d', $movieid)->cache(true,600)->count();
    return $wishcount;
}
function getfacount($movieid)
{
    $videofavorite  = M('videofavorite');
    $count = $videofavorite->where('movieid=%d', $movieid)->cache(true,600)->count();
    return $count;
}
function addtimeline($movieid, $title, $content, $footer, $icon)
{
    $timeline     = M('videotimeline');
    $c['movieid'] = $movieid;
    $c['title']   = $title;
    $c['content'] = $content;
    $c['footer']  = $footer;
    $c['icon']    = $icon;
    $c['time']    = date('Y-m-d H:i:s');
    $timeline->add($c);
}
function getvideocontentstatus($movieid)
{
    $videocontent  = M('videocontent');
    if($count=$videocontent->where('verify=0 and movieid=%d', $movieid)->count()){
    	return '需要审核('.$count.')';
    }
    if($count=$videocontent->where('movieid=%d', $movieid)->count()){
    	return '正常('.$count.')';
    }
    return '暂无';
}
function getlocalvideostatus($movieid)
{
    $localvideo  = M('localvideo');
    if($count=$localvideo->where('verify=0 and movieid=%d', $movieid)->count()){
    	return '需要审核('.$count.')';
    }
    if($count=$localvideo->where('movieid=%d', $movieid)->count()){
    	return '正常('.$count.')';
    }
    return '暂无';
}
?>
