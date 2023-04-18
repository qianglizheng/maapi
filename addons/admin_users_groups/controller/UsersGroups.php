<?php

namespace addons\admin_users_groups\controller;

use app\admin\model\AdminUsersGroups as UserGroupsModel;
use app\common\controller\Common;
use app\common\controller\jwtAuth;
// namespace app\common\middleware;

class UsersGroups extends Common
{
    // protected $middleware = ['check'];
    public function index()
    {
        $data = UserGroupsModel::select();
        $count = UserGroupsModel::count('id');
        if($data->isEmpty()){
            return $this->returnJson($count, $data, '数据不存在');
        }else{
            return $this->returnJson($count,$data);
        }
    }
}
