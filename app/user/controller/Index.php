<?php

namespace app\admin\controller;

use think\facade\View;
use app\common\model\Users;

class Index
{
    // protected $middleware = [\app\middleware\CheckParam::class];
    public function __construct()
    {
        $this->model = new Users();
    }

    public function index()
    {
        return View::fetch('index');
    }
}
