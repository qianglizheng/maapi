<?php

namespace app\admin\controller;

use think\facade\View;

class Users
{
    public function index()
    {
        return View::fetch('index');
    }
    public function edit(){
        return View::fetch('edit');
    }
}
