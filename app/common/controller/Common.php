<?php

namespace app\common\controller;

use app\BaseController;

class Common extends BaseController
{
    public function return_json($data)
    {
        return json([
            "code" => "",
            "msg" => "",
            "count" => "",
            "data" => $data
        ]);
    }
}
