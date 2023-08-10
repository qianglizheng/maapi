<?php

namespace app\user\controller;

use think\facade\View;
use app\user\model\UserUsers as UserUsersModel;

class Index
{
    public function __construct()
    {
        $this->model = new UserUsersModel();
    }

    public function index()
    {
        return View::fetch('index');
    }
}
