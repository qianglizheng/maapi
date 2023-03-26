<?php

namespace app\admin\controller;

use think\facade\View;

class Login
{
    public function login()
    {
        return View::fetch('login');
    }
    public function captcha()
    {
        return View::fetch('captcha');
    }
}
