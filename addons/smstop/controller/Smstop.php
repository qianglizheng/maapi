<?php

namespace addons\smstop\controller;

use think\facade\Config;

class Smstop
{
    public function send()
    {
        $client = new Client("2455c797f4bb73f0d450c83505eb09bb");
        $result = $client->smsSend()
            ->withSignId('1265')
            ->withTemplateId('4')
            ->withPhone('18785674348')
            ->withParams('{"code": "7865"}')
            ->request();
    }
}
