<?php /*a:3:{s:55:"D:\phpstudy_pro\WWW\tp6.com\app\user\view\apps\add.html";i:1694935531;s:38:"../app/common/view/public/uHeader.html";i:1692177891;s:38:"../app/common/view/public/uFooter.html";i:1692460672;}*/ ?>
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
    <div class="layui-form layuimini-form">
        <div class="layui-form-item">
            <label class="layui-form-label required">应用名：</label>
            <div class="layui-input-block">
                <input type="text" name="name" lay-verify="required" lay-reqtext="应用名不能为空" placeholder="请输入应用名" value=""
                    autocomplete="off" class="layui-input name">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label required">应用KEY：</label>
            <div class="layui-input-block">
                <input type="text" name="key" lay-verify="required" lay-reqtext="应用KEY不能为空" placeholder="请输入应用KEY"
                    value="key" autocomplete="off" class="layui-input key">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">时间戳验证：</label>
            <div class="layui-input-block">
                <select name="security_timestamp" id="security_timestamp">
                    <option value="1" class="security_timestamp">开启</option>
                    <option value="0" class="security_timestamp" selected>关闭</option>
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">签名验证：</label>
            <div class="layui-input-block">
                <select name="security_sign" id="security_sign">
                    <option value="1" class="security_sign">开启</option>
                    <option value="0" class="security_sign" selected>关闭</option>
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label required">签名KEY：</label>
            <div class="layui-input-block">
                <input type="text" name="security_sign_key" lay-verify="required" lay-reqtext="不能为空" placeholder="请输入签名KEY"
                    value="key" autocomplete="off" class="layui-input security_sign_key">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label required">超时时间：</label>
            <div class="layui-input-block">
                <input type="text" name="security_timestamp_timeout" lay-verify="required" lay-reqtext="超时时间不能为空"
                    placeholder="请输入超时时间" value="3600" autocomplete="off"
                    class="layui-input security_timestamp_timeout">
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn layui-btn-normal" lay-submit lay-filter="saveBtn">确认添加</button>
            </div>
        </div>
    </div>
    <script src="/static/lib/layui-v2.6.3/layui.js" charset="utf-8"></script>
    <script src="/static/js/md5.js" charset="utf-8"></script>
    <script>
        layui.use(['form', 'layer'], function () {
            var form = layui.form,
                layer = layui.layer,
                $ = layui.$;

            //监听提交
            form.on('submit(saveBtn)', function (data) {
                $.ajax({
                    url: "/api/user/v1/apps", //请求url
                    method: 'POST', //请求方法
                    data: JSON.stringify(data.field), //请求数据
                    contentType: 'application/json', //请求数据类型
                    success: function (res) {
                        if (res.code == '204' || res.code == '200') {
                            layer.msg('添加成功')
                            setTimeout(function () {
                                var iframeIndex = parent.layer.getFrameIndex(window.name);
                                parent.layer.close(iframeIndex);
                            }, 1000)
                        };
                        if (res.code == '400') {
                            layer.msg('添加失败')
                            setTimeout(function () {
                                var iframeIndex = parent.layer.getFrameIndex(window.name);
                                parent.layer.close(iframeIndex);
                            }, 1000)
                        };
                    },
                    error: function () {
                        layer.msg('添加失败')
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
    if (!window.localStorage.getItem('uToken')) {
        window.top.location.href = "/user/login";
    }
</script>
<script src="/static/js/setUtoken.js" charset="utf-8"></script>
</body>
</html>