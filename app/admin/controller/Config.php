<?php

namespace app\admin\controller;

use app\common\model\AdminKeyConfig;
use app\common\model\AdminEmailConfig;

use think\facade\View;

class Config
{
    /**
     * key设置
     */
    public function adminKeyConfig()
    {
        $data = AdminKeyConfig::find(1)->toArray();
        View::assign($data);
        return View::fetch('adminKeyConfig');
    }
    /**
     * 邮箱设置
     */
    public function adminEmailConfig()
    {
        $data = AdminEmailConfig::find(1)->toArray();
        View::assign($data);
        return View::fetch('adminEmailConfig');
    }
    /**
     * 接口设置
     */
    public function adminApiConfig()
    {
        $data = AdminEmailConfig::find(1)->toArray();
        View::assign($data);
        return View::fetch('adminApiConfig');
    }
    /**
     * 插件 顶想云短信
     */
    public function addonsSmsTop()
    {
        $data = AdminEmailConfig::find(1)->toArray();
        View::assign($data);
        return View::fetch('adminEmailConfig');
    }
}
