<?php

namespace app\common\controller;

use app\BaseController;
use think\Response;

class Common extends BaseController
{
    public function return_json($count, $data, $msg="数据请求成功", $code=200)
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
}
