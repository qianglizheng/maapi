<?php

namespace app\common\controller;

use app\BaseController;
use think\facade\Request;

class CheckParam extends BaseController
{
    /**
     * 验证规则 控制器->方法->验证规则
     */
    protected $rule =   [
        //后台API
        //应用验证规则
        'admin.v1.Apps' => [
            'index' => [
                'page' => 'require|number',
                'limit' => 'require|number',
            ]
        ]
    ];
    public function __construct()
    {
        // $validate = \think\facade\Validate::rule($this->rule[Request::controller()][Request::action()]);
        // if (!$validate->check(Request::param())) {
        //     echo json_encode(['code' => 400, 'msg' => $validate->getError()]);
        //     die;
        // }
    }
}
