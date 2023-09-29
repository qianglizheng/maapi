<?php

namespace app\user\controller;

use think\facade\View;

class Apps
{
    public function index()
    {
        return View::fetch('index');
    }
    public function add()
    {
        return View::fetch('add');
    }
    public function edit()
    {
        return View::fetch('edit');
    }
}
