<?php

namespace app\api\controller\v1;

use think\facade\Request;

class EmailCode extends Email
{
    public function sendEmailCode()
    {
        return $this->send(Request::get('email'));
    }
}
