<?php

namespace app\user\controller;

use think\facade\View;

class Config
{
    public function email()
    {
        return View::fetch('email');
    }
}
