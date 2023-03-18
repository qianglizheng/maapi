<?php

namespace app\common\controller;

class Common extends CheckParam
{
    public function return_json($count, $data)
    {
        return json([
            "code" => "",
            "msg" => "",
            "count" => $count,
            "data" => $data
        ]);
    }
}
