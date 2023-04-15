<?php

namespace app\admin\controller;

use think\facade\View;

class Users
{
    public function index()
    {
        return View::fetch('index');
    }
}
