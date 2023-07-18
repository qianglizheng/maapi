<?php

namespace addons\admin_vip_groups\controller;

use app\admin\model\AdminUsersVipGroups as AdminVipGroupsModel;
use app\common\controller\AddonsAuth;

class AdminVipGroups extends AddonsAuth
{
    public function index()
    {
        $res = $this->addonsAuth();
        //如果$res是对象，说明没有token或者是错误，否则应该是返回一个数组
        if (is_object($res)) {
            return $this->returnJson(0, [], 'token错误或者没有token', 400);
        }
        $data = AdminVipGroupsModel::select();
        $count = count($data);
        if ($data->isEmpty()) {
            return $this->returnJson($count, $data, '数据不存在');
        } else {
            return $this->returnJson($count, $data);
        }
    }
}
