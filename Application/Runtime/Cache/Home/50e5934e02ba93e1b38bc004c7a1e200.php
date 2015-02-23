<?php if (!defined('THINK_PATH')) exit(); if(C('LAYOUT_ON')) { echo ''; } ?>
<!DOCTYPE html>
<html lang="cn" class="app">
<head>  
  <meta charset="utf-8" />
  <title>Notice! - BGD SHARE</title>
  <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <link rel="stylesheet" href="/share/Public/css/bootstrap.css" type="text/css" />
  <link rel="stylesheet" href="/share/Public/css/animate.css" type="text/css" />
  <link rel="stylesheet" href="/share/Public/css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="/share/Public/css/simple-line-icons.css" type="text/css" />
  <link rel="stylesheet" href="/share/Public/css/font.css" type="text/css" />
  <link rel="stylesheet" href="/share/Public/css/app.css" type="text/css" />  
    <!--[if lt IE 9]>
    <script src="js/ie/html5shiv.js"></script>
    <script src="js/ie/respond.min.js"></script>
    <script src="js/ie/excanvas.js"></script>
  <![endif]-->
</head>
<body class="bg-light dk">
    <section id="content">
    <div class="row m-n">
      <div class="col-sm-4 col-sm-offset-4">
        <div class="text-center m-b-lg">
          <h1 class="h text-white animated fadeInDownBig">
<?php if(isset($message)) {?>
:)
<?php }else{?>
:(
<?php }?></h1>
<?php if(isset($message)) {?>
<h2><?php echo($message); ?></h2>
<?php }else{?>
<h2><?php echo($error); ?></h2>
<?php }?>
<h3>页面自动 <a id="href" href="<?php echo($jumpUrl); ?>">跳转</a> 等待时间：<b id="wait"><?php echo($waitSecond); ?></b></h3>
        </div>
        <div class="list-group auto m-b-sm m-b-lg">
          <a href="/share" class="list-group-item">
            <i class="fa fa-chevron-right icon-muted"></i>
            <i class="fa fa-fw fa-home icon-muted"></i> 回到首页
          </a>
          <!--<a href="#" class="list-group-item">
            <i class="fa fa-chevron-right icon-muted"></i>
            <i class="fa fa-fw fa-question icon-muted"></i> Send us a tip
          </a>-->
<?php if(!isset($message)) {?>
          <a href="#" class="list-group-item">
            <i class="fa fa-chevron-right icon-muted"></i>
            <span class="badge bg-info lt">81569653@163.com</span>
            <i class="fa fa-fw fa-phone icon-muted"></i> 联系我们
          </a>
<?php }?>
        </div>
      </div>
    </div>
  </section>
  <!-- footer -->
  <footer id="footer">
    <div class="text-center padder clearfix">
      <p>
        <small>BGD SHARE<br>&copy; 2014</small>
      </p>
    </div>
  </footer>
  <!-- / footer -->
<script type="text/javascript">
(function(){
var wait = document.getElementById('wait'),href = document.getElementById('href').href;
var interval = setInterval(function(){
	var time = --wait.innerHTML;
	if(time <= 0) {
		location.href = href;
		clearInterval(interval);
	};
}, 1000);
})();
</script>
  <script src="/share/Public/js/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="/share/Public/js/bootstrap.js"></script>
  <!-- App -->
  <script src="/share/Public/js/app.js"></script>  
  <script src="/share/Public/js/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="/share/Public/js/app.plugin.js"></script>
<div style="display:none"><!--<script src='http://v7.cnzz.com/stat.php?id=155540&web_id=155540' language='JavaScript' charset='gb2312'></script>--></div>
</body>
</html>