<?php

namespace addons\admin_users_vip_groups\controller;

use app\admin\model\AdminUsersVipGroups as AdminVipGroupsModel;
use app\common\controller\AddonsAuth;

class AdminVipGroups extends AddonsAuth
{
    protected $middleware = app\common\middleware\CheckToken::class;
    public function index()
    {
        $res = (array) $this->CheckToken();
        foreach ($res as $key => $res) {
            if (is_array($res)) {
                foreach ($res as $key => $res) {
                    if ($res == 400) {
                        return $this->returnJson(0, [], 'token错误或者没有token', 400);
                    }
                }
            }
        }
        $data = AdminVipGroupsModel::select();
        $count = AdminVipGroupsModel::count('id');
        if ($data->isEmpty()) {
            return $this->returnJson($count, $data, '数据不存在');
        } else {
            return $this->returnJson($count, $data);
        }
    }
}
