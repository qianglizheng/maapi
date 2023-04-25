<?php

namespace app\api\controller\v1\captcha;

use app\api\controller\v1\send\Mobile;
use think\facade\Request;

class MobileCode extends Mobile
{
    /**
     * 调用父类生成验证码并且存放在redis中，键为手机号 值为验证码
     */
    public function __construct()
    {
        $mobile = Request::post('mobile');
        parent::__construct($mobile);  
    }
    /**
     * 发送短信验证码
     */
    public function sendMobileCode($mobile)
    {
        return $this->sendMobile($mobile, $this->code);
    }
}
