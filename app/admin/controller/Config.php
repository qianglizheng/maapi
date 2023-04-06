<?php

namespace app\admin\controller;

use think\facade\View;

class Config
{
    /**
    * 基本设置
    */
    public function adminBaseConfig()
    {
        return View::fetch('adminKeyConfig');
    }

    /**
     * key设置
     */
    public function adminKeyConfig()
    {
        return View::fetch('adminKeyConfig');
    }

    /**
     * 邮箱设置
     */
    public function adminEmailConfig()
    {
        return View::fetch('adminEmailConfig');
    }

    /**
     * 接口设置
     */
    public function adminApiConfig()
    {
        return View::fetch('adminApiConfig');
    }

    /**
     * 插件 顶想云短信
     */
    public function addonsSmsTop()
    {
        return View::fetch('adminEmailConfig');
    }
}
