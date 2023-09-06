<?php /*a:3:{s:60:"D:\phpstudy_pro\WWW\tp6.com\app\admin\view\market\admin.html";i:1690728032;s:37:"../app/common/view/public/header.html";i:1692460682;s:37:"../app/common/view/public/footer.html";i:1692460336;}*/ ?>
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
<body>
    <div class="layuimini-container">
        <div class="layuimini-main">
            <!-- <fieldset class="table-search-fieldset">
                <legend>搜索信息</legend>
                <div style="margin: 10px 10px 10px 10px">
                    <form class="layui-form layui-form-pane" action="">
                        <div class="layui-form-item">
                            <div class="layui-inline">
                                <label class="layui-form-label">应用名称</label>
                                <div class="layui-input-inline">
                                    <input type="text" name="app_name" autocomplete="off" class="layui-input">
                                </div>
                            </div>
                            <div class="layui-inline">
                                <button type="submit" class="layui-btn layui-btn-primary" lay-submit
                                    lay-filter="data-search-btn"><i class="layui-icon"></i> 搜 索</button>
                            </div>
                        </div>
                    </form>
                </div>
            </fieldset> -->
            <!-- <script type="text/html" id="toolbarDemo"> -->
            <!-- <div class="layui-btn-container">
                    <button class="layui-btn layui-btn-normal layui-btn-sm data-add-btn" lay-event="add"> 添加 </button>
                    <button class="layui-btn layui-btn-sm layui-btn-danger data-delete-btn" lay-event="delete"> 删除 </button>
                </div> -->
            <!-- </script> -->

            <table class="layui-hide" id="currentTableId" lay-filter="currentTableFilter"></table>

            <script type="text/html" id="currentTableBar">
                <a class="layui-btn layui-btn-normal layui-btn-xs data-count-edit" lay-event="check">安装</a>
                <a class="layui-btn layui-btn-xs layui-btn-danger data-count-delete" lay-event="delete">卸载</a>
            </script>

        </div>
    </div>
    <script src="/static/lib/layui-v2.6.3/layui.js" charset="utf-8"></script>
    <script>
        layui.use(['form', 'table'], function () {
            var $ = layui.jquery,
                form = layui.form,
                table = layui.table;
            //判断登录 
            if (!window.localStorage.getItem('addons-token')) {
                layer.open({
                    type: 1,
                    area: '350px',
                    resize: false,
                    shadeClose: true,
                    title: '登录',
                    content: `
                    <div class="layui-form" lay-filter="filter-test-layer" style="margin: 16px;">
                        <div class="demo-login-container">
                        <div class="layui-form-item">
                            <div class="layui-input-wrap">
                            <div class="layui-input-prefix">
                                <i class="layui-icon layui-icon-username"></i>
                            </div>
                            <input type="text" name="username" value="" lay-verify="required" placeholder="邮箱或者手机号" lay-reqtext="请填写邮箱或者手机号" autocomplete="off" class="layui-input" lay-affix="clear">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <div class="layui-input-wrap">
                            <div class="layui-input-prefix">
                                <i class="layui-icon layui-icon-password"></i>
                            </div>
                            <input type="password" name="password" value="" lay-verify="required" placeholder="验证码" lay-reqtext="请填写验证码" autocomplete="off" class="layui-input" lay-affix="eye">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <button class="layui-btn layui-btn-fluid" lay-submit lay-filter="send" style="margin-bottom:10px;">获取验证码</button>
                        </div>
                        <div class="layui-form-item">
                            <button class="layui-btn layui-btn-fluid" lay-submit lay-filter="demo-login">登录</button>
                        </div>
                        </div>
                    </div>
                    `,
                    success: function () {
                        // 对弹层中的表单进行初始化渲染
                        form.render();
                        // 表单提交事件
                        form.on('submit(demo-login)', function (data) {
                            var field = data.field; // 获取表单字段值
                            // 显示填写结果，仅作演示用
                            layer.alert(JSON.stringify(field), {
                                title: '当前填写的字段值'
                            });
                            // 此处可执行 Ajax 等操作
                            // …
                            return false; // 阻止默认 form 跳转
                        });
                    }
                });


        // window.location = "/admin/login/index";
        }
        table.render({
            elem: '#currentTableId',
            url: 'http://120.48.58.230/addons/sql.php/users',
            toolbar: '#toolbarDemo',
            defaultToolbar: ['filter', 'exports', 'print', {
                title: '提示',
                layEvent: 'LAYTABLE_TIPS',
                icon: 'layui-icon-tips'
            }],
            cols: [
                [
                    {
                        field: 'id',
                        width: 60,
                        title: 'ID',
                        sort: true
                    },
                    {
                        field: 'title',
                        width: 120,
                        title: '插件名'
                    },
                    {
                        field: 'description',
                        width: 120,
                        title: '描述'
                    },
                    {
                        field: 'version',
                        width: 120,
                        title: '版本'
                    },
                    {
                        field: 'money',
                        width: 120,
                        title: '价格'
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
                console.log(this);
                console.log(JSON.stringify(res));
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
                    app_name: data.field.app_name
                }
            }, 'data');
            return false;
        });




        /**
         * toolbar监听事件
         */

        //  监听表格复选框选择

        table.on('tool(currentTableFilter)', function (obj) {
            var data = obj.data;
            if (obj.event === 'check') {
                var index = layer.open({
                    title: '安装',
                    type: 2,
                    shade: 0.2,
                    maxmin: true,
                    shadeClose: true,
                    area: ['420px', '240px'],
                    content: '/admin/market/install.html',
                    success: function (layero, index) {
                        var body = layui.layer.getChildFrame('body', index);
                        body.find(".id").val(data.id);
                        body.find(".username").val(data.username);
                        body.find(".email").val(data.email);
                        body.find(".mobile").val(data.mobile);
                        body.find(".nickname").val(data.nickname);
                        body.find(".money").val(data.money);
                        body.find(".score").val(data.score);
                        body.find(".create_ip").val(data.create_ip);
                        body.find(".create_time").val(data.create_time);
                        body.find(".last_login_ip").val(data.last_login_ip);
                        body.find(".last_login_time").val(data.last_login_time);
                        if (body.find('.users_groups').val() == data.group) {
                            body.find('.users_groups').attr('selected', 'selected');
                        }
                        if (data.status == '正常') {
                            body.find('.ok').attr('selected', 'selected');
                        } else if (data.status == '封禁') {
                            body.find('.no').attr('selected', 'selected');
                        }
                        var iframeWin = window[layero.find('iframe')[0]['name']];
                        iframeWin.layui.form.render()
                    },
                    end: function () {
                        //重载表格
                        table.reload('currentTableId', {
                            url: 'http://120.48.58.230/addons/sql.php/users',
                            where: {}
                        });
                    }

                });
                $(window).on("resize", function () {
                    layer.full(index);
                });
                return false;
            } else if (obj.event === 'delete') {
                layer.confirm('确定要卸载吗', function (index) {
                    var id = data.id;
                    $.post('../api/app_del', {
                        'id': id
                    }, function (res) {
                        if (res == '1') {
                            obj.del();
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
                url: 'http://120.48.58.230/addons/sql.php/users',
                toolbar: '#toolbarDemo',
                defaultToolbar: ['filter', 'exports', 'print', {
                    title: '提示',
                    layEvent: 'LAYTABLE_TIPS',
                    icon: 'layui-icon-tips'
                }],
                cols: [
                    [
                        {
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
                            title: '插件名'
                        },
                        {
                            field: 'description',
                            width: 120,
                            title: '描述'
                        },
                        {
                            field: 'version',
                            width: 120,
                            title: '版本'
                        },
                        {
                            field: 'money',
                            width: 120,
                            title: '价格'
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
                    console.log(this);
                    console.log(JSON.stringify(res));
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
    if (!window.localStorage.getItem('token')) {
        window.top.location.href = "/admin/login";
    }
</script>
<script src="/static/js/setToken.js" charset="utf-8"></script>
</body>

</html>