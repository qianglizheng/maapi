<?php

namespace app\admin\controller;

use app\common\model\AdminKeyConfig;
use app\common\model\AdminEmailConfig;

use think\facade\View;

class Config
{
    public function adminKeyConfig()
    {
        $data = AdminKeyConfig::find(1)->toArray();
        View::assign($data);
        return View::fetch('adminKeyConfig');
    }
    public function adminEmailConfig()
    {
        $data = AdminEmailConfig::find(1)->toArray();
        View::assign($data);
        return View::fetch('adminEmailConfig');
    }
    public function smstop()
    {
        $data = AdminEmailConfig::find(1)->toArray();
        View::assign($data);
        return View::fetch('adminEmailConfig');
    }
}
