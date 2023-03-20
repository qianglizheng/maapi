<?php

namespace app\api\controller\admin\v1;

use app\common\controller\Common;
use app\common\controller\JwtAuth;
use think\facade\Request;
use app\common\model\ApiKey;
use app\common\model\Users;

class Login extends Common
{
    public function __construct()
    {
        $this->params = Request::post();
    }
    public function login()
    {
        $data = $this->params;
        $key = ApiKey::find(1)['user'];
        $res = Users::where('username', $data['username'])->findOrEmpty();
        if ($res->isEmpty()) {
            return $this->return_json(0, [], '账号或者密码错误', 400);
        } else {
            if ($res->password == $data['password']) {
                $jwt = JwtAuth::getInstance();
                $token = $jwt->setKey($key)->setId(5)->getToken();
                return $this->return_json(1, ['token' => $token], '登录成功', 200);
            } else {
                return $this->return_json(0, [], '账号或者密码错误', 400);
            }
        }
    }
    public function reg()
    {
        return '注册成功';
    }
}
