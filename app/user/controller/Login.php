<?php

namespace app\user\controller;

use think\facade\View;

class Login
{
    public function login()
    {
        return View::fetch('login');
    }
    public function reg()
    {
        return View::fetch('reg');
    }
}
