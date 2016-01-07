<?php
return array(
	//'配置项'=>'配置值'
    'MODULE_ALLOW_LIST'     => array('Home', 'Admin', 'Install'),
    /* 数据库设置 */
    'DB_TYPE'               => 'mysqli',     // 数据库类型
    'DB_HOST'               => '127.0.0.1',  // 服务器地址
    'DB_NAME'               => 'hicms',        // 数据库名
    'DB_USER'               => 'hicms',       // 用户名
    'DB_PWD'                => 'hicms',           // 密码
    'DB_PORT'               => '3306',       // 端口
    'DB_PREFIX'             => 'stoa_',      // 数据库表前缀
    /* 文件上传全局配置 */
    'FILE_UPLOAD_CONFIG'    => array(
        'mimes'    => '', //允许上传的文件MiMe类型
        'maxSize'  => 5*1024*1024, //上传的文件大小限制 (0-不做限制)
        'exts'     => array('jpg','gif','png','jpeg','zip','rar','tar','gz','7z', 'pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx','txt','xml','swf','avi'), //允许上传的文件后缀
        'autoSub'  => true, //自动子目录保存文件
        'subName'  => array('date', 'Y/m/d'), //子目录创建方式，[0]-函数名，[1]-参数，多个参数使用数组
        'rootPath' => UPLOAD_PATH, //保存根路径
        'savePath' => '', //保存路径
        'saveName' => array('uniqid', ''), //上传文件命名规则，[0]-函数名，[1]-参数，多个参数使用数组
        'saveExt'  => '', //文件保存后缀，空则使用原后缀
        'replace'  => false, //存在同名是否覆盖
        'hash'     => false, //是否生成hash编码
        'callback' => false, //检测文件是否存在回调函数，如果存在返回文件信息数组
    ),
);