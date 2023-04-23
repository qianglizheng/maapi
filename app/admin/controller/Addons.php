<?php

namespace app\admin\controller;

use think\facade\View;

class Addons
{
    public function users_groups()
    {
        return View::fetch('users_groups');
    }
    public function vip_groups()
    {
        return View::fetch('index2');
    }
}
