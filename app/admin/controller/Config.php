<?php

namespace app\admin\controller;

use think\facade\View;

class Config
{
    /**
    * 基本设置
    */
    public function Base()
    {
        return View::fetch('Base');
    }

    /**
     * key设置
     */
    public function Key()
    {
        return View::fetch('Key');
    }

    /**
     * 邮箱设置
     */
    public function Email()
    {
        return View::fetch('Email');
    }

    /**
     * 接口设置
     */
    public function Api()
    {
        return View::fetch('Api');
    }

    /**
     * 插件 顶想云短信
     */
    public function addonsSmsTop()
    {
        return View::fetch('adminEmailConfig');
    }
}
