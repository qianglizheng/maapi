<?php

namespace app\admin\controller;

use think\facade\View;

class Market
{
    public function admin()
    {
        return View::fetch('admin');
    }
    public function users()
    {
        return View::fetch('users');
    }
    public function install()
    {
        return View::fetch('install');
    }

}
