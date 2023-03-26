<?php

namespace app\api\controller\v1;

class EmailCode extends Email
{
    public function sendEmailCode()
    {
        $this->send();
    }
}
