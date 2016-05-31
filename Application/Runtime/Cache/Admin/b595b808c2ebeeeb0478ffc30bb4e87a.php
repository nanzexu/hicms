<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

    <title>FastOrder System by 811046@qq.com</title>
    <link href="/hicms/Public/Admin/css/bootstrap.min.css" rel="stylesheet">
    <link href="/hicms/Public/Admin/css/font-awesome.min.css?v=4.4.0" rel="stylesheet">
    <link href="/hicms/Public/Admin/css/animate.min.css" rel="stylesheet">
    <link href="/hicms/Public/Admin/css/style.min.css" rel="stylesheet">
    <link href="/hicms/Public/Admin/css/login.min.css" rel="stylesheet">
    <link href="/hicms/Public/Admin/css/plugins/toastr/toastr.min.css" rel="stylesheet">
    <link href="/hicms/Public/Admin/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
    <!--[if lt IE 8]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <![endif]-->
    <script>
        if(window.top!==window.self){window.top.location=window.location};
    </script>

</head>
<script src="/hicms/Public/Admin/js/jquery.min.js?v=2.1.4"></script>
<script src="/hicms/Public/Admin/js/bootstrap.min.js?v=3.3.5"></script>
<script src="/hicms/Public/Admin/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="/hicms/Public/Admin/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="/hicms/Public/Admin/js/plugins/layer/layer.js"></script>
<script src="/hicms/Public/Admin/js/hplus.min.js?v=4.0.0"></script>
<script type="text/javascript" src="/hicms/Public/Admin/js/contabs.min.js"></script>
<script src="/hicms/Public/Admin/js/plugins/pace/pace.min.js"></script>
<script src="/hicms/Public/Admin/js/plugins/toastr/toastr.min.js"></script>
<script src="/hicms/Public/Admin/js/plugins/sweetalert/sweetalert.min.js"></script>


<body class="fixed-sidebar full-height-layout gray-bg" style="overflow:hidden">

    <!-- 主体 -->
    <div id="wrapper">
        <!--左侧导航开始-->
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="nav-close"><i class="fa fa-times-circle"></i>
            </div>
            <div class="sidebar-collapse">
            <ul class="nav" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <span>超级订单系统1.52</span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="clear">
                               <span class="block m-t-xs"><strong class="font-bold"><?php echo (cookie('username')); ?></strong></span>
                                <span class="text-muted text-xs block">超级管理员<b class="caret"></b></span>
                                </span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                       <!-- <li><a class="J_menuItem" href="form_avatar.html">修改头像</a>
                        </li>
                        <li><a class="J_menuItem" href="profile.html">个人资料</a>
                        </li>
                        <li><a class="J_menuItem" href="contacts.html">联系我们</a>
                        </li>
                        <li><a class="J_menuItem" href="mailbox.html">信箱</a>
                        </li>-->
                        <li class="divider"></li>
                        <li><a href="<?php echo U('Index/Logout');?>">安全退出</a>
                        </li>
                    </ul>
                </div>
                <div class="logo-element">H+
                </div>
            </li>
            <?php if(is_array($menuTree)): $i = 0; $__LIST__ = $menuTree;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
                <a href="#">
                    <i class="fa fa-desktop"></i>
                    <span class="nav-label"><?php echo ($vo["text"]); ?></span>
                    <span class="fa arrow"></span>
                </a>
                <?php if(!empty($vo["children"])): ?><ul class="nav nav-second-level">
                        <?php if(is_array($vo["children"])): $i = 0; $__LIST__ = $vo["children"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$subvo): $mod = ($i % 2 );++$i;?><li>

                                <?php if(!empty($subvo["children"])): ?><a href="#"><?php echo ($subvo["text"]); ?> <span class="fa arrow"></span></a>

                                    <ul class="nav nav-third-level">
                                    <?php if(is_array($subvo["children"])): $i = 0; $__LIST__ = $subvo["children"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$subvo1): $mod = ($i % 2 );++$i;?><li><a class="J_menuItem" href="<?php echo U($subvo1['c'].'/'.$subvo1['a'],array('menuid'=>$subvo1['id']));?>"><?php echo ($subvo1["text"]); ?></a> </li><?php endforeach; endif; else: echo "" ;endif; ?>
                                    </ul>
                                <?php else: ?>
                                    <a class="J_menuItem" href="<?php echo U($subvo['c'].'/'.$subvo['a'],array('menuid'=>$subvo['id']));?>"><?php echo ($subvo["text"]); ?></a><?php endif; ?>

                            </li><?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul><?php endif; ?>
            </li><?php endforeach; endif; else: echo "" ;endif; ?>


            </ul>
            </div>
        </nav>
        <!--左侧导航结束-->
        <!--右侧部分开始-->
        <div id="page-wrapper" class="gray-bg dashbard-1">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">

                </nav>
            </div>
            <div class="row content-tabs">
                <button class="roll-nav roll-left J_tabLeft"><i class="fa fa-backward"></i>
                </button>
                <nav class="page-tabs J_menuTabs">
                    <div class="page-tabs-content">
                        <a href="javascript:;" class="active J_menuTab" data-id="index_v1.html">首页</a>
                    </div>
                </nav>
                <button class="roll-nav roll-right J_tabRight"><i class="fa fa-forward"></i>
                </button>
                <div class="btn-group roll-nav roll-right">
                    <button class="dropdown J_tabClose" data-toggle="dropdown">关闭操作<span class="caret"></span>

                    </button>
                    <ul role="menu" class="dropdown-menu dropdown-menu-right">
                        <li class="J_tabShowActive"><a>定位当前选项卡</a>
                        </li>
                        <li class="divider"></li>
                        <li class="J_tabCloseAll"><a>关闭全部选项卡</a>
                        </li>
                        <li class="J_tabCloseOther"><a>关闭其他选项卡</a>
                        </li>
                    </ul>
                </div>
                <a href="<?php echo U('Index/Logout');?>" class="roll-nav roll-right J_tabExit"><i class="fa fa fa-sign-out"></i> 退出</a>
            </div>
            <div class="row J_mainContent" id="content-main">
                <iframe class="J_iframe" name="iframe0" width="100%" height="100%" src="<?php echo U('Order/index');?>" frameborder="0" data-id="index_v1.html" seamless></iframe>
            </div>
            <div class="footer">
                <div class="pull-right">&copy; 811046@qq.com 2016
                </div>
            </div>
        </div>
        <!--右侧部分结束-->
        <!--右侧边栏开始-->
        <div id="right-sidebar">
        <div class="sidebar-container">



        </div>
        </div>
        <!--右侧边栏结束---->
    </div>


</body>
</html>