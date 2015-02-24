<?php
// +----------------------------------------------------------------------
// | Video-share
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: xiaohuanshu <xiaohuanshu@gmail.com>
// +----------------------------------------------------------------------

// 应用入口文件

// 检测PHP环境
if(version_compare(PHP_VERSION,'5.3.0','<'))  die('require PHP > 5.3.0 !');

// 开启调试模式 建议开发阶段开启 部署阶段注释或者设为false
define('APP_DEBUG',True);

// 定义应用目录
define('APP_PATH','./Application/');
define('DIR_SECURE_FILENAME', 'index.html,index.htm,default.html,default.htm');
define('DIR_SECURE_CONTENT', 'deney Access!');
// 引入ThinkPHP入口文件
require './ThinkPHP/ThinkPHP.php';