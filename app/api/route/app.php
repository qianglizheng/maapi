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
    'token' => 'require'
];
/**
 * 上传文件路由
 */
Route::post('v1/upload/:path', 'v1.Upload/upload');
/**
 * 公共验证码路由
 */
Route::get('v1/captcha/get_img', 'v1.captcha.ImgCode/getImg');                   //图片验证码
Route::get('v1/captcha/img', 'v1.captcha.ImgCode/sendImgCode');                  //图片验证码信息
Route::get('v1/captcha/email', 'v1.captcha.EmailCode/sendEmailCode');            //邮件验证码

/**
 * 管理后台路由
 */
Route::post('admin/v1/login', 'admin.v1.Login/login');          //管理员登录

/**
 * 路由分组 验证token
 */
Route::group(function () {
    //菜单栏
    Route::get('admin/v1/menu', 'admin.v1.Menu/menu');
    Route::get('user/v1/menu', 'user.v1.Menu/menu');
    //上传文件
    //管理后台
    Route::resource('admin/v1/email', 'admin.v1.config.Email');
    Route::resource('admin/v1/key', 'admin.v1.config.Key');
    Route::resource('admin/v1/api', 'admin.v1.config.Api');
    Route::resource('admin/v1/base', 'admin.v1.config.Base');
})->middleware(\app\common\middleware\CheckToken::class);
