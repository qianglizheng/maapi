<?php

namespace app\api\controller\v1\captcha;

use app\api\controller\v1\send\Email;
use think\facade\Request;

class EmailCode extends Email
{
    /**
     * 调用父类生成验证码并且存放在redis中，键为邮箱 值为验证码
     */
    public function __construct()
    {
        $email = Request::post('email');
        $this->setEmailCode($email);
    }
    /**
     * 发送短信验证码
     */
    public function sendEmailCode($email)
    {
        return $this->sendEmail($email, $this->code);
    }
}
