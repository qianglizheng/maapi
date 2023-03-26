<?php

namespace app\api\controller\user\v1;

use app\common\controller\JwtAuth;
use think\facade\Request;
use app\common\model\AdminKey;

class Login
{
    public function __construct()
    {
        $this->params = Request::post();
    }
    public function index()
    {
        $data = $this->params;
        $key = AdminKey::find(1)['user'];
        $jwt = JwtAuth::getInstance();
        $token = $jwt->setKey($key)->setId(5)->getToken();
        return $token;
    }
}
