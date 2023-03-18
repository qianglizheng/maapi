<?php

namespace app\admin\controller;

use think\facade\View;

class Pages
{
    public function app()
    {
        return View::fetch('app');
    }
    public function note()
    {
        return View::fetch('note');
    }
}
