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

$admin = [
    'page' => 'require|number',
    'limit' => 'require|number',
    'token' =>'require'
];
Route::get('v1/apps/index', 'admin.v1.apps/index')->validate($admin)->middleware(\app\common\middleware\CheckToken::class);
