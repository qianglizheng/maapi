<?php /*a:3:{s:58:"D:\phpstudy_pro\WWW\tp6.com\app\admin\view\config\Key.html";i:1689571692;s:37:"../app/common/view/public/header.html";i:1692460682;s:37:"../app/common/view/public/footer.html";i:1692460336;}*/ ?>
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
    .layui-form-item .layui-input-company {width: auto;padding-right: 10px;line-height: 38px;}
</style>
<body>
    <div class="layuimini-container">
        <div class="layuimini-main">

            <div class="layui-form layuimini-form">
                <div class="layui-form-item">
                    <label class="layui-form-label">管理后台KEY:</label>
                    <div class="layui-input-block">
                        <input type="text" name="admin" placeholder="请输入管理后台KEY" value="" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">用户后台KEY:</label>
                    <div class="layui-input-block">
                        <input type="text" name="user" placeholder="请输入用户后台KEY" value="" class="layui-input">
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
            
            //获取信息
            $.get('/api/admin/v1/key/1', {}, function (res) {
                if (res.code == '200') {
                    $('[name=user]').val(res.data.user);
                    $('[name=admin]').val(res.data.admin);
                } else {
                    layer.msg(res.msg, { icon: 2 });
                }
            })
            
            //监听提交
            form.on('submit(saveBtn)', function (data) {
                data.field._method = 'PUT';
                $.post('/api/admin/v1/key/1', data.field, function (res) {
                    if (res.code == '200') {
                        layer.msg(res.msg, { icon: 1 });
                    } else if(res.code == '400' && res.msg=='token错误') {
                        layer.msg(res.msg, { icon: 2 });
                        localStorage.removeItem('token');
                    }else{
                        layer.msg(res.msg, { icon: 2 });
                    }
                })
                return false;
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