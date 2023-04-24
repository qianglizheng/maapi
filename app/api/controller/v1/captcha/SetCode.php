<?php

namespace app\api\controller\v1\captcha;

use app\common\controller\Common;
use think\facade\Cache;

class SetCode extends Common
{
    /**
     * 用户标识
     */
    public $uuid;

    /**
     * 验证码
     */
    public $code;

    public function __construct()
    {
        $this->setUuid()->setCode($this->uuid);
    }

    /**
     * 设置用户标识
     */
    public function setUuid()
    {
        $this->uuid = time() . mt_rand(10000000, 999999999);
        return $this;
    }

    /**
     * 设置验证码 $key为缓存的键
     */
    public function setCode($key)
    {
        $code = substr(str_shuffle('123456789abcdefghijklmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ'), 0, 4);
        $this->code = $code;
        Cache::set($key, $code, 60);
    }
}
