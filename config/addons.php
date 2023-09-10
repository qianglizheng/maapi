<?php

// +----------------------------------------------------------------------
// | thinkphp5 Addons [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016 http://www.zzstudio.net All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: Byron Sampson <xiaobo.sun@qq.com>
// +----------------------------------------------------------------------

return [
    // 是否自动读取取插件钩子配置信息（默认是开启）
    'autoload' => true,
    // 当关闭自动获取配置时需要手动配置hooks信息
    'hooks' => [
        // 可以定义多个钩子
        'smstop_hook' => 'smstop' // 键为钩子名称，用于在业务中自定义钩子处理，值为实现该钩子的插件，
        // 多个插件可以用数组也可以用逗号分割
        ,
        'admin_users_groups_hook' => 'admin_users_groups'
    ],
    'route' => [
         '/addons/admin/users-groups' => 'admin_users_groups/AdminUsersGroups/index',       //获取后台用户分组列表
         '/addons/admin/vip-groups' => 'admin_vip_groups/AdminVipGroups/index',             //获取后台用户VIP列表

         '/addons/user/users-groups' => 'user_users_groups/UserUsersGroups/index',       //获取后台用户分组列表
         '/addons/user/vip-groups' => 'user_vip_groups/UserVipGroups/index',             //获取后台用户VIP列表

        "/smstop" => "smstop/Index/index",
        "/demo" => "demo/test/demo",
        "/test" => "test/index/link"
    ],
    'service' => [],
];
