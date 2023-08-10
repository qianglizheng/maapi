<?php /*a:3:{s:59:"D:\phpstudy_pro\WWW\tp6.com\app\admin\view\config\Base.html";i:1689571685;s:37:"../app/common/view/public/header.html";i:1691385662;s:37:"../app/common/view/public/footer.html";i:1691251626;}*/ ?>
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
            <fieldset class="layui-elem-field layui-field-title" style="margin-top: 50px;">
                <legend>网站信息</legend>
            </fieldset>
            <div class="layui-form layuimini-form">
                <div class="layui-form-item">
                    <label class="layui-form-label">网站LOGO:</label>
                    <div class="layui-input-block">
                        <div class="layui-upload">
                            <button type="button" class="layui-btn" id="test1">上传图片</button>
                            <div class="layui-upload-list">
                                <img class="layui-upload-img logo" style="width:92px;height:92px;" id="demo1">
                                <p id="demoText"></p>
                                <input type="hidden" name="logo" placeholder="请输入邮箱" value="" class="layui-input logo">
                            </div>
                            <div style="width: 95px;">
                                <div class="layui-progress layui-progress-big" lay-showpercent="yes" lay-filter="demo">
                                    <div class="layui-progress-bar" lay-percent=""></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">网站名称:</label>
                    <div class="layui-input-block">
                        <input type="text" name="title" placeholder="请输入网站名称" value="" class="layui-input title">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">网站副标题:</label>
                    <div class="layui-input-block">
                        <input type="text" name="subhead" placeholder="请输入网站副标题" value="" class="layui-input subhead">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">网站关键词:</label>
                    <div class="layui-input-block">
                        <input type="text" name="keyword" placeholder="请输入网站关键词" value="" class="layui-input keyword">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">网站描述:</label>
                    <div class="layui-input-block">
                        <input type="text" name="description" placeholder="请输入网站描述" value="" class="layui-input description">
                    </div>
                </div>
                <fieldset class="layui-elem-field layui-field-title" style="margin-top: 50px;">
                    <legend>备案信息</legend>
                </fieldset>
                <div class="layui-form layuimini-form">
                    <div class="layui-form-item">
                        <label class="layui-form-label">email备案编号:</label>
                        <div class="layui-input-block">
                            <input type="text" name="email" placeholder="请输入email备案编号" value="" class="layui-input email">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">公安备案文字:</label>
                        <div class="layui-input-block">
                            <input type="text" name="mobile" placeholder="请输入公安备案文字" value="" class="layui-input mobile">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">公安备案链接:</label>
                        <div class="layui-input-block">
                            <input type="text" name="address" placeholder="请输入公安备案链接" value="" class="layui-input address">
                        </div>
                    </div>
                    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 50px;">
                        <legend>联系信息</legend>
                    </fieldset>
                    <div class="layui-form layuimini-form">
                        <div class="layui-form-item">
                            <label class="layui-form-label">邮箱:</label>
                            <div class="layui-input-block">
                                <input type="text" name="email" placeholder="请输入邮箱" value="" class="layui-input email">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">手机:</label>
                            <div class="layui-input-block">
                                <input type="text" name="mobile" placeholder="请输入手机" value="" class="layui-input mobile">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">地址:</label>
                            <div class="layui-input-block">
                                <input type="text" name="address" placeholder="请输入地址" value="" class="layui-input address">
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
            layui.use(['form', 'miniTab','upload','element'], function () {
                var form = layui.form,
                    upload = layui.upload,
                    layer = layui.layer,
                    element = layui.element,
                    miniTab = layui.miniTab;
                $ = layui.$;

                //常规使用 - 普通图片上传
                var uploadInst = upload.render({
                    elem: '#test1'
                    , url: 'http://127.0.0.1/api/v1/upload/local' //此处用的是第三方的 http 请求演示，实际使用时改成您自己的上传接口即可。
                    , data: {path:'logo'}
                    , before: function (obj) {
                        //预读本地文件示例，不支持ie8
                        obj.preview(function (index, file, result) {
                            $('#demo1').attr('src', result); //图片链接（base64）
                        });

                        element.progress('demo', '0%'); //进度条复位
                        layer.msg('上传中', { icon: 16, time: 0 });
                    }
                    , done: function (res) {
                        //如果上传失败
                        if (res.code != 200) {
                            return layer.msg('上传失败');
                        }
                        //上传成功的一些操作
                        //……
                        $('.logo').val(res.data[0]);
                        console.log(res.data[0]);
                        $('#demoText').html(''); //置空上传失败的状态
                    }
                    , error: function () {
                        //演示失败状态，并实现重传
                        var demoText = $('#demoText');
                        demoText.html('<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-xs demo-reload">重试</a>');
                        demoText.find('.demo-reload').on('click', function () {
                            uploadInst.upload();
                        });
                    }
                    //进度条
                    , progress: function (n, elem, e) {
                        element.progress('demo', n + '%'); //可配合 layui 进度条元素使用
                        if (n == 100) {
                            layer.msg('上传完毕', { icon: 1 });
                        }
                    }
                });

                //获取信息
                $.get('/api/admin/v1/base/1', {}, function (res) {
                    if (res.code == '200') {
                        $('.logo').attr('src','//'+res.data.logo);
                        $('.title').val(res.data.title);
                        $('.subhead').val(res.data.subhead);
                        $('.keyword').val(res.data.keyword);
                        $('.description').val(res.data.description);
                        $('.email').val(res.data.email);
                        $('.mobile').val(res.data.mobile);
                        $('.address').val(res.data.address);
                    } else if (res.code == '400' && res.msg == 'token错误') {
                        layer.msg(res.msg, { icon: 2 });
                        localStorage.removeItem('token');
                    } else {
                        layer.msg(res.msg, { icon: 2 });
                    }
                })

                //监听提交
                form.on('submit(saveBtn)', function (data) {
                    data.field._method = 'PUT';
                    $.post('/api/admin/v1/base/1', data.field, function (res) {
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
        window.top.location.href = "/admin/login/index";
    }
</script>
<script src="/static/js/setToken.js" charset="utf-8"></script>
</body>

</html>