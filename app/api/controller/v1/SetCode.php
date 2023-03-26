<?php

namespace app\api\controller\v1;

use app\common\controller\Common;
use think\facade\Cache;

class SetCode extends Common
{
    /**
     * 设置验证码 $key为缓存的键
     */
    public function setCode($key)
    {
        $code = substr(str_shuffle('123456789abcdefghijklmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ'), 0, 4);
        Cache::set($key, $code, 60);
        $this->code = $code;
    }
}
