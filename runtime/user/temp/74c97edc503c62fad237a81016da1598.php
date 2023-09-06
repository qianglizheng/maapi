<?php /*a:3:{s:59:"D:\phpstudy_pro\WWW\tp6.com\app\user\view\config\email.html";i:1692460004;s:38:"../app/common/view/public/Uheader.html";i:1692177891;s:38:"../app/common/view/public/Ufooter.html";i:1692460672;}*/ ?>
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
<style>
    .layui-form-item .layui-input-company {
        width: auto;
        padding-right: 10px;
        line-height: 38px;
    }
</style>

<body>
    <div class="layuimini-container">
        <div class="layuimini-main">

            <div class="layui-form layuimini-form">
                <div class="layui-form-item">
                    <label class="layui-form-label">SMTP服务器地址:</label>
                    <div class="layui-input-block">
                        <input type="text" name="host" placeholder="请输入SMTP服务器地址" value="" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">SMTP用户名:</label>
                    <div class="layui-input-block">
                        <input type="text" name="username" placeholder="请输入SMTP用户名" value="" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">SMTP密码:</label>
                    <div class="layui-input-block">
                        <input type="text" name="password" placeholder="请输入SMTP密码" value="" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">TCP端口:</label>
                    <div class="layui-input-block">
                        <input type="text" name="port" placeholder="请输入端口" value="" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button type="submit" class="layui-btn layui-btn-normal" lay-submit
                            lay-filter="saveBtn">确认保存</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/static/lib/layui-v2.6.3/layui.js" charset="utf-8"></script>
    <script src="/static/js/lay-config.js?v=1.0.4" charset="utf-8"></script>
    <script>
        layui.use(['form', 'miniTab'], function () {
            var form = layui.form,
                layer = layui.layer,
                miniTab = layui.miniTab;
            $ = layui.$;

            let a = localStorage.getItem('uToken').split('.')
            let userData = JSON.parse(atob(a[1]))
            //获取信息
            $.get('/api/user/v1/email/' + userData.id, {}, function (res) {
                if (res.code == '200') {
                    $('[name=host]').val(res.data.host);
                    $('[name=username]').val(res.data.username);
                    $('[name=password]').val(res.data.password);
                    $('[name=port]').val(res.data.port);
                } else {
                    layer.msg(res.msg, { icon: 2 });
                }
            })

            //监听提交
            form.on('submit(saveBtn)', function (data) {
                $.ajax({
                    url: "/api/user/v1/email/" + userData.id,
                    method: 'PUT', //请求方法
                    data: JSON.stringify(data.field), //请求数据
                    contentType: 'application/json', //请求数据类型
                    success: function (res) {
                        if (res.code == '204' || res.code == '200') {
                            layer.msg(res.msg, { icon: 1 });
                        } else if (res.code == '400') {
                            layer.msg(res.msg, { icon: 2 });
                        } else {
                            layer.msg(res.msg, { icon: 2 });
                        }
                    },
                    error: function () {
                        layer.msg('修改失败',{icon : 2})
                    }
                });
                return false;
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