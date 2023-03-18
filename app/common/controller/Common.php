<?php

namespace app\common\controller;

use app\BaseController;

class Common extends BaseController
{
    public function return_json($count, $data, $code=200, $msg="请求成功")
    {
        return json([
            "code" => $code,
            "msg" => $msg,
            "count" => $count,
            "data" => $data
        ]);
    }
}
