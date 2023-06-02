<?php

namespace app\api\controller\v1\captcha;

use app\api\controller\v1\send\Mobile;
use think\facade\Request;

class MobileCode extends Mobile
{
    /**
     * 如果是发送验证码调用此方法设置验证码 键值分别是手机号和验证码
     */
    public function __construct()
    {
        $mobile = Request::post('mobile');
        $this->setMobileCode($mobile);
    }
    /**
     * 发送短信验证码
     */
    public function sendMobileCode($mobile)
    {
        return $this->sendMobile($mobile, $this->code);
    }
}
