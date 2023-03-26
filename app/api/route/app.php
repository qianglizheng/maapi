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
 * 公共图片验证码路由
 */
Route::get('v1/get_img', 'v1.Captcha/getimg');
Route::get('v1/code_msg', 'v1.Captcha/codeMsg');

/**
 * 后台菜单栏路由
 */
Route::get('admin/menu', 'admin.menu/index');//管理后台
Route::get('user/menu', 'user.menu/index');//用户后台

/**
 * 管理后台路由
 */
Route::post('admin/v1/login', 'admin.v1.Login/login');//管理员登录
Route::post('admin/v1/reg', 'admin.v1.Login/reg');//管理员注册

/**
 * 后台资源路由->验证token
 * 方法路由->验证参数
 */
Route::resource('admin/v1/apps', 'admin.v1.Apps')->validate($index)->middleware(\app\common\middleware\CheckToken::class);
Route::resource('user/v1/apps', 'user.v1.Apps')->validate($index)->middleware(\app\common\middleware\CheckToken::class);
