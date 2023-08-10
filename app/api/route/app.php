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
Route::get('v1/captcha/get-img', 'v1.captcha.ImgCode/getImg');                   //图片验证码 这个不是接口 是验证码图片

Route::get('v1/captcha/img', 'v1.captcha.ImgCode/sendImgCode')->validate([
    'type'     =>    'require'
]);
Route::post('v1/captcha/email', 'v1.captcha.EmailCode/sendEmailCode')->validate([
    'email'    =>    'require|email',
    'type'     =>    'require'
]);                                                                               //邮件验证码
Route::post('v1/captcha/mobile', 'v1.captcha.MobileCode/sendMobileCode')->validate([
    'mobile'   =>    'require|mobile',
    'type'     =>    'require'
]);                                                                               //手机验证码

/**
 * 公共接口 需要登录
 */
Route::group(function () {
    //文件上传
    Route::post('v1/upload/local', 'v1.upload.LocalUpload/upload')->validate([
        'path'    =>    'require'
    ]);                                                                          //上传到本地

})->middleware(\app\common\middleware\CheckAuth::class);


/**
 * 管理后台接口 不需要登录
 */
Route::post('admin/v1/login/using-password', 'admin.v1.Login/loginPassword')->validate([
    'username'    =>    'require',
    'password'    =>    'require',
    'code'        =>    'require',
    'uuid'        =>    'require'
]);
Route::post('admin/v1/login/using-email', 'admin.v1.Login/loginEmail')->validate([
    'email'    =>    'require',
    'code'     =>    'require',
]);
Route::post('admin/v1/login/using-mobile', 'admin.v1.Login/loginMobile')->validate([
    'mobile'    =>    'require',
    'code'      =>    'require',
]);

/**
 * 管理后台接口 需要登录
 */
Route::group(function () {
    //菜单栏
    Route::get('admin/v1/menu', 'admin.v1.Menu/menu');                         //管理后台菜单栏

    //系统设置
    Route::resource('admin/v1/email', 'admin.v1.config.Email')->only(['read', 'update']);                //邮件设置
    Route::resource('admin/v1/key', 'admin.v1.config.Key')->only(['read', 'update']);                    //密钥设置
    Route::resource('admin/v1/api', 'admin.v1.config.Api')->only(['read', 'update']);                    //接口设置
    Route::resource('admin/v1/base', 'admin.v1.config.Base')->only(['read', 'update']);                  //基本设置

    //用户中心
    Route::post('admin/v1/users', 'admin.v1.Users/save');                   //新增用户
    Route::get('admin/v1/users/:id', 'admin.v1.Users/read');                //查询指定用户
    Route::get('admin/v1/users', 'admin.v1.Users/index')->validate([
        'page'    =>    'require',
        'limit'   =>    'require',
    ]);                                                                     //查询全部用户
    Route::put('admin/v1/users/:id', 'admin.v1.Users/update');              //更新指定用户信息
    Route::delete('admin/v1/users/:id', 'admin.v1.Users/delete');           //删除指定用户

    //管理员信息
    Route::get('admin/v1/user', 'admin.v1.User/read');                //查询指定用户
    Route::put('admin/v1/user', 'admin.v1.User/update');              //更新指定用户信息

})->middleware(\app\common\middleware\CheckAuth::class);

/**
 *用户后台接口 需要登录
 */
Route::group(function(){
    Route::get('user/v1/menu', 'user.v1.Menu/menu');                           //用户后台菜单栏
})->middleware(\app\common\middleware\CheckAuth::class);