<?php

namespace app\api\controller\user;

use think\facade\Request;

class Menu
{
    public function index()
    {
        $domain = Request::domain();
        $data = [
            "homeInfo" => [
                "title" => "首页", "href" => ""
            ],
            "logoInfo" => [
                "title" => "小码API",
                "image" => "$domain./static/images/logo.png",
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
                    "title" => "应用管理",
                    "icon" => "fa fa-address-book",
                    "href" => $domain."/user/pages/apps",
                    "target" => "_self"
                ],
            ]
        ];

        return json($data);
    }
}
