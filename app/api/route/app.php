<?php

// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\facade\Route;

$index = [
    'page' => 'require|number',
    'limit' => 'require|number',
    'token' =>'require'
];
/**
 * 管理后台路由
 */
Route::get('admin/menu', 'admin.menu/index');//菜单
Route::post('admin/v1/login', 'admin.v1.Login/login');//登录
Route::post('admin/v1/reg', 'admin.v1.Login/reg');//注册

/**
 * 后台资源路由->验证token
 * 方法路由->验证参数
 */
Route::get('user/menu', 'user.menu/index');
Route::resource('admin/v1/apps', 'admin.v1.Apps')->validate($index)->middleware(\app\common\middleware\CheckToken::class);
Route::resource('user/v1/apps', 'user.v1.Apps')->validate($index)->middleware(\app\common\middleware\CheckToken::class);

