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
    $data = $user->where('userid=%d', $uid)->select();
    return $data[0]["username"];
}
function getmovienamebyid($movieid)
{
    if (empty($movieid)) {
        return '';
    }
    $movie = M('videolist');
    $data  = $movie->where('id=%d', $movieid)->limit(1)->select();
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
    if ($userid == 1) {
        return '<label class="label bg-primary m-l-xs">管理员</label>';
    }
    $m    = M('localvideo');
    $data = $m->where('userid=%d and movieid=%d', $userid, $movieid)->count();
    if ($data <> 0) {
        return '<label class="label bg-success m-l-xs">上传者</label>';
    }
    $m    = M('videocontent');
    $data = $m->where('userid=%d and movieid=%d', $userid, $movieid)->count();
    if ($data <> 0) {
        return '<label class="label bg-info m-l-xs">内容编辑者</label>';
    }
    $m    = M('wishlist');
    $data = $m->where('userid=%d and movieid=%d', $userid, $movieid)->count();
    if ($data <> 0) {
        return '<label class="label bg-dark m-l-xs">请愿者</label>';
    }
    return '<label class="label bg-dark m-l-xs">用户</label>';
}
function videoinfo($path)
{
    str_replace("|", '', $path);
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
function getwishcount($movieid)
{
    $wishlist  = M('wishlist');
    $wishcount = $wishlist->where('movieid=%d', $movieid)->count();
    return $wishcount;
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
?>
