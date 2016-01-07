<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

    <link rel="shortcut icon" href="favicon.ico"> <link href="/hicms/Public/Admin/css/bootstrap.min.css?v=3.3.5" rel="stylesheet">
    <link href="/hicms/Public/Admin/css/font-awesome.min.css?v=4.4.0" rel="stylesheet">

    <link href="/hicms/Public/Admin/css/animate.min.css" rel="stylesheet">
    <link href="/hicms/Public/Admin/css/style.min.css?v=4.0.0" rel="stylesheet"><base target="_blank">
    
    <link href="/hicms/Public/Admin/css/plugins/jsTree/style.min.css" rel="stylesheet">
    <link href="/hicms/Public/Admin/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">



</head>
<body class="gray-bg">

    <div class="row wrapper wrapper-content fadeInRight">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo ($currentpos); ?></h5>

                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="dropdown-toggle" id="refresh" >
                            <i class="fa fa-refresh" ></i>
                        </a>


                    </div>
                </div>
                <div class="ibox-content">
                    <div id="jstree"></div>
                </div>
            </div>
        </div>

    </div>

<script src="/hicms/Public/Admin/js/jquery.min.js?v=2.1.4"></script>
<script src="/hicms/Public/Admin/js/bootstrap.min.js?v=3.3.5"></script>
<script src="/hicms/Public/Admin/js/content.min.js?v=1.0.0"></script>
<script src="/hicms/Public/Admin/js/plugins/layer/layer.min.js"></script>
<script type="text/javascript">
    $(function () {

        $("#refresh").click(function () {
            if ($.isFunction(window.reload)) {
                reload();
            }
        });

    });
</script>

    <script src="/hicms/Public/Admin/js/plugins/jsTree/jstree.min.js"></script>
    <script src="/hicms/Public/Admin/js/plugins/sweetalert/sweetalert.min.js"></script>

    <script type="text/javascript">
        $(function () {

            //加载扩展模块
            layer.config({
                extend: 'extend/layer.ext.js'
            });
            $("#jstree").jstree({
                "plugins": ["wholerow","contextmenu"],
                'contextmenu': {
                    'items': {
                        "create":null,
                        "rename":null,
                        "remove":null,
                        "ccp":null,
                        "edit":{
                            "label":"编辑菜单",
                            "action":function(data){
                                var inst = jQuery.jstree.reference(data.reference);
                                obj = inst.get_node(data.reference);
                                layer.open({
                                    type: 2,
                                    title: 'layer mobile页',
                                    shadeClose: true,
                                    shade: 0.8,
                                    area: ['680px', '600px'],
                                    content: '<?php echo U('System/menuAdd');?>' //iframe的url
                                });


                            }
                        },
                        "add":{
                            "label":"添加子菜单",
                            "action":function(data){
                                var inst = jQuery.jstree.reference(data.reference);
                                        obj = inst.get_node(data.reference);

                                layer.open({
                                    type: 2,
                                    title: 'layer mobile页',
                                    shadeClose: true,
                                    shade: 0.8,
                                    area: ['680px', '600px'],
                                    content: '<?php echo U('System/menuAdd');?>' //iframe的url
                                });
                            }
                        },

                        "delete":{
                            "label":"删除菜单",
                            "action":function(data){
                                var inst = jQuery.jstree.reference(data.reference),
                                        obj = inst.get_node(data.reference);
                                swal({
                                    title: "您确定要删除菜单吗",
                                    text: "删除后将无法恢复，请谨慎操作！",
                                    type: "warning",
                                    showCancelButton: true,
                                    confirmButtonColor: "#DD6B55",
                                    confirmButtonText: "删除",
                                    closeOnConfirm: false
                                }, function () {
                                    $.post(
                                            "<?php echo U('System/menuDelete');?>",
                                            { id: obj.id },
                                            function(data){
                                                if(data.status){
                                                    reload();
                                                    swal("删除成功！", "您已经永久删除了菜单。", "success");
                                                }
                                                else{
                                                    swal("删除失败！",data.info, "error");
                                                }
                                            }
                                    );

                                });
                            }
                        },

                    }
                },

                'core': {
                    'data': {
                        "type":"post",
                        "url":"<?php echo U('System/menuList');?>",
                        "dataType":"json",
                        "cache":false,
                        'data' : function (node) {
                            return {
                                'id' : node.id,
                            };
                        }
                    }
                },


            });


        });

        //刷新控件
        function reload(){
            $("#jstree").jstree("refresh");
        }



    </script>

</body>
</html>