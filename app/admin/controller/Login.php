<?php

namespace app\admin\controller;

use think\facade\View;

class Login
{
    public function index()
    {
        return View::fetch('index');
    }
}
