<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="cn" class="app">
<head>  
  <meta charset="utf-8" />
  <title>影视资源分享平台</title>
  <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <link rel="stylesheet" href="/share/Public/css/bootstrap.css" type="text/css" />
  <link rel="stylesheet" href="/share/Public/css/animate.css" type="text/css" />
  <link rel="stylesheet" href="/share/Public/css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="/share/Public/css/simple-line-icons.css" type="text/css" />
  <link rel="stylesheet" href="/share/Public/css/font.css" type="text/css" />
  <link rel="stylesheet" href="/share/Public/css/app.css" type="text/css" />  
    <!--[if lt IE 9]>
    <script src="/share/Public/js/ie/html5shiv.js"></script>
    <script src="/share/Public/js/ie/respond.min.js"></script>
    <script src="/share/Public/js/ie/excanvas.js"></script>
  <![endif]-->
</head>
<body class="">
  <section class="vbox">

<header class="bg-white-only header header-md navbar navbar-fixed-top-xs">
      <div class="navbar-header aside bg-info nav-xs">
        <a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen,open" data-target="#nav,html">
          <i class="icon-list"></i>
        </a>
        <a href="/share/home" class="navbar-brand text-lt">
          <i class="icon-grid"></i>
          <img src="/share/Public/images/logo.png" alt="." class="hide">
          <span class="hidden-nav-xs m-l-sm">MV Share</span>
        </a>
        <a class="btn btn-link visible-xs" data-toggle="dropdown" data-target=".user">
          <i class="icon-settings"></i>
        </a>
      </div>      <ul class="nav navbar-nav hidden-xs">
        <li>
          <a href="#nav,.navbar-header" data-toggle="class:nav-xs,nav-xs" class="text-muted">
            <i class="fa fa-indent text"></i>
            <i class="fa fa-dedent text-active"></i>
          </a>
        </li>
      </ul>
      <form class="navbar-form navbar-left input-s-lg m-t m-l-n-xs hidden-xs" role="search"  action="/share/home/movie/mlist" method="get">
        <div class="form-group">
          <div class="input-group">
            <span class="input-group-btn">
              <button type="submit" class="btn btn-sm bg-white btn-icon rounded"><i class="fa fa-search"></i></button>
            </span>
            <input name="name" type="text" class="form-control input-sm no-border rounded" placeholder="搜索影视资源..." value="<?php echo ($searchname); ?>">
          </div>
        </div>
      </form>
      <div class="navbar-right ">
<?php if(($islogin == 1)): ?><ul class="nav navbar-nav m-n hidden-xs nav-user user">
          <li class="hidden-xs">
            <a href="#" class="dropdown-toggle lt" data-toggle="dropdown">
              <i class="icon-bell"></i>
              <?php if(($messagemember != 0)): ?><span class="badge badge-sm up bg-danger count" style="display: inline-block;"><?php echo ($messagemember); ?></span><?php endif; ?>
            </a>
            <section class="dropdown-menu aside-xl animated fadeInUp">
              <section class="panel bg-white">
                <div class="panel-heading b-light bg-light">
                  <strong>你有 <span class="count" style="display: inline;"><?php echo ($messagemember); ?></span> 个提醒</strong>
                </div>
                <div class="list-group list-group-alt">
<?php if(is_array($messagelist)): $i = 0; $__LIST__ = $messagelist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$mdata): $mod = ($i % 2 );++$i;?><a href="/forum/home.php?mod=space&do=pm&subop=view&plid=<?php echo ($mdata["plid"]); ?>" class="media list-group-item">
                    <span class="pull-left thumb-sm text-center">
                      <i class="fa fa-envelope-o fa-2x text-success"></i>
                    </span>
                    <span class="media-body block m-b-none">
                      <?php echo ($mdata["lastauthor"]); ?>发送消息:<?php echo ($mdata["lastsummary"]); ?><br>
                      <small class="text-muted">
<?php switch($mdata["daterange"]): case "1": ?>今天<?php break;?>
    <?php case "2": ?>昨天<?php break;?>
    <?php case "3": ?>前天<?php break;?>
    <?php case "4": ?>上周<?php break;?>
    <?php case "5": ?>更早<?php break;?>
    <?php default: ?>未知时间<?php endswitch;?>
</small>
                    </span>
                  </a><?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
                <div class="panel-footer text-sm">
                  <a href="/forum/home.php?mod=space&do=pm&subop=setting" class="pull-right"><i class="fa fa-cog"></i></a>
                  <a href="/forum/home.php?mod=space&do=pm">进入短消息中心</a>
                </div>
              </section>
            </section>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle bg clear" data-toggle="dropdown">
              <span class="thumb-sm avatar pull-right m-t-n-sm m-b-n-sm m-l-sm">
                <img src="/ucenter/avatar.php?uid=<?php echo ($uid); ?>&type=virtual&size=middle" alt="...">
              </span>
              <?php echo ($username); ?> <b class="caret"></b>
            </a>
            <ul class="dropdown-menu animated fadeInRight">            
              <li>
                <span class="arrow top"></span>
                <a href="#">设置</a>
              </li>
              <li>
                <a href="/share/home/user/profile/uid/<?php echo ($uid); ?>">主页</a>
              </li>
              <li>
                <a href="/forum/home.php?mod=space&do=pm">
                  <?php if(($messagemember != 0)): ?><span class="badge bg-danger pull-right"><?php echo ($messagemember); ?></span><?php endif; ?>
                  消息
                </a>
              </li>
              <li>
                <a href="docs.html">帮助</a>
              </li>
              <li class="divider"></li>
              <li>
                <a href="/share/home/user/logout">注销</a>
              </li>
            </ul>
          </li>
        </ul>
<?php else: ?>
<ul class="nav navbar-nav m-n hidden-xs nav-user user">
          <li class="">
              <a href="#modal-login" data-toggle="modal">登录</a>
          </li>
<li class="">
            <a href="/share/home/user/register">
              注册
            </a>
          </li>
        </ul><?php endif; ?>
      </div>      
    </header>

<section>
      <section class="hbox stretch">
        <!-- .aside -->
        <aside class="bg-black dk aside hidden-print nav-xs" id="nav">          
          <section class="vbox">
            <section class="w-f-md scrollable">
              <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 78px;"><div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="10px" data-railopacity="0.2" style="overflow: hidden; width: auto; height: 78px;">
                


                <!-- nav -->                 
                <nav class="nav-primary hidden-xs">
                  <ul class="nav bg clearfix">
                    <li class="hidden-nav-xs padder m-t m-b-sm text-xs text-muted">
                      导航
                    </li>
                    <li>
                      <a href="/share/home">
                        <i class="icon-speedometer icon text-success"></i>
                        <span class="font-bold">动态</span>
                      </a>
                    </li>
                    <li>
                      <a href="/share/home/movie/mlist">
                        <i class="icon-film icon text-info"></i>
                        <span class="font-bold">影视</span>
                      </a>
                    </li>
                    <li>
                      <a href="/share/home/movie/wish">
                        <i class="icon-present icon text-primary-lter"></i>
<?php if(!empty($wishnumber)): ?><b class="badge bg-primary pull-right"><?php echo ($wishnumber); ?></b><?php endif; ?>
                        <span class="font-bold">请愿</span>
                      </a>
                    </li>
                    <li>
                      <a href="/share/home/movie/addtitle">
                        <i class="icon-cloud-upload icon  text-info-dker"></i>
                        <span class="font-bold">上传</span>
                      </a>
                    </li>
                    <!--<li>
                      <a href="/forum">
                        <i class="icon-users icon  text-success"></i>
                        <span class="font-bold">论坛</span>
                      </a>
                    </li>-->
                    <!--<li>
                      <a href="video.html" data-target="#content" data-el="#bjax-el" data-replace="true">
                        <i class="icon-social-youtube icon  text-primary"></i>
                        <span class="font-bold">Video</span>
                      </a>
                    </li> -->
                    <li class="m-b hidden-nav-xs"></li>
                  </ul>
                  
                  <ul class="nav text-sm">
                    <li class="hidden-nav-xs padder m-t m-b-sm text-xs text-muted">
                      <!--<span class="pull-right"><a href="#"><i class="icon-plus i-lg"></i></a></span> -->
                      播放列表
                    </li>
                    <li>
                      <a href="/share/home/movie/myfa">
                        <i class="icon-star icon"></i>
<?php if(!empty($$myfacount)): ?><b class="badge bg-success dker pull-right"><?php echo ($myfacount); ?></b><?php endif; ?>
                        <span>我的收藏</span>
                      </a>
                    </li>
                  </ul>
                  <ul class="nav text-sm">
                    <li class="hidden-nav-xs padder m-t m-b-sm text-xs text-muted">
                      <!--<span class="pull-right"><a href="#"><i class="icon-plus i-lg"></i></a></span> -->
                      About
                    </li>
                    <li>
                      <a href="#">
                        <i class="icon-notebook icon"></i>
                        <span>服务条款</span>
                      </a>
                    </li>
                    <li>
                      <a href="/share/home/index/about">
                        <i class="icon-paper-plane icon text-success-lter"></i>
                        
                        <span>关于平台</span>
                      </a>
                    </li>
                  </ul>
                </nav>
                <!-- / nav -->
              </div><div class="slimScrollBar" style="width: 10px; position: absolute; top: -416px; opacity: 0.4; display: none; border-top-left-radius: 7px; border-top-right-radius: 7px; border-bottom-right-radius: 7px; border-bottom-left-radius: 7px; z-index: 99; right: 0px; height: 30px; background: rgb(0, 0, 0);"></div><div class="slimScrollRail" style="width: 10px; height: 100%; position: absolute; top: 0px; display: none; border-top-left-radius: 7px; border-top-right-radius: 7px; border-bottom-right-radius: 7px; border-bottom-left-radius: 7px; opacity: 0.2; z-index: 90; right: 0px; background: rgb(51, 51, 51);"></div></div>
            </section>
<?php if($islogin==1): ?><footer class="footer hidden-xs no-padder text-center-nav-xs">
              <div class="bg hidden-xs ">
                  <div class="dropdown dropup wrapper-sm clearfix">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <span class="thumb-sm avatar pull-left m-l-xs">                        
                        <img src="/ucenter/avatar.php?uid=<?php echo ($uid); ?>&type=virtual&size=middle" class="dker" alt="...">
                        <i class="on b-black"></i>
                      </span>
                      <span class="hidden-nav-xs clear">
                        <span class="block m-l">
                          <strong class="font-bold text-lt"><?php echo ($username); ?></strong> 
                          <b class="caret"></b>
                        </span>
                        <span class="text-muted text-xs block m-l"><?php echo ($username); ?></span>
                      </span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight aside text-left">                      
                      <li>
                        <span class="arrow bottom hidden-nav-xs"></span>
                        <a href="#">设置</a>
                      </li>
                      <li>
                        <a href="/share/home/user/profile/uid/<?php echo ($uid); ?>">主页</a>
                      </li>
                      <li>
                        <a href="/forum/home.php?mod=space&do=pm">
                          <?php if($messagemember!=0): ?><span class="badge bg-danger pull-right"><?php echo ($messagemember); ?></span><?php endif; ?>
                          消息
                        </a>
                      </li>
                      <li>
                        <a href="docs.html">帮助</a>
                      </li>
                      <li class="divider"></li>
                      <li>
                        <a href="/share/home/user/logout" >注销</a>
                      </li>
                    </ul>
                  </div>
                </div>            </footer><?php endif; ?>
          </section>
        </aside>
        <!-- /.aside -->
<section id="content">
          <section class="vbox">
            <section class="scrollable wrapper-lg">
              <div class="row">
                <div class="col-sm-9">
                  <div class="blog-post">                   
                    <div class="post-item">
<?php if(empty($playid)): ?><div class="post-media">
                        <img src="<?php echo ($movieinfo["image"]); ?>" class="img-full">
                      </div>
<?php else: ?>
                      <div class="caption wrapper-lg">
                        <h2 class="post-title"><a href="#">当前播放视频：<?php echo ($movieinfo["name"]); ?></a></h2>
                      </div>
    <video width="100%" poster="<?php echo ($movieinfo["image"]); ?>" controls="controls">
<?php if(is_array($playlist)): $i = 0; $__LIST__ = $playlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$pllist): $mod = ($i % 2 );++$i;?><source type="video/mp4" src="<?php echo ($pllist["url"]); ?>" /><?php endforeach; endif; else: echo "" ;endif; ?>
    </video><?php endif; ?>
                      <div class="caption wrapper-lg">
                        <h2 class="post-title"><a href="#"><?php echo ($movieinfo["name"]); ?></a></h2>
                        <div class="post-sum">
<?php echo ((isset($mvcontent["intro"]) && ($mvcontent["intro"] !== ""))?($mvcontent["intro"]):"没有人进行编辑..."); ?>
                        </div>
                        <div class="line line-lg"></div>
                        <div class="text-muted">
                          <i class="fa fa-user icon-muted"></i> by <a href="/share/home/user/profile/uid/<?php echo ($mvcontent["userid"]); ?>" class="m-r-sm"><?php echo (getusernamebyid($mvcontent["userid"])); ?></a>
                          <i class="fa fa-clock-o icon-muted"></i> <?php echo ($mvcontent["time"]); ?>
                        </div>
                      </div>
                    </div>
                    <div class="post-item">
                      <div class="caption wrapper-lg">
<?php echo ((isset($mvcontent["content"]) && ($mvcontent["content"] !== ""))?($mvcontent["content"]):"没有人进行编辑..."); ?>
                        <h2 class="post-title">&nbsp;</h2><div class="post-sum">
                        </div>
                        <div class="line line-lg"></div>
                        <div class="text-muted">
                          <i class="fa fa-user icon-muted"></i> by <a href="/share/home/user/profile/uid/<?php echo ($mvcontent["userid"]); ?>" class="m-r-sm"><?php echo (getusernamebyid($mvcontent["userid"])); ?></a>
                          <i class="fa fa-clock-o icon-muted"></i> <?php echo ($mvcontent["time"]); ?>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6" style="width:100%">
                  <section class="panel panel-default">
                    <header class="panel-heading">
                      
                      下载列表
                    </header>
                    <table class="table table-striped m-b-none">
                      <thead>
                        <tr>
                          <th style="width:70%;"> 标题</th>
                          <th style="width:20%;">上传者</th>                    
                          <th style="width:10%;">操作</th>
                        </tr>
                      </thead>
                      <tbody>
<?php if(is_array($locallist)): $i = 0; $__LIST__ = $locallist;if( count($__LIST__)==0 ) : echo "$listempty" ;else: foreach($__LIST__ as $key=>$lolist): $mod = ($i % 2 );++$i;?><tr>                    
                          <td>
                            <?php echo ($lolist["title"]); ?>
                          </td>
                          <td><?php echo (getusernamebyid($lolist["userid"])); ?></td>
                          <td class="text-right">
                            <div class="btn-group" style="float:left">
<?php if($lolist['online'] == 1): ?><a href="/share/home/movie/show/id/<?php echo ($movieinfo["id"]); ?>/playid/<?php echo ($lolist["id"]); ?>"><i class="fa fa-play-circle"></i></a><?php endif; ?>
                            </div>
<div class="btn-group" style="float:right">
                              
  <a href="<?php echo ($lolist["url"]); ?>" download="<?php echo ($lolist["title"]); ?>.<?php echo (substr(strrchr($lolist["url"],'.'),1)); ?>"><i class="fa fa-download"></i></a>
                            </div>
                          </td>
                        </tr><?php endforeach; endif; else: echo "$listempty" ;endif; ?>                        
                        
                        
                      </tbody>
                    </table>
                  </section>
                </div>
                  <h4 class="m-t-lg m-b"><?php echo ($mvcommentcount); ?> 条评论</h4>
                  <section class="comment-list block">
<?php if(is_array($commentlist)): $i = 0; $__LIST__ = $commentlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cmlist): $mod = ($i % 2 );++$i;?><article id="comment-id-1" class="comment-item">
                      <a class="pull-left thumb-sm">
                        <img src="/ucenter/avatar.php?uid=<?php echo ($cmlist["userid"]); ?>&type=virtual&size=middle" class="img-circle">
                      </a>
                      <section class="comment-body m-b">
                        <header>
                          <a href="/share/home/user/profile/uid/<?php echo ($cmlist["userid"]); ?>"><strong><?php echo (getusernamebyid($cmlist["userid"])); ?></strong></a>
                          <?php echo (mvshowusertype($cmlist["userid"],$cmlist['movieid'])); ?>
                          <span class="text-muted text-xs block m-t-xs">
                            <?php echo ($cmlist["time"]); ?>
                          </span>
                        </header>
                        <div class="m-t-sm"><?php echo ($cmlist["content"]); ?></div>
                      </section>
                    </article><?php endforeach; endif; else: echo "" ;endif; ?>
                  </section>
<A NAME="comment"></a>
                  <h4 class="m-t-lg m-b">留下你的评论</h4>
                  <form action="/share/home/movie/addcomment/id/<?php echo ($movieinfo["id"]); ?>" method="post" name="comform">
                    <div class="form-group">
                      <textarea name="content" id="comcon" class="form-control" rows="5" placeholder="写下你的评论..."></textarea>
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-success">发布评论</button><span>Ctrl+Enter发送</span>
                    </div>
                  </form>
                </div>
                <div class="col-sm-3">
                  <h5 class="font-bold">视频统计</h5>
                  <ul class="list-group">
                    <li class="list-group-item">
                      <a href="#">
                        <span class="badge pull-right"><?php echo ($listcount); ?></span>视频数量</a>
                    </li>
                    <li class="list-group-item">
                      <a href="#">
                        <span class="badge pull-right"><?php echo ($wishcount); ?></span>
                        请愿人数
                      </a>
                    </li>
                    <li class="list-group-item">
                      <a href="#">
                        <span class="badge pull-right"><?php echo ($mvfacount); ?></span>
                        收藏人数
                      </a>
                    </li>
                    <li class="list-group-item">
                      <a href="#">
                        <span class="badge pull-right"><?php echo ($movieinfo["downloadcount"]); ?></span>
                        下载次数
                      </a>
                    </li>
                    <li class="list-group-item">
                      <a href="#">
                        <span class="badge pull-right"><?php echo ($movieinfo["playcount"]); ?></span>
                        播放次数
                      </a>
                    </li>
                  </ul>
                  <div class="doc-buttons">
		                <a href="/share/home/movie/upload/movieid/<?php echo ($movieinfo["id"]); ?>" class="btn btn-s-md btn-default">我要上传</a>  
<?php if(ismy($movieinfo['id'],$uid) == '0'): ?><a href="#" class="btn btn-s-md btn-primary" data-toggle="class:" onclick="ifa(<?php echo ($movieinfo["id"]); ?>);">
                                  <span class="text">收藏</span>
                                  <span class="text-active">收藏✔</span>
                                </a>
<?php else: ?>
		                <a href="#" class="btn btn-s-md btn-primary active" data-toggle="class:" onclick="ifa(<?php echo ($movieinfo["id"]); ?>);">
                                  <span class="text">收藏</span>
                                  <span class="text-active">收藏✔</span>
                                </a><?php endif; ?>
		                <a href="/share/home/movie/edit/movieid/<?php echo ($movieinfo["id"]); ?>" class="btn btn-s-md btn-default">编辑内容</a>
<?php if(iswish($movieinfo['id'],$uid) == '0'): ?><a href="#" class="btn btn-s-md btn-info" data-toggle="class:" onclick="iwish(<?php echo ($movieinfo["id"]); ?>);">
                                  <span class="text">请愿</span>
                                  <span class="text-active">请愿✔</span>
                                </a>
<?php else: ?>
		                <a href="#" class="btn btn-s-md btn-info active" data-toggle="class:" onclick="iwish(<?php echo ($movieinfo["id"]); ?>);">
                                  <span class="text">请愿</span>
                                  <span class="text-active">请愿✔</span>
                                </a><?php endif; ?>
		                <a href="#" class="btn btn-s-md btn-danger">举报</a>
		              </div>
                  <div class="tags m-b-lg l-h-2x">
<?php $_result=explode(',',$movieinfo['type']);if(is_array($_result)): $k = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$mtype): $mod = ($k % 2 );++$k;?><a href="/share/home/movie/mlist?type=<?php echo ($mtype); ?>" class="label bg-primary"><?php echo ($mtype); ?> </a> |<?php endforeach; endif; else: echo "" ;endif; ?>
                  </div>
                  <h5 class="font-bold">视频动态</h5>
                  <div class="timeline">
                    <article class="timeline-item active">
                        <div class="timeline-caption">
                          <div class="panel bg-primary lt no-borders">
                            <div class="panel-body">
                              <div class="m-t-sm timeline-action">
                                <span class="h3 pull-left m-r-sm">发布时间线</span>
                              </div>
                            </div>
                          </div>
                        </div>
                    </article>
<?php if(is_array($timeline)): $tlk = 0; $__LIST__ = $timeline;if( count($__LIST__)==0 ) : echo "没有数据" ;else: foreach($__LIST__ as $key=>$tl): $mod = ($tlk % 2 );++$tlk; if(($tlk+1)%2==1): ?><article class="timeline-item alt">
<?php else: ?>
                    <article class="timeline-item"><?php endif; ?>
                        <div class="timeline-caption">                
                          <div class="panel panel-default">
                            <div class="panel-body">
<?php if(($tlk+1)%2==1): ?><span class="arrow right"></span>
<?php else: ?>
                              <span class="arrow left"></span><?php endif; ?>
                              <span class="timeline-icon"><i class="<?php echo ($tl["icon"]); ?>"></i></span>
                              <span class="timeline-date"><?php echo (date("Y-m-d",strtotime($tl["time"]))); ?></span>
                              <div class="text-sm"><?php echo ($tl["footer"]); ?></div>
                              <h5><?php echo ($tl["title"]); ?></h5>
                              <p><?php echo ($tl["content"]); ?></p>
                            </div>
                          </div>
                        </div>
                    </article><?php endforeach; endif; else: echo "没有数据" ;endif; ?>
                  </div>
                </div>
              </div>
            </section>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen,open" data-target="#nav,html"></a>
        </section>
  </section>
<script src="/share/Public/js/jquery.min.js"></script>
  <!-- Bootstrap -->
<script src="/share/Public/js/bootstrap.js"></script>
<script type="text/javascript">
          $('#comcon').keypress(function(e){
            if(e.ctrlKey && e.which == 13 || e.which == 10) {
                   $('form[name=comform]').submit();
                  }
                });
</script>
  <!-- App -->
  <script src="/share/Public/js/app.js"></script>  
  <script src="/share/Public/js/slimscroll/jquery.slimscroll.min.js"></script>
<?php if($islogin==0): ?><div class="modal fade" id="modal-login" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body wrapper-lg">
          <div class="row">
            <div class="col-sm-6 b-r">
              <h3 class="m-t-none m-b">登录</h3>
              <p>登录后将可以上传、下载、请愿视频资源</p>
              <form role="form"  action="/share/home/user/login" method="get">
                <div class="form-group">
                  <label>用户名</label>
                  <input name="username" class="form-control" placeholder="请输入用户名">
                </div>
                <div class="form-group">
                  <label>密码</label>
                  <input name="password" type="password" class="form-control" placeholder="请输入密码">
                </div>
                <div class="checkbox m-t-lg">
                  <button type="submit" class="btn btn-sm btn-success pull-right text-uc m-t-n-xs"><strong>登录</strong></button>
                  
                </div>                
              </form>
            </div>
            <div class="col-sm-6">
              <h4>没有账户？</h4>
              <p>点击<a href="/share/home/user/register" class="text-info">这里</a>注册一个帐号</p>
            </div>
          </div>          
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><?php endif; ?>
    <script src="/share/Public/js/app.plugin.js"></script>
    <script src="/share/Public/js/own.js"></script>
<div style="display:none"><!--<script src='http://' language='JavaScript' charset='gb2312'></script> --></div>
</body>
</html>