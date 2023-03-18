<?php

namespace app\api\controller\admin;

class userApi
{
    public function index()
    {
        $data = [
            "homeInfo" => [
                "title" => "首页", "href" => ""
            ],
            "logoInfo" => [
                "title" => "小码API",
                "image" => "../static/images/logo.png",
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
                    "href" => "pages/app",
                    "target" => "_self"
                ],
            ]
        ];

        return json($data);
    }
}
