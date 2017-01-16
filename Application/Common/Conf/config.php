<?php
return array(
	//'配置项'=>'配置值'
	//数据库配置
    'DB_TYPE'               =>  'mysqli',     // 数据库类型
    'DB_HOST'               =>  'localhost', // 服务器地址
    'DB_NAME'               =>  'php_jd',          // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  '12345',          // 密码
    'DB_PORT'               =>  '3306',        // 端口
    'DB_PREFIX'             =>  'p39_',    // 数据库表前缀
    //'DB_CHARSET'          =>  'utf8',      // 数据库编码默认采用utf8
    //'DB_DNS'              =>  'mysql:host=localhost;dbname=php_jd;charset=utf8',
    
    //I函数的校验信息配置
    'DEFAULT_FILTER'        =>  'trim,htmlspecialchars',
    
    //页面的跟踪信息配置
    'SHOW_PAGE_TRACE'       =>  true,
    
    //**********图片的相关配置************
    'IMAGE_CONFIG'          =>  array(
        'maxSize'   =>      2*1024*1024,                        // 设置附件上传大小
        'exts'      =>      array('jpg', 'gif', 'png', 'jpeg'), // 设置附件上传类型
        'rootPath'  =>      './Public/Uploads/',                //上传图片的保存路径
        'viewPath'  =>      '/Public/Uploads/',                 //显示图片的路径
    ),
    
    
    //***************配置邮箱的相关信息*****************
    'EMAIL'  =>  array(
        'host' => 'smtp.163.com',
        'user' => 'm13250150526',
        'password' => '2300585123wade',
    ),
);