<?php

namespace app\common\controller;

use app\BaseController;
use think\Response;
use think\facade\Cache;

class Common extends BaseController
{
    /**
     * 接口返回数据方法
     */
    public function returnJson($count = 0, $data = [], $msg = "数据请求成功", $code = 200)
    {
        if (empty($data) && $code == 200) {
            $code = 204;
            if($msg == "数据请求成功"){
                $msg == "数据为空";
            }
        }
        if ($count == 0) {
            $result = [
                //状态码
                "code" => $code,
                //消息
                "msg" => $msg,
            ];
        } else {
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
        }

        return Response::create($result, 'json');
    }
}
