<?php

namespace app\api\controller\v1\send;

use app\api\controller\v1\captcha\SetCode;
use addons\smsbao\controller\Smsbao;
use addons\smstop\controller\Smstop;

class Mobile extends SetCode
{
    /**
     * 调用SetCode类的构造方法生成验证码并且存放在redis中 键为手机号 值为邮箱
     */
    public function __construct($mo)
    {
        parent::__construct($mo);
    }

    public function sendMobile($receiver = '', $content = '')
    {
        $this->smsbao();
        return 1;
    }

    public function smsbao()
    {
        $smsbao = new Smsbao();
        $smsbao->send();
    }

    public function smstop()
    {
        $smsbao = new Smstop();
        $smsbao->send();
    }
}
