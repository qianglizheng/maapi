<?php /*a:3:{s:62:"D:\phpstudy_pro\WWW\tp6.com\app\admin\view\market\install.html";i:1683295196;s:37:"../app/common/view/public/header.html";i:1682947624;s:37:"../app/common/view/public/footer.html";i:1682947773;}*/ ?>
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
    <link rel="stylesheet" href="/static/css/layuimini.css?v=2.0.4.2" media="all">
    <link rel="stylesheet" href="/static/css/themes/default.css" media="all">
    <link rel="stylesheet" href="/static/lib/font-awesome-4.7.0/css/font-awesome.min.css" media="all">
    <link rel="stylesheet" href="/static/css/public.css" media="all">
    <script src="/static/js/setToken.js" charset="utf-8"></script>
    <style id="layuimini-bg-color">
    </style>
    <script>
        //判断是否登录
        if (!window.localStorage.getItem('token')) {
            window.location = "/admin/login/index";
        }
    </script>
</head>
<div id="test" style="margin-bottom: 10px;"></div>
<div style="width: 380px;">
    <button type="button" class="layui-btn layui-btn-fluid">流体按钮（宽度自适应）</button>
  </div>
<script src="/static/lib/layui-v2.6.3/layui.js" charset="utf-8"></script>
<script>
    layui.use(function () {
        var element = layui.element;
        var $ = layui.$;
        // 动态插入进度条元素
        $('#test').html(`
        <div class="layui-progress layui-progress-big" lay-showpercent="true" lay-filter="demo-filter-progress">
          <div class="layui-progress-bar" lay-percent="70%"></div>
        </div>
        `);
        // 渲染进度条组件
        element.render('progress', 'demo-filter-progress');
        $('.layui-btn').click(function(){
          alert(111);
        })
    });
</script>
<script src="/static/js/setToken.js" charset="utf-8"></script>
</body>
</html>