<?php /*a:3:{s:58:"D:\phpstudy_pro\WWW\tp6.com\app\admin\view\user\index.html";i:1691251735;s:37:"../app/common/view/public/header.html";i:1689570562;s:37:"../app/common/view/public/footer.html";i:1691251626;}*/ ?>
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
    <link rel="icon" href="/static/images/favicon.ico">
<link rel="stylesheet" href="/static/lib/layui-v2.6.3/css/layui.css" media="all">
<link rel="stylesheet" href="/static/css/public.css" media="all">
<style>
    .layui-form-item .layui-input-company {
        width: auto;
        padding-right: 10px;
        line-height: 38px;
    }
</style>
</head>

<body>
    <div class="layuimini-container">
        <div class="layuimini-main">

            <div class="layui-form layuimini-form">
                <div class="layui-form-item">
                    <label class="layui-form-label required">管理账号</label>
                    <div class="layui-input-block">
                        <input type="text" name="username" lay-verify="required" lay-reqtext="管理账号不能为空"
                            placeholder="请输入管理账号" value="" class="layui-input">
                        <tip>填写自己管理账号的名称。</tip>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">密码</label>
                    <div class="layui-input-block">
                        <input type="text" name="password" placeholder="请输入新密码" value="" class="layui-input">
                        <tip>不修改不要填写。</tip>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label required">手机</label>
                    <div class="layui-input-block">
                        <input type="number" name="mobile" lay-verify="required" lay-reqtext="手机不能为空"
                            placeholder="请输入手机" value="" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">邮箱</label>
                    <div class="layui-input-block">
                        <input type="email" name="email" placeholder="请输入邮箱" value="" class="layui-input">
                    </div>
                </div>

                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button class="layui-btn layui-btn-normal" lay-submit lay-filter="saveBtn">确认保存</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/static/lib/layui-v2.6.3/layui.js" charset="utf-8"></script>
    <script src="/static/js/lay-config.js?v=1.0.4" charset="utf-8"></script>
    <script src="/static/js/md5.js" charset="utf-8"></script>
    <script>
        layui.use(['form', 'miniTab'], function () {
            var form = layui.form,
                layer = layui.layer,
                miniTab = layui.miniTab;

            $.get('/api/admin/v1/user', {}, function (res) {
                console.log(res.data.email);
                $("[name='email']").val(res.data.email);
                $("[name='mobile']").val(res.data.mobile);
                $("[name='username']").val(res.data.username);
            })

            //监听提交
            form.on('submit(saveBtn)', function (data) {
                if (data.field.password == "") {
                    delete data.field.password
                } else {
                    data.field.password = data.field.password.MD5(32)
                }
                $.ajax({
                    url: "/api/admin/v1/user", //请求url
                    method: 'PUT', //请求方法
                    data: JSON.stringify(data.field), //请求数据
                    contentType: 'application/json', //请求数据类型
                    success: function (res) {
                        if (res.code == '204' || res.code == '200') {
                            layer.msg('修改成功')
                            if (data.field.password != "" || data.field.username != "") {
                                localStorage.removeItem("token")
                                window.top.location.href = "/admin/login/index"
                            }
                            setTimeout(function () {
                                var iframeIndex = parent.layer.getFrameIndex(window.name);
                                parent.layer.close(iframeIndex)
                            }, 1000)
                        };
                        if (res.code == '400') {
                            layer.msg('修改成功')
                            if (data.field.password != "" || data.field.username != "") {
                                localStorage.removeItem("token")
                                window.top.location.href = "/admin/login/index";
                            }
                            setTimeout(function () {
                                var iframeIndex = parent.layer.getFrameIndex(window.name);
                                parent.layer.close(iframeIndex);
                            }, 1000)
                        };
                    },
                    error: function () {
                        layer.msg('修改失败')
                        setTimeout(function () {
                            var iframeIndex = parent.layer.getFrameIndex(window.name);
                            parent.layer.close(iframeIndex);
                        }, 1000)
                    }
                });
                return false;
            });

        });
    </script>
    <script>
    //判断是否登录
    if (!window.localStorage.getItem('token')) {
        window.top.location.href = "/admin/login/index";
    }
</script>
<script src="/static/js/setToken.js" charset="utf-8"></script>
</body>

</html>