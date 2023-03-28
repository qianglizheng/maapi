<?php

namespace app\api\controller\admin;

use think\facade\Request;

class Menu
{
    public function menu()
    {
        $domain = Request::domain();
        $data = [
            "homeInfo" => [
                "title" => "首页", "href" => ""
            ],
            "logoInfo" => [
                "title" => "小码API",
                "image" => "/static/images/logo.png",
                "href" => ""
            ],
            "menuInfo" => [
                [
                    "title" => "基础功能",
                    "icon" => "fa fa-address-book",
                    "href" => "",
                    "target" => "_self",
                    "child" => [
                        [
                            "title" => "笔记管理",
                            "icon" => "fa fa-address-book",
                            "href" => "",
                            "target" => "_self"
                        ],
                        [
                            "title" => "更新管理",
                            "icon" => "fa fa-address-book",
                            "href" => "",
                            "target" => "_self"
                        ],
                        [
                            "title" => "公告管理",
                            "icon" => "fa fa-address-book",
                            "href" => "",
                            "target" => "_self"
                        ]
                    ]
                ],
                [
                    "title" => "系统管理",
                    "icon" => "fa fa-address-book",
                    "href" => "",
                    "target" => "_self",
                    "child" => [
                        [
                            "title" => "邮件配置",
                            "icon" => "fa fa-address-book",
                            "href" => $domain."/admin/config/adminEmailConfig",
                            "target" => "_self"
                        ],
                        [
                            "title" => "密钥配置",
                            "icon" => "fa fa-address-book",
                            "href" => $domain."/admin/config/adminKeyConfig",
                            "target" => "_self"
                        ],
                    ]
                ],
            ]
        ];
        return json($data);
    }
}
