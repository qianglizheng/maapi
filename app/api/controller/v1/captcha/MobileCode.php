<?php

namespace app\api\controller\v1\captcha;

use app\api\controller\v1\send\Mobile;

class MobileCode extends Mobile
{
    /**
     * 调用父类生成验证码并且存放在redis中
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 发送短信验证码
     */
    public function sendMobileCode($email)
    {
        return $this->sendMobile($email, $this->code);
    }
}
