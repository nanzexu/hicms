<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

    <title><?php echo ($meta_title); ?></title>
    <link href="/hicms/Public/Admin/css/bootstrap.min.css" rel="stylesheet">
    <link href="/hicms/Public/Admin/css/font-awesome.min.css?v=4.4.0" rel="stylesheet">
    <link href="/hicms/Public/Admin/css/animate.min.css" rel="stylesheet">
    <link href="/hicms/Public/Admin/css/style.min.css" rel="stylesheet">
    <link href="/hicms/Public/Admin/css/login.min.css" rel="stylesheet">
    <link href="/hicms/Public/Admin/css/plugins/toastr/toastr.min.css" rel="stylesheet">
    <!--[if lt IE 8]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <![endif]-->
    <script>
        if(window.top!==window.self){window.top.location=window.location};
    </script>

</head>
<body class="signin">

    <div class="signinpanel">
        <div class="row">
            <div class="col-sm-7">
                <div class="signin-info">
                    <div class="logopanel m-b">
                        <h1>[ HiCMS ]</h1>
                    </div>
                    <div class="m-b"></div>
                    <h4>欢迎使用 <strong>HiCMS</strong></h4>
                    <ul class="m-b">
                        <li><i class="fa fa-arrow-circle-o-right m-r-xs"></i> 优势一</li>
                        <li><i class="fa fa-arrow-circle-o-right m-r-xs"></i> 优势二</li>
                        <li><i class="fa fa-arrow-circle-o-right m-r-xs"></i> 优势三</li>
                        <li><i class="fa fa-arrow-circle-o-right m-r-xs"></i> 优势四</li>
                        <li><i class="fa fa-arrow-circle-o-right m-r-xs"></i> 优势五</li>
                    </ul>
                    <strong>还没有账号？ <a href="#">立即注册&raquo;</a></strong>
                </div>
            </div>
            <div class="col-sm-5">
                <form class="form-horizontal m-t" id="commentForm">
                    <h4 class="no-margins">登录：</h4>
                    <p class="m-t-md">登录到HiCMS后台</p>
                    <input type="text" name="username" class="form-control uname" placeholder="用户名" />
                    <input type="password" name="password" class="form-control pword m-b" placeholder="密码" />
                    <a href="">忘记密码了？</a>
                    <button id="bt_login" class="btn btn-success btn-block" type="button">登录</button>
                </form>
            </div>
        </div>
        <div class="signup-footer">
            <div class="pull-left">
                &copy; 2015 All Rights Reserved. HiCMS
            </div>
        </div>
    </div>

<script src="/hicms/Public/Admin/js/jquery.min.js?v=2.1.4"></script>
<script src="/hicms/Public/Admin/js/bootstrap.min.js?v=3.3.5"></script>
<script src="/hicms/Public/Admin/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="/hicms/Public/Admin/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="/hicms/Public/Admin/js/plugins/layer/layer.min.js"></script>
<script src="/hicms/Public/Admin/js/hplus.min.js?v=4.0.0"></script>
<script type="text/javascript" src="/hicms/Public/Admin/js/contabs.min.js"></script>
<script src="/hicms/Public/Admin/js/plugins/pace/pace.min.js"></script>
<script src="/hicms/Public/Admin/js/plugins/toastr/toastr.min.js"></script>

    <script type="text/javascript">
        $(function(){
            toastr.options.timeOut =2000;
            toastr.options.progressBar=true;
            $("#bt_login").click(function(){
                $.post('<?php echo U('Index/login?dosubmit=1');?>', $("form").serialize(), function(data){
                    if(!data.status){
                        toastr.error( data.info, "对不起！");
                        return;
                    }else{
                        toastr.success(data.info, "恭喜！");
                        toastr.options.onHidden = function() {window.location.href = data.url; };
                        return;
                    }
                },'json');

            });
        });
    </script>

</body>
</html>