<?php

namespace app\api\controller\v1\captcha;

use app\api\controller\v1\send\Mobile;

class MobileCode extends Mobile
{

    /**
     * 发送短信验证码
     */
    public function sendMobileCode($mobile)
    { 
        parent::__construct($mobile);  //调用父类生成验证码并且存放在redis中，键为邮箱 值为验证码
        return $this->sendMobile($mobile, $this->code);
    }
}
