<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

    <link rel="shortcut icon" href="favicon.ico"> <link href="/hicms/Public/Admin/css/bootstrap.min.css?v=3.3.5" rel="stylesheet">
    <link href="/hicms/Public/Admin/css/font-awesome.min.css?v=4.4.0" rel="stylesheet">

    <link href="/hicms/Public/Admin/css/animate.min.css" rel="stylesheet">
    <link href="/hicms/Public/Admin/css/style.min.css?v=4.0.0" rel="stylesheet">
    <link href="/hicms/Public/Admin/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
    
    <link href="/hicms/Public/Admin/css/plugins/jsTree/style.min.css" rel="stylesheet">




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
                        <a class="dropdown-toggle" id="refresh">
                            <i class="fa fa-refresh"></i>
                        </a>


                    </div>
                </div>
                <div class="ibox-content">
                    <div id="jstree"></div>
                </div>
            </div>
        </div>

    </div>

<div class="modal fade" id="System_menuList_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"><div class="modal-dialog" role="document"><div class="modal-content"></div></div></div>
<script src="/hicms/Public/Admin/js/jquery.min.js?v=2.1.4"></script>
<script src="/hicms/Public/Admin/js/bootstrap.min.js?v=3.3.5"></script>
<script src="/hicms/Public/Admin/js/content.min.js?v=1.0.0"></script>
<script src="/hicms/Public/Admin/js/plugins/layer/layer.min.js"></script>
<script src="/hicms/Public/Admin/js/plugins/validate/jquery.validate.min.js"></script>
<script src="/hicms/Public/Admin/js/plugins/validate/messages_zh.min.js"></script>
<script src="/hicms/Public/Admin/js/plugins/sweetalert/sweetalert.min.js"></script>
<script src="/hicms/Public/Admin/js/common.js"></script>
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


    <script type="text/javascript">
        $(function () {
            $("#jstree").jstree({
                "plugins": ["wholerow", "contextmenu"],
                'contextmenu': {
                    'items': {
                        "create": null,
                        "rename": null,
                        "remove": null,
                        "ccp": null,
                        "edit": {
                            "label": "编辑菜单",
                            "action": function (data) {
                                var inst = jQuery.jstree.reference(data.reference);
                                obj = inst.get_node(data.reference);
                                /*$("#<?php echo (CONTROLLER_NAME); ?>_<?php echo (ACTION_NAME); ?>_modal").modal({
                                 "remote":"<?php echo U('System/menuEdit');?>",
                                 }).modal('show');*/
                                var url = "<?php echo U('System/menuEdit');?>";
                                url += url.indexOf('?') != -1 ? '&id=' + obj.id : '?id=' + obj.id;
                                layer.open({
                                            type: 2,
                                            title: '编辑菜单',
                                            shadeClose: false,
                                            shade: 0.8,
                                            area: ['680px', '500px'],
                                            btn: ['保存', '取消'],
                                            //content: '<?php echo U('System/menuEdit',array("id"=>3));?>' //iframe的url
                                            content: url,//iframe的url
                                            yes: function (index, layero) {
                                                //alert("yes");
                                                var body = layer.getChildFrame('body', index);
                                                body.find('form').validate({
                                                    onsubmit:true,// 是否在提交是验证
                                                    onfocusout:false,// 是否在获取焦点时验证
                                                    onkeyup :false,// 是否在敲击键盘时验证

                                                    submitHandler:function(form){
                                                        $.post(url, $(form).serialize(), function(res){
                                                            if(!res.status){
                                                                //$.messager.alert('提示信息', res.info, 'error');
                                                                layer.close(index);
                                                                swal({title:"发生了什么？",text:res.info,type:"error"});
                                                            }else{
                                                                //$.messager.alert('提示信息', res.info, 'info');
                                                                reload();
                                                                layer.close(index);
                                                                swal({title:"太帅了",text:res.info,type:"success"});
                                                            }
                                                        });

                                                    }
                                                });
                                                body.find('form').submit();

                                            },
                                            cancel: function (index, layero) {

                                            }
                                        }
                                );


                            }
                        },
                        "add": {
                            "label": "添加子菜单",
                            "action": function (data) {
                                var inst = jQuery.jstree.reference(data.reference);
                                obj = inst.get_node(data.reference);
                                var url="<?php echo U('System/menuAdd');?>";
                                url += url.indexOf('?') != -1 ? '&parentid=' + obj.id : '?parentid=' + obj.id;
                                layer.open({
                                    type: 2,
                                    title: '添加子菜单',
                                    shadeClose: false,
                                    shade: 0.8,
                                    area: ['680px', '500px'],
                                    btn: ['保存', '取消'],
                                    content: url, //iframe的url
                                    yes: function (index, layero) {

                                        var body = layer.getChildFrame('body', index);
                                        body.find('form').validate({
                                            onsubmit:true,// 是否在提交是验证
                                            onfocusout:false,// 是否在获取焦点时验证
                                            onkeyup :false,// 是否在敲击键盘时验证
                                            submitHandler:function(form){
                                                $.post(url, $(form).serialize(), function(res){
                                                    if(!res.status){
                                                        //$.messager.alert('提示信息', res.info, 'error');
                                                        layer.close(index);
                                                        swal({title:"发生了什么？",text:res.info,type:"error"});
                                                    }else{
                                                        //$.messager.alert('提示信息', res.info, 'info');
                                                        reload();
                                                        layer.close(index);
                                                        swal({title:"太帅了",text:res.info,type:"success"});
                                                    }
                                                });

                                            }
                                        });
                                        body.find('form').submit();
                                    },
                                    cancel: function (index, layero) {

                                    }
                            });
        }
        },

        "delete"
        :
        {
            "label"
        :
            "删除菜单",
                    "action"
        :
            function (data) {
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
                            function (data) {
                                if (data.status) {
                                    reload();
                                    swal("删除成功！", "您已经永久删除了菜单。", "success");
                                }
                                else {
                                    swal("删除失败！", data.info, "error");
                                }
                            }
                    );

                });
            }
        }
        ,

        }
        },

        'core'
        :
        {
            'data'
        :
            {
                "type"
            :
                "post",
                        "url"
            :
                "<?php echo U('System/menuList');?>",
                        "dataType"
            :
                "json",
                        "cache"
            :
                false,
                        'data'
            :
                function (node) {
                    return {
                        'id': node.id,
                    };
                }
            }
        }
        ,


        })
        ;


        })
        ;

        //刷新控件
        function reload() {
            $("#jstree").jstree("refresh");
        }


    </script>

</body>
</html>