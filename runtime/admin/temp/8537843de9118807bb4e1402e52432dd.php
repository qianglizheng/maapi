<?php /*a:3:{s:58:"D:\phpstudy_pro\WWW\tp6.com\app\admin\view\users\edit.html";i:1694247683;s:37:"../app/common/view/public/header.html";i:1692460682;s:37:"../app/common/view/public/footer.html";i:1692460336;}*/ ?>
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
            <label class="layui-form-label">用户 ID：</label>
            <div class="layui-input-block">
                <input type="text" name="id" value="" autocomplete="off" disabled="disabled" class="layui-input id" style="background-color: rgb(245,245,245);">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label required">用户名：</label>
            <div class="layui-input-block">
                <input type="text" name="username" value="" autocomplete="off" class="layui-input username" disabled style="background-color: rgb(245,245,245);">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">用户密码：</label>
            <div class="layui-input-block">
                <input type="text" name="password" placeholder="不修改不要填" value="" autocomplete="off"
                    class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">邮箱：</label>
            <div class="layui-input-block">
                <input type="text" name="email" placeholder="请输入邮箱" value="" autocomplete="off"
                    class="layui-input email">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">手机：</label>
            <div class="layui-input-block">
                <input type="text" name="mobile" placeholder="请输入手机" value="" autocomplete="off"
                    class="layui-input mobile">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label required">昵称：</label>
            <div class="layui-input-block">
                <input type="text" name="nickname" lay-verify="required" lay-reqtext="昵称不能为空" placeholder="请输入昵称"
                    value="" autocomplete="off" class="layui-input nickname">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label required">余额：</label>
            <div class="layui-input-block">
                <input type="text" name="money" lay-verify="required" lay-reqtext="余额不能为空" placeholder="请输入余额" value=""
                    autocomplete="off" class="layui-input money">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label required">积分：</label>
            <div class="layui-input-block">
                <input type="text" name="score" lay-verify="required" lay-reqtext="积分不能为空" placeholder="请输入积分" value=""
                    autocomplete="off" class="layui-input score">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">VIP：</label>
            <div class="layui-input-block">
                <select name="vip" id="vip">
                    <option value="" class="vip-groups"></option>
                    <option value="0" class="vip-groups" selected>无</option>
                    <option value="普通VIP" class="vip_groups">普通VIP</option>
                </select>
                <tip>插件可拓展更多 VIP</tip>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">开通时间：</label>
            <div class="layui-input-block">
                <input type="text" name="" value="" disabled="disabled" class="layui-input vip_start_time" style="background-color: rgb(245,245,245);">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">到期时间：</label>
            <div class="layui-input-block">
                <input type="date" name="vip_end_time" value="0" class="layui-input vip_end_time">
                <tip class="vip_end_time_tip" style="color:red"></tip>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">分组：</label>
            <div class="layui-input-block">
                <select name="group" lay-filter="aihao" id="users">
                    <option value="" class="users-groups"></option>
                    <option value="普通会员" class="users_groups">普通会员</option>
                </select>
                <tip>插件可拓展更多分组</tip>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">状态：</label>
            <div class="layui-input-block">
                <select name="status" lay-filter="aihao">
                    <option value=""></option>
                    <option value="封禁" class="no">封禁</option>
                    <option value="正常" class="ok">正常</option>
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">注册 IP：</label>
            <div class="layui-input-block">
                <input type="text" name="" value="" disabled="disabled" class="layui-input create_ip" style="background-color: rgb(245,245,245);">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">注册时间：</label>
            <div class="layui-input-block">
                <input type="text" name="" value="" disabled="disabled" class="layui-input create_time" style="background-color: rgb(245,245,245);">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">登录 IP：</label>
            <div class="layui-input-block">
                <input type="text" name="" value="" disabled="disabled" class="layui-input last_login_ip" style="background-color: rgb(245,245,245);">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">登录时间：</label>
            <div class="layui-input-block">
                <input type="text" name="" value="" disabled="disabled" class="layui-input last_login_time" style="background-color: rgb(245,245,245);">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">更新时间：</label>
            <div class="layui-input-block">
                <input type="text" name="" value="" disabled="disabled" class="layui-input update_time" style="background-color: rgb(245,245,245);">
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn layui-btn-normal" lay-submit lay-filter="saveBtn">确认修改</button>
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

            //获取用户分组
            $.get('/addons/admin/users-groups', {}, function (res) {
                res.data.forEach(data => {
                    $('#users').append(`<option value="${data.name}" class="users_groups">${data.name}</option>`);
                    form.render();
                })
            })

            //获取 VIP 分组
            $.get('/addons/admin/vip-groups', {}, function (res) {
                res.data.forEach(data => {
                    $('#vip').append(`<option value="${data.name}" class="vip_groups">${data.name}</option>`);
                    form.render();
                })
            })

            //监听提交
            form.on('submit(saveBtn)', function (data) {
                data.field.password = data.field.password.MD5(32);
                $.ajax({
                    url: `/api/admin/v1/users/${data.field.id}`, //请求url
                    method: 'PUT', //请求方法
                    data: JSON.stringify(data.field), //请求数据
                    contentType: 'application/json', //请求数据类型
                    success: function (res) {
                        if (res.code == '204' || res.code == '200') {
                            layer.msg('修改成功')
                            setTimeout(function () {
                                var iframeIndex = parent.layer.getFrameIndex(window.name);
                                parent.layer.close(iframeIndex);
                            }, 1000)
                        };
                        if (res.code == '400') {
                            layer.msg('修改失败' + res.msg)
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
        window.top.location.href = "/admin/login";
    }
</script>
<script src="/static/js/setToken.js" charset="utf-8"></script>
</body>

</html>