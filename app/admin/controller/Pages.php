<?php

namespace app\admin\controller;

use think\facade\View;

class Pages
{
    public function apps()
    {
        return View::fetch('apps');
    }
    public function notes()
    {
        return View::fetch('notes');
    }
    public function keyConfig()
    {
        return View::fetch('keyConfig');
    }
}
