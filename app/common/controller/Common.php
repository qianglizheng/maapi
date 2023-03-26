<?php

namespace app\common\controller;

use app\BaseController;
use app\common\model\apiKey;
use app\common\controller\jwtAuth;
use think\Response;

class Common extends BaseController
{
    /**
     * 接口返回数据方法
     */
    public function return_json($count = 0, $data = [], $msg = "数据请求成功", $code = 200)
    {
        $result = [
            //状态码
            "code" => $code,
            //消息
            "msg" => $msg,
            //数据条数
            "count" => $count,
            //数据
            "data" => $data
        ];
        return Response::create($result, 'json');
    }
    /**
     * 网站验证登录信息->检查token
     */
    public function check_token($type, $token)
    {
        $key = apiKey::find(1)[$type];
        $jwt = jwtAuth::getInstance();
        $jwt->setKey($key)->decode($token);
    }
}
