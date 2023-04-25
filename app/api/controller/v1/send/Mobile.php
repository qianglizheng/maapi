<?php

namespace app\api\controller\v1\send;

use app\api\controller\v1\captcha\SetCode;
use think\api\Client;
use addons\smsbao\controller\smsbao;

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
        $client = new Client("2455c797f4bb73f0d450c83505eb09bb");
        $result = $client->smsSend()
            ->withSignId('1265')
            ->withTemplateId('4')
            ->withPhone('18785674348')
            ->withParams('{"code": "7865"}')
            ->request();
        dump($result);
    }

    public function smsbao(){
        $smsbao = new smsbao();
        $smsbao->send();
    }
}
