<?php

namespace app\api\controller\admin\v1\user;

use app\common\controller\Common;
use app\common\controller\JwtAuth;
use think\facade\Request;
use app\common\model\AdminKeyConfig;
use app\admin\model\Admin;
use think\facade\Cache;

class Login extends Common
{
    public function __construct()
    {
        $this->params = Request::post();
    }
    /**
     * 用户登录
     */
    public function login()
    {
        $data = $this->params;                                                //获取参数
        $key = AdminKeyConfig::find(1)['admin'];                              //获取管理员后台key
        $res = Admin::where('username', $data['username'])->findOrEmpty();    //查询用户信息
        if ($res->isEmpty()) {
            return $this->return_json(0, [], '账号或者密码错误', 400);          //账号不存在
        } else {
            if ($res->password == $data['password']) {
                //登录成功根据管理后台key下发token
                $jwt = JwtAuth::getInstance();
                $token = $jwt->setKey($key)->setId(5)->getToken();
                return $this->return_json(1, ['token' => $token], '登录成功', 200);
            } else {
                return $this->return_json(0, [], '账号或者密码错误', 400);
            }
        }
    }
    /**
     * 用户注册
     */
    public function reg()
    {
        return '注册成功';
    }
    /**
     * 判断图片验证码
     */
    public function checkImgCode($data)
    {
        if (strtolower(Cache::get($data['uid'])) != strtolower($data['captcha'])) {
            Cache::delete($data['uid']);//验证码验证失败删除验证码
            return $this->return_json(0, [], '验证码错误', 400);
        } else {
            Cache::delete($data['uid']);//验证码验证成功删除验证码
        }
    }
}
