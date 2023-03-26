<?php

namespace app\api\controller\v1;

use app\common\controller\Common;
use think\facade\Cache;

class SetCode extends Common
{
    public function setCode($name)
    {
        $code = substr(str_shuffle('123456789abcdefghijklmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ'), 0, 4);
        Cache::set($name, $code, 60);
        $this->code = $code;
    }
}
