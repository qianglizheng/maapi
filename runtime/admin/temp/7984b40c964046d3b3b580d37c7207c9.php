<?php /*a:3:{s:58:"D:\phpstudy_pro\WWW\tp6.com\app\admin\view\config\Api.html";i:1691150351;s:37:"../app/common/view/public/header.html";i:1692460682;s:37:"../app/common/view/public/footer.html";i:1692460336;}*/ ?>
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
                <fieldset class="layui-elem-field layui-field-title" style="margin-top: 50px;">
                    <legend>接口安全</legend>
                </fieldset>
                <div class="layui-form-item">
                    <label class="layui-form-label">Sign签名验证</label>
                    <div class="layui-input-block">
                        <input type="checkbox" value="1" name="security_sign" lay-skin="switch" lay-text="ON|OFF">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">Sign签名盐</label>
                    <div class="layui-input-block">
                        <input type="text" name="security_sign_key" placeholder="请输入签名加密盐" value=""
                            class="layui-input security_sign_key">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">时间戳验证</label>
                    <div class="layui-input-block">
                        <input type="checkbox" value="1" name="security_timestamp" lay-skin="switch"
                            lay-filter="switchTest" lay-text="ON|OFF">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">请求超时时间</label>
                    <div class="layui-input-block">
                        <input type="text" name="security_timestamp_timeout" placeholder="请输入超时时间" value=""
                            class="layui-input security_timestamp_timeout">
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
            $.get('/api/admin/v1/api/1', {}, function (res) {
                console.log(res);
                if (res.code == '200') {
                    $('[name=security_sign_key]').val(res.data.security_sign_key);
                    $('[name=security_timestamp_timeout]').val(res.data.security_timestamp_timeout);
                    if (res.data.security_sign == 1) {
                        $('[name=security_sign]').attr('checked', 'checked');
                    }
                    if (res.data.security_timestamp == 1) {
                        $('[name=security_timestamp]').attr('checked', 'checked');
                    }
                    form.render();
                } else {
                    layer.msg(res.msg, { icon: 2 });
                }
            })

            //监听提交
            form.on('submit(saveBtn)', function (data) {
                data.field._method = 'PUT';
                if (data.field.security_sign == undefined) {
                    data.field.security_sign = 0;
                }
                if (data.field.security_timestamp == undefined) {
                    data.field.security_timestamp = 0;
                }
                $.post('/api/admin/v1/api/1', data.field, function (res) {
                    if (res.code == '200') {
                        layer.msg(res.msg, { icon: 1 });
                    } else if (res.code == '400' && res.msg == 'token错误') {
                        layer.msg(res.msg, { icon: 2 });
                        localStorage.removeItem('token');
                    } else {
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