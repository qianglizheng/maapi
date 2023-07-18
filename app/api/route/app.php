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

//检查token中间件会检查token是否存在，所以不需要验证器再判断一遍

/**
 * 公共接口 不需要登录
 */
Route::get('v1/captcha/get-img', 'v1.captcha.ImgCode/getImg');                   //图片验证码
Route::get('v1/captcha/img', 'v1.captcha.ImgCode/sendImgCode');                  //图片验证码信息
Route::post('v1/captcha/email', 'v1.captcha.EmailCode/sendEmailCode')->validate([
    'email'    =>    'require|email'
]);                                                                               //邮件验证码
Route::post('v1/captcha/mobile', 'v1.captcha.MobileCode/sendMobileCode')->validate([
    'mobile'    =>    'require|mobile'
]);                                                                               //手机验证码

/**
 * 公共接口 需要登录
 */
Route::group(function () {
    //文件上传
    Route::post('v1/upload/local', 'v1.upload.LocalUpload/upload')->validate([
        'path'    =>    'require'
    ]);                                                                          //上传到本地

})->middleware(\app\common\middleware\CheckToken::class)->middleware(\app\common\middleware\CheckAuth::class);


/**
 * 管理后台接口 不需要登录
 */
Route::post('admin/v1/login', 'admin.v1.Login/login')->validate([
    'username'    =>    'require',
    'password'    =>    'require',
]);                                                                            //管理员登录

/**
 * 管理后台接口 需要登录
 */
Route::group(function () {
    //菜单栏
    Route::get('admin/v1/menu', 'admin.v1.Menu/menu');                         //管理后台菜单栏
    Route::get('user/v1/menu', 'user.v1.Menu/menu');                           //用户后台菜单栏

    //系统设置
    Route::resource('admin/v1/email', 'admin.v1.config.Email')->only(['read', 'update']);                //邮件设置
    Route::resource('admin/v1/key', 'admin.v1.config.Key')->only(['read', 'update']);                    //密钥设置
    Route::resource('admin/v1/api', 'admin.v1.config.Api')->only(['read', 'update']);                    //接口设置
    Route::resource('admin/v1/base', 'admin.v1.config.Base')->only(['read', 'update']);                  //基本设置

    Route::group(function () {
        //用户中心
        Route::get('admin/v1/users', 'admin.v1.Users/index')->validate([
            'page'    =>    'require',
            'limit'   =>    'require',
        ]);
        Route::post('admin/v1/users', 'admin.v1.Users/save');
        Route::get('admin/v1/users/:id', 'admin.v1.Users/read');
        Route::put('admin/v1/users/:id', 'admin.v1.Users/update');
        Route::delete('admin/v1/users/:id', 'admin.v1.Users/delete');


        // Route::resource('admin/v1/users', 'admin.v1.Users');
        // Route::rest('index', ['GET', '/users', 'users']);
        
        //用户列表
    })->only(['index', 'save', 'delete', 'read', 'update']);//限定执行的方法 增删查改

})->middleware(\app\common\middleware\CheckToken::class)->middleware(\app\common\middleware\CheckAuth::class);
