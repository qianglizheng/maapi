<?php

namespace app\admin\controller;

use think\facade\View;

class Index
{
    public function index()
    {
        return View::fetch('index');
    }
    public function index2()
    {
        return View::fetch('index2');
    }
    public function read($id)
    {
        return 'a'.$id;
    }
}
