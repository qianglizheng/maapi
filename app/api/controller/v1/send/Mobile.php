<?php

namespace app\api\controller\v1\send;

use app\api\controller\v1\captcha\SetCode;
use addons\smsbao\controller\Smsbao;
use addons\smstop\controller\Smstop;
use addons\Smsali\controller\Smsali;

class Mobile extends SetCode
{
    /**
     * 如果是发送验证码调用此方法设置验证码 键值分别是邮箱和验证码
     */
    public function setMobileCode($mobile)
    {
        parent::__construct($mobile);
    }

    public function sendMobile($mobile = null, $content = null)
    {
        //阿里云
        Smsali::send($mobile, $content);
    }
}
