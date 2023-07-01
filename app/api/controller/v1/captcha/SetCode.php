<?php

namespace app\api\controller\v1\captcha;

use app\common\controller\Common;
use think\facade\Cache;

class SetCode extends Common
{
    /**
     * 用户标识
     */
    protected $uuid;

    /**
     * 验证码
     */
    protected $code;

    public function __construct($emailOrMobile=null)
    {
        //邮件验证码或者手机验证码设置key为邮箱或者手机号，否则是图片验证码设置key为随机生成的uuid
        if (!empty($emailOrMobile)) {
            $this->setUuid()->setCode($emailOrMobile, true);
        } else {
            $this->setUuid()->setCode($this->uuid);
        }
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
    public function setCode($key, $num=null)
    {
        if($num == true) {
            $code = mt_rand(100000, 999999);
        } else {
            $code = substr(str_shuffle('123456789abcdefghijklmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ'), 0, 4);
        }
        $this->code = $code;
        Cache::set($key, $code, 60);
    }
}
