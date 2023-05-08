<?php /*a:3:{s:59:"D:\phpstudy_pro\WWW\tp6.com\app\admin\view\index\index.html";i:1683462979;s:37:"../app/common/view/public/header.html";i:1682947624;s:37:"../app/common/view/public/footer.html";i:1682947773;}*/ ?>
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
<body class="layui-layout-body layuimini-all">
    <div class="layui-layout layui-layout-admin">

        <div class="layui-header header">
            <div class="layui-logo layuimini-logo"></div>

            <div class="layuimini-header-content">
                <a>
                    <div class="layuimini-tool"><i title="展开" class="fa fa-outdent" data-side-fold="1"></i></div>
                </a>

                <!--电脑端头部菜单-->
                <ul
                    class="layui-nav layui-layout-left layuimini-header-menu layuimini-menu-header-pc layuimini-pc-show">
                </ul>

                <!--手机端头部菜单-->
                <ul class="layui-nav layui-layout-left layuimini-header-menu layuimini-mobile-show">
                    <li class="layui-nav-item">
                        <a href="javascript:;"><i class="fa fa-list-ul"></i> 选择模块</a>
                        <dl class="layui-nav-child layuimini-menu-header-mobile">
                        </dl>
                    </li>
                </ul>

                <ul class="layui-nav layui-layout-right">

                    <li class="layui-nav-item" lay-unselect>
                        <a href="javascript:;" data-refresh="刷新"><i class="fa fa-refresh"></i></a>
                    </li>
                    <li class="layui-nav-item" lay-unselect>
                        <a href="javascript:;" data-clear="清理" class="layuimini-clear"><i class="fa fa-trash-o"></i></a>
                    </li>
                    <li class="layui-nav-item mobile layui-hide-xs" lay-unselect>
                        <a href="javascript:;" data-check-screen="full"><i class="fa fa-arrows-alt"></i></a>
                    </li>
                    <li class="layui-nav-item layuimini-setting">
                        <a href="javascript:;">我的</a>
                        <dl class="layui-nav-child">
                            <dd>
                                <a href="javascript:;" layuimini-content-href="admin/user/user_setting"
                                    data-title="基本资料" data-icon="fa fa-gears">基本资料<span
                                        class="layui-badge-dot"></span></a>
                            </dd>
                            <dd>
                                <a href="javascript:;" layuimini-content-href="admin/epay/index" data-title="余额充值"
                                    data-icon="fa fa-gears">余额充值</a>
                            </dd>
                            <dd>
                                <hr>
                            </dd>
                            <dd>
                                <a href="javascript:;" class="login-out">退出登录</a>
                            </dd>
                        </dl>
                    </li>
                    <li class="layui-nav-item layuimini-select-bgcolor" lay-unselect>
                        <a href="javascript:;" data-bgcolor="配色方案"><i class="fa fa-ellipsis-v"></i></a>
                    </li>
                </ul>
            </div>
        </div>

        <!--无限极左侧菜单-->
        <div class="layui-side layui-bg-black layuimini-menu-left">
        </div>

        <!--初始化加载层-->
        <div class="layuimini-loader">
            <div class="layuimini-loader-inner"></div>
        </div>

        <!--手机端遮罩层-->
        <div class="layuimini-make"></div>

        <!-- 移动导航 -->
        <div class="layuimini-site-mobile"><i class="layui-icon"></i></div>

        <div class="layui-body">

            <div class="layuimini-tab layui-tab-rollTool layui-tab" lay-filter="layuiminiTab" lay-allowclose="true">
                <ul class="layui-tab-title">
                    <li class="layui-this" id="layuiminiHomeTabId" lay-id=""></li>
                </ul>
                <div class="layui-tab-control">
                    <li class="layuimini-tab-roll-left layui-icon layui-icon-left"></li>
                    <li class="layuimini-tab-roll-right layui-icon layui-icon-right"></li>
                    <li class="layui-tab-tool layui-icon layui-icon-down">
                        <ul class="layui-nav close-box">
                            <li class="layui-nav-item">
                                <a href="javascript:;"><span class="layui-nav-more"></span></a>
                                <dl class="layui-nav-child">
                                    <dd><a href="javascript:;" layuimini-tab-close="current">关 闭 当 前</a></dd>
                                    <dd><a href="javascript:;" layuimini-tab-close="other">关 闭 其 他</a></dd>
                                    <dd><a href="javascript:;" layuimini-tab-close="all">关 闭 全 部</a></dd>
                                </dl>
                            </li>
                        </ul>
                    </li>
                </div>
                <div class="layui-tab-content">
                    <div id="layuiminiHomeTabIframe" class="layui-tab-item layui-show"></div>
                </div>
            </div>

        </div>
    </div>
    <script src="/static/lib/layui-v2.6.3/layui.js" charset="utf-8"></script>
    <script src="/static/js/lay-config.js?v=2.0.0" charset="utf-8"></script>
    <script>
        layui.use(['jquery', 'layer', 'miniAdmin', 'miniTongji'], function () {
            var $ = layui.jquery,
                layer = layui.layer,
                miniAdmin = layui.miniAdmin,
                miniTongji = layui.miniTongji;

                $.get('/api/admin/v1/menu',{}, function (res) {
                    if (res.code == 400) {
                        layer.msg(res.msg, { icon: 2 });
                        localStorage.removeItem('token');
                        window.location = "/admin/login/index";
                    } 
                })

            var options = {
                iniUrl: "<?php echo htmlentities(app('request')->domain()); ?>/api/admin/v1/menu", // 初始化接口
                clearUrl: "<?php echo htmlentities(app('request')->domain()); ?>/static/api/clear.json", // 缓存清理接口
                urlHashLocation: true, // 是否打开hash定位
                bgColorDefault: false, // 主题默认配置
                multiModule: false, // 是否开启多模块
                menuChildOpen: false, // 是否默认展开菜单
                loadingTime: 0, // 初始化加载时间
                pageAnim: true, // iframe窗口动画
                maxTabNum: 20, // 最大的tab打开数量
            };
            miniAdmin.render(options);

            // 百度统计代码，只统计指定域名
            miniTongji.render({
                specific: true,
                domains: [],
            });

            $('.login-out').on("click", function () {
                $.post('admin/login/login_out', {}, function (res) {
                    if (res == '1') {
                        layer.msg('退出登录成功', function () {
                            window.location = 'admin/login';
                        });
                    } else {
                        layer.alert('修改失败')
                    }
                })
            });
        })
    </script>
<script src="/static/js/setToken.js" charset="utf-8"></script>
</body>
</html>
