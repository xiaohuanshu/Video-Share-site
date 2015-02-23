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
            <section class="scrollable">
              <section class="hbox stretch">
                <aside class="aside-lg bg-light lter b-r">
                  <section class="vbox">
                    <section class="scrollable">
                      <div class="wrapper">
                        <div class="text-center m-b m-t">
                          <a href="#" class="thumb-lg">
                            <img src="/ucenter/avatar.php?uid=<?php echo ($userinfo["userid"]); ?>&type=virtual&size=middle" class="img-circle">
                          </a>
                          <div>
                            <div class="h3 m-t-xs m-b-xs"><?php echo ($userinfo["username"]); ?></div>
                            <small class="text-muted"><i class="fa fa-map-marker"></i> <?php echo ($userinfo["college"]); ?>  <?php echo ($userinfo["major"]); ?> <?php echo ($userinfo["realname"]); ?></small>
                          </div>                
                        </div>
                        <div class="panel wrapper">
                          <div class="row text-center">
                            <div class="col-xs-6">
                              <a href="/share/home/movie/mlist?userid=<?php echo ($userinfo["userid"]); ?>">
                                <span class="m-b-xs h4 block"><?php echo ($uploadcount); ?></span>
                                <small class="text-muted">上传数量</small>
                              </a>
                            </div>
                            <div class="col-xs-6">
                              <a href="#">
                                <span class="m-b-xs h4 block"><?php echo ($wishcount); ?></span>
                                <small class="text-muted">请愿数量</small>
                              </a>
                            </div>
                          </div>
                        </div>
                        <div class="btn-group btn-group-justified m-b">
                          <a class="btn btn-success btn-rounded" href="/forum/home.php?mod=spacecp&ac=pm&op=showmsg&touid=<?php echo ($userinfo["userid"]); ?>">
                            <span class="text">
                              <i class="fa fa-eye"></i> 聊天
                            </span>
                          </a>
                          
                        <a class="btn btn-dark btn-rounded">
                            <i class="fa fa-comment-o"></i> 举报
                          </a></div>
                        <div>
                          <small class="text-uc text-xs text-muted">介绍</small>
                          <p><?php echo ((isset($userinfo["intro"]) && ($userinfo["intro"] !== ""))?($userinfo["intro"]):"未填写"); ?></p>
                          <small class="text-uc text-xs text-muted">关联</small>
                          <p>QQ：<?php if(($userinfo["qq"]) == "0"): ?>未填写<?php else: echo ($userinfo["qq"]); endif; ?></p>
<p>上次登录：<?php echo ($userinfo["lastlogintime"]); ?></p>
<p>注册时间：<?php echo ($userinfo["registertime"]); ?></p>
                          <div class="line"></div>
<div class="doc-buttons">
		                <a href="/share/home/movie/mlist?userid=<?php echo ($userinfo["userid"]); ?>" class="btn btn-s-md btn-default">对方视频列表</a>
<a href="/forum/home.php?mod=space&uid=<?php echo ($userinfo["userid"]); ?>&do=thread&view=me&from=space" class="btn btn-s-md btn-default">对方论坛帖子</a>                
		              </div>
                        </div>
                      </div>
                    </section>
                  </section>
                </aside>
                <aside class="bg-white">
                  <section class="vbox">
                    <header class="header bg-light lt">
                      <ul class="nav nav-tabs nav-white">
                        <li class="active" style=""><a href="#upload" data-toggle="tab">上传视频</a></li>
<li class="" style=""><a href="#wish" data-toggle="tab">请愿视频</a></li>
                      </ul>
                    </header>
                    
<section class="scrollable">
                      <div class="tab-content">
                        <div class="tab-pane active" id="upload">
                          <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
<?php if(is_array($uploadlist)): $i = 0; $__LIST__ = $uploadlist;if( count($__LIST__)==0 ) : echo "还没有上传过视频..." ;else: foreach($__LIST__ as $key=>$uplist): $mod = ($i % 2 );++$i;?><li class="list-group-item">
                              <a href="#" class="thumb-sm pull-left m-r-sm">
                                <img src="<?php echo ($uplist["image"]); ?>.thumb.jpg" >
                              </a>
                              <a href="#" class="clear">
                                <small class="pull-right"><?php echo ($uplist["updatetime"]); ?></small>
                                <strong class="block"><?php echo ($userinfo["username"]); ?></strong>
                                <small><?php echo ($uplist["name"]); ?></small>
                              </a>
                            </li><?php endforeach; endif; else: echo "还没有上传过视频..." ;endif; ?>
                          </ul>
                        </div>
<div class="tab-pane" id="wish">
                          <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
<?php if(is_array($wishlist)): $i = 0; $__LIST__ = $wishlist;if( count($__LIST__)==0 ) : echo "还没有情愿过视频..." ;else: foreach($__LIST__ as $key=>$wslist): $mod = ($i % 2 );++$i;?><li class="list-group-item">
                              <a href="#" class="thumb-sm pull-left m-r-sm">
                                <img src="<?php echo ($wslist["image"]); ?>.thumb.jpg" >
                              </a>
                              <a href="#" class="clear">
                                <small class="pull-right"><?php echo ($wslist["updatetime"]); ?></small>
                                <strong class="block"><?php echo ($userinfo["username"]); ?></strong>
                                <small><?php echo ($wslist["name"]); ?></small>
                              </a>
                            </li><?php endforeach; endif; else: echo "还没有情愿过视频..." ;endif; ?>
                          </ul>
                        </div>
                        
                        
                      </div>
                    </section>
                  </section>
                </aside>
                <aside class="col-lg-3 b-l">
                  <section class="vbox">
                    <section class="scrollable padder-v">
                      <div class="panel">
                        <h4 class="font-thin padder">最新评论</h4>
                        <ul class="list-group">
<?php if(is_array($commentlist)): $i = 0; $__LIST__ = $commentlist;if( count($__LIST__)==0 ) : echo "还没有评论过视频..." ;else: foreach($__LIST__ as $key=>$cmlist): $mod = ($i % 2 );++$i;?><li class="list-group-item">
                              <p><a href="/share/home/movie/show/id/<?php echo ($cmlist["id"]); ?>" class="text-info"><?php echo (getmovienamebyid($cmlist["movieid"])); ?></a>:<?php echo ($cmlist["content"]); ?></p>
                              <small class="block text-muted"><i class="fa fa-clock-o"></i><?php echo ($cmlist["time"]); ?></small>
                          </li><?php endforeach; endif; else: echo "还没有评论过视频..." ;endif; ?>
                          
                        </ul>
                      </div>
                      
                    </section>
                  </section>              
                </aside>
              </section>
            </section>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen,open" data-target="#nav,html"></a>
        </section>
  </section>
<script src="/share/Public/js/jquery.min.js"></script>
  <!-- Bootstrap -->
<script src="/share/Public/js/bootstrap.js"></script>
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