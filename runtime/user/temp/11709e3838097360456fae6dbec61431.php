<?php /*a:3:{s:60:"D:\phpstudy_pro\WWW\tp6.com\app\user\view\notices\index.html";i:1705484620;s:38:"../app/common/view/public/uHeader.html";i:1697116602;s:38:"../app/common/view/public/uFooter.html";i:1695986854;}*/ ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>创梦API</title>
    <meta name="keywords" content="iapp,iapp后台,创梦iapp,创梦API">
    <meta name="description" content="好用的iapp后台管理系统">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="Access-Control-Allow-Origin" content="*">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <!-- <link rel="icon" href="/static/images/favicon.ico"> -->
<link rel="stylesheet" href="/static/lib/layui-v2.6.3/css/layui.css" media="all">
<link rel="stylesheet" href="/static/css/public.css" media="all">
</head>

<body>
    <div class="layuimini-container">
        <div class="layuimini-main">
            <script type="text/html" id="toolbarDemo">
                <div class="layui-btn-container">
                    <button class="layui-btn layui-btn-normal layui-btn-sm data-add-btn" lay-event="add"> 添加 </button>
                    <button class="layui-btn layui-btn-sm layui-btn-danger data-delete-btn" lay-event="delete"> 删除 </button>
                </div>
            </script>

            <table class="layui-hide" id="currentTableId" lay-filter="currentTableFilter"></table>

            <script type="text/html" id="currentTableBar">
                <a class="layui-btn layui-btn-normal layui-btn-xs data-count-edit" lay-event="check">编辑</a>
                <a class="layui-btn layui-btn-xs layui-btn-danger data-count-delete" lay-event="delete">删除</a>
            </script>

        </div>
    </div>
    <script src="/static/lib/layui-v2.6.3/layui.js" charset="utf-8"></script>
    <script>
        layui.use(['form', 'table'], function () {
            var $ = layui.jquery,
                form = layui.form,
                table = layui.table;

            table.render({
                elem: '#currentTableId',
                url: '/api/user/v1/notices',
                toolbar: '#toolbarDemo',
                defaultToolbar: ['filter', 'exports', 'print', {
                    title: '提示',
                    layEvent: 'LAYTABLE_TIPS',
                    icon: 'layui-icon-tips'
                }],
                cols: [
                    [{
                        type: "checkbox",
                        width: 50
                    },
                    {
                        field: 'id',
                        width: 60,
                        title: 'ID',
                        sort: true
                    },
                    {
                        field: 'title',
                        width: 120,
                        title: '公告标题'
                    },
                    {
                        field: 'content',
                        width: 120,
                        title: '公告内容'
                    },
                    {
                        field: 'create_time',
                        width: 120,
                        title: '发布时间',
                        sort: true
                    },
                    {
                        field: 'update_time',
                        width: 120,
                        title: '更新时间',
                        sort: true
                    },
                    {
                        field: 'app_id',
                        width: 120,
                        title: '应用ID',
                        sort: true
                    },
                    {
                        field: 'comment',
                        width: 120,
                        title: '备注'
                    },
                    {
                        title: '操作',
                        minWidth: 150,
                        toolbar: '#currentTableBar',
                        align: "center"
                    }
                    ]
                ],
                limits: [10, 15, 20, 25, 50, 100],
                limit: 15,
                page: true,
                skin: 'line',
                parseData: function (res) { //将原始数据解析成 table 组件所规定的数据，res为从url中get到的数据
                    var result;
                    if (this.page.curr) {
                        result = res.data.slice(this.limit * (this.page.curr - 1), this.limit * this.page.curr);
                    } else {
                        result = res.data.slice(0, this.limit);
                    }
                    if (res.code == 200) {
                        res.code = 0;
                    }
                    return {
                        "code": res.code, //解析接口状态
                        "msg": res.msg, //解析提示文本
                        "count": res.count, //解析数据长度
                        "data": res.data //解析数据列表
                    };
                },
            });

            // 监听搜索操作
            form.on('submit(data-search-btn)', function (data) {

                //执行搜索重载
                table.reload('currentTableId', {
                    page: {
                        curr: 1
                    },
                    where: {
                        username: data.field.username
                    },
                }, 'data');
                return false;
            });




            /**
             * toolbar监听事件
             */
            table.on('toolbar(currentTableFilter)', function (obj) {
                if (obj.event === 'add') { // 监听添加操作
                    var index = layer.open({
                        title: '添加公告',
                        type: 2,
                        shade: 0.2,
                        maxmin: true,
                        shadeClose: true,
                        area: ['100%', '100%'],
                        content: '/user/notices/add',
                        end: function () {
                            table.reload('currentTableId', {
                                url: '/api/user/v1/notices',
                                where: {}
                            });
                        }
                    });
                    $(window).on("resize", function () {
                        layer.full(index);
                    });
                } else if (obj.event === 'delete') { // 监听删除操作
                    var checkStatus = table.checkStatus('currentTableId')
                    data = checkStatus.data;
                    layer.confirm('真的删除么', function (index) {
                        var arr = [];
                        for (var i = 0; i < data.length; i++) {
                            arr[i] = data[i].id;
                        }
                        $.ajax({
                            url: '/api/user/v1/notices/' + arr,
                            method: 'delete',
                            data: { 'id': arr },
                            contentType: 'application/json',
                            success: function (res) {
                                console.log(arr);
                                //重载表格
                                table.reload('currentTableId', {
                                    url: '/api/user/v1/notices',
                                    where: {}
                                });
                            },
                            error: function () {
                                layer.msg('删除失败');
                            }
                        })

                        layer.close(index);
                    });
                }
            });

            //  监听表格复选框选择
            table.on('checkbox(currentTableFilter)', function (obj) {
                console.log(obj)
            });

            table.on('tool(currentTableFilter)', function (obj) {
                var data = obj.data;
                if (obj.event === 'check') {
                    var index = layer.open({
                        title: '编辑',
                        type: 2,
                        shade: 0.2,
                        maxmin: true,
                        shadeClose: true,
                        area: ['100%', '100%'],
                        content: '/user/notices/edit',
                        success: function (layero, index) {
                            var body = layui.layer.getChildFrame('body', index);
                            body.find(".id").val(data.id);
                            body.find(".content").val(data.content);
                            body.find(".title").val(data.title);
                            body.find(".create_time").val(data.create_time);
                            body.find(".comment").val(data.comment);

                            var iframeWin = window[layero.find('iframe')[0]['name']];
                            iframeWin.layui.form.render()
                        },
                        end: function () {
                            //重载表格
                            table.reload('currentTableId', {
                                url: '/api/user/v1/notices',
                                where: {}
                            });
                        }

                    });
                    $(window).on("resize", function () {
                        layer.full(index);
                    });
                    return false;
                } else if (obj.event === 'delete') {
                    layer.confirm('真的删除么', function (index) {
                        var id = data.id;
                        $.ajax({
                            url: '/api/user/v1/notices/' + id,
                            method: 'delete',
                            data: '',
                            contentType: 'application/json',
                            success: function (res) {
                                layer.msg('删除成功');
                                obj.del();
                            },
                            error: function () {
                                layer.msg('删除失败');
                            }
                        })
                        layer.close(index);
                    });
                }
            });

            table.on("sort(currentTableFilter)", function (obj) {
                table.render({
                    initSort: obj, //记录初始排序，如果不设的话，将无法标记表头的排序状态。
                    elem: '#currentTableId',
                    url: '/api/user/v1/notices',
                    toolbar: '#toolbarDemo',
                    defaultToolbar: ['filter', 'exports', 'print', {
                        title: '提示',
                        layEvent: 'LAYTABLE_TIPS',
                        icon: 'layui-icon-tips'
                    }],
                    cols: [
                        [{
                            type: "checkbox",
                            width: 50
                        },
                        {
                            field: 'id',
                            width: 60,
                            title: 'ID',
                            sort: true
                        },
                        {
                            field: 'title',
                            width: 120,
                            title: '公告标题'
                        },
                        {
                            field: 'content',
                            width: 120,
                            title: '公告内容'
                        },
                        {
                            field: 'create_time',
                            width: 120,
                            title: '发布时间',
                            sort: true
                        },
                        {
                            field: 'update_time',
                            width: 120,
                            title: '更新时间',
                            sort: true
                        },
                        {
                            field: 'app_id',
                            width: 120,
                            title: '应用ID',
                            sort: true
                        },
                        {
                            field: 'comment',
                            width: 120,
                            title: '备注'
                        },
                        {
                            title: '操作',
                            minWidth: 150,
                            toolbar: '#currentTableBar',
                            align: "center"
                        }
                        ]
                    ],
                    limits: [10, 15, 20, 25, 50, 100],
                    limit: 15,
                    page: true,
                    skin: 'line',
                    parseData: function (res) { //将原始数据解析成 table 组件所规定的数据，res为从url中get到的数据
                        var result;
                        if (this.page.curr) {
                            result = res.data.slice(this.limit * (this.page.curr - 1), this.limit * this.page.curr);
                        } else {
                            result = res.data.slice(0, this.limit);
                        }
                        if (res.code == 200) {
                            res.code = 0;
                        }
                        return {
                            "code": res.code, //解析接口状态
                            "msg": res.msg, //解析提示文本
                            "count": res.count, //解析数据长度
                            "data": result //解析数据列表
                        };
                    },
                });

            });
        });
    </script>
    <script>
    //判断是否登录
    if (!window.localStorage.getItem('uToken')) {
        window.top.location.href = "/user/login";
    }
</script>
<script src="/static/js/setUtoken.js" charset="utf-8"></script>
</body>
</html>