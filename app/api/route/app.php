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
 * 后台资源路由->验证token
 * 方法路由->验证参数
 */
Route::resource('admin/v1/apps', 'admin.v1.Apps')->middleware(\app\common\middleware\CheckToken::class);
Route::get('v1/apps/index', 'admin.v1.apps/index')->validate($index);
Route::resource('user/v1/apps', 'user.v1.Apps');
