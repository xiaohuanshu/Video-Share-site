<?php
return array(
	//'配置项'=>'配置值'
	// 添加数据库配置信息
'DB_TYPE'   => 'mysql', // 数据库类型
'DB_HOST'   => '', // 服务器地址
'DB_NAME'   => '', // 数据库名
'DB_USER'   => '', // 用户名
'DB_PWD'    => '', // 密码
'DB_PORT'   => 3306, // 端口
'DB_PREFIX' => 'think_', // 数据库表前缀
'URL_MODEL' => 2,   //url模式
// 显示页面Trace信息
//'SHOW_PAGE_TRACE' =>true, 
'TOKEN_ON'      =>    true,  // 是否开启令牌验证 默认关闭
'TOKEN_NAME'    =>    '__hash__',    // 令牌验证的表单隐藏字段名称，默认为__hash__
'TOKEN_TYPE'    =>    'md5',  //令牌哈希验证规则 默认为MD5
'TOKEN_RESET'   =>    true,  //令牌验证出错后是否重置令牌 默认为true
'HTTP_CACHE_CONTROL' => 'private', //缓存方式

'ADMIN_ID'  => array(1), //管理员id
'RESOURCEURL' => '', //资源下载服务器地址，结尾不要加"/",不需要请留空
    'targetDir' => 'Uploads/movie_tmp',//文件上传临时存放地址
    'uploadDir' => 'Uploads/movie',//文件上传地址
    'allow_ext' => 'flv,mkv,avi,rm,rmvb,mpeg,mpg,mov,wmv,mp4,webm',
'videotype'     =>    array('喜剧','动作','爱情','恐怖','科幻','战争','故事','资料','公开课'), //视频类型
'college'       =>    array('保密','院系1','院系2','院系3'),  //院系
'major'         =>    array('院系1' => array('保密','1','2','3'),//院系对应专业
                            '院系2' => array('保密','4','5','6'),
							'院系3' => array('保密','7','8','9'),
							'保密' => array('保密'),
							),
);
