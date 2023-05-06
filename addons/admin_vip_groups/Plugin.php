<?php
namespace addons\admin_vip_groups;

use think\Addons;
use think\facade\Db;
/**
 * 管理后台用户分组
 * @author byron sampson
 */
class Plugin extends Addons	
{
    /**
     * 插件的基础信息
     */
    public $info = [
        'name' => 'admin_vip_groups',	                      // 插件标识
        'title' => '管理后台用户VIP分组',	          // 插件名称
        'description' => '管理后台用户VIP分组',	  // 插件简介
        'status' => 1,	                         // 状态
        'author' => '创梦流浪人',
        'version' => '1.0.0'
    ];

    /**
     * 插件安装方法
     * @return bool
     */
    public function install()
    {
        Db::name('system_menu')->insert([
            "pid" => 3,
            "title" => "顶想云",
            "href" => "admin/config/smstop",
            "target" => "_self"
        ]);
    }

    /**
     * 插件卸载方法
     * @return bool
     */
    public function uninstall()
    {
        return true;
    }

    /**
     * 实现的testhook钩子方法
     * @return mixed
     */
    public function smstophook($param)
    {
		// 调用钩子时候的参数信息
        echo $this->install();
        print_r($param);
		// 当前插件的配置信息，配置信息存在当前目录的config.php文件中，见下方
        print_r($this->getConfig());
		// 可以返回模板，模板文件默认读取的为插件目录中的文件。模板名不能为空！
        // return $this->fetch('info');
    }

}