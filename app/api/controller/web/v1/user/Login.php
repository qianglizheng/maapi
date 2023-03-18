<?php

namespace app\api\controller\v1\user;

use app\common\controller\jwtAuth;
use think\facade\Request;

class Login extends jwtAuth
{
    /**
     * 接收用户ID
     */
    private $id;

    /**
     * 构造函数
     */
    public function __construct()
    {
        $this->id = Request::param('id');
    }

    /**
     * 用户登录接口
     */
    public function login()
    {
        $jwtAuth = jwtAuth::getInstance();
        $token = $jwtAuth->setUid($this->id)->getToken();
        $uid = $jwtAuth->decode($token)->getUid();
        if (is_null($uid)) {
            $errorInfo = $jwtAuth->decode($token)->getError();
            return $errorInfo;
        }
        return $uid;
    }
}
