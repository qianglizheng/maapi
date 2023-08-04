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
        $type = Request::param('type');
        $this->checkSignTimes($type);//检查有没有开启参数加密和超时验证
        $mobile = Request::post('mobile');
        $this->setMobileCode($mobile); //调用父类方法设置键值
    }
    /**
     * 发送短信验证码
     */
    public function sendMobileCode($mobile)
    {
        return $this->sendMobile($mobile, $this->code);
    }
}
