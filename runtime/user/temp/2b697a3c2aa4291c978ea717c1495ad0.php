<?php /*a:3:{s:58:"D:\phpstudy_pro\WWW\tp6.com\app\user\view\notices\add.html";i:1697977696;s:38:"../app/common/view/public/uHeader.html";i:1697116602;s:38:"../app/common/view/public/uFooter.html";i:1695986854;}*/ ?>
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
        <!-- <input type="hidden" name="id" value="" class="id"> -->
        <div class="layui-form-item">
            <label class="layui-form-label">公告标题：</label>
            <div class="layui-input-block">
                <input type="text" name="title" placeholder="" value="" autocomplete="off"
                    class="layui-input title">
            </div>
        </div>
        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">公告内容：</label>
            <div class="layui-input-block">
                <textarea placeholder="请输入内容" name="content" class="layui-textarea content"></textarea>
            </div>
        </div>
        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">备注：</label>
            <div class="layui-input-block">
                <textarea placeholder="请输入内容" name="comment" class="layui-textarea comment"></textarea>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">发布时间：</label>
            <div class="layui-input-block">
                <input type="datetime-local" name="notice_time" value="" class="layui-input notice_time">
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
                    url: "/api/user/v1/notices", //请求url
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