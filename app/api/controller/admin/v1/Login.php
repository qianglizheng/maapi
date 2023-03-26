<?php

namespace app\api\controller\admin\v1;

use app\common\controller\Common;
use app\common\controller\JwtAuth;
use think\facade\Request;
use app\common\model\ApiKey;
use app\common\model\Users;
use think\facade\Cache;

class Login extends Common
{
    public function __construct()
    {
        $this->params = Request::post();
    }
    public function login()
    {
        $data = $this->params;
        if (strtolower(Cache::get($data['uid'])) != strtolower($data['captcha'])) {
            //删除验证码
            Cache::delete($data['uid']);
            return $this->return_json(0, [], '验证码错误', 400);
        } else {
            Cache::delete($data['uid']);
        }
        //获取管理后台下发token的key
        $key = ApiKey::find(1)['admin'];
        //查询用户是否存在
        $res = Users::where('username', $data['username'])->findOrEmpty();
        if ($res->isEmpty()) {
            //账号不存在
            return $this->return_json(0, [], '账号或者密码错误', 400);
        } else {
            if ($res->password == $data['password']) {
                //登录成功根据管理后台key下发token
                $jwt = JwtAuth::getInstance();
                $token = $jwt->setKey($key)->setId(5)->getToken();
                return $this->return_json(1, ['token' => $token], '登录成功', 200);
            } else {
                //密码错误
                return $this->return_json(0, [], '账号或者密码错误', 400);
            }
        }
    }
    public function reg()
    {
        return '注册成功';
    }
}
