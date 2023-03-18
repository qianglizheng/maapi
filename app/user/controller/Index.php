<?php

namespace app\user\controller;

use think\facade\View;
use app\common\model\Users;

class Index
{
    public function __construct()
    {
        $this->model = new Users();
    }

    public function index()
    {
        return View::fetch('index');
    }
}
