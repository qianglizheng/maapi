<?php

namespace app\api\controller\v1\captcha;

use app\api\controller\v1\send\Email;

class EmailCode extends Email
{
    /**
     * 发送短信验证码
     */
    public function sendEmailCode($email)
    {
        parent::__construct($email); //调用父类生成验证码并且存放在redis中，键为邮箱 值为验证码
        return $this->sendEmail($email, $this->code);
    }
}
