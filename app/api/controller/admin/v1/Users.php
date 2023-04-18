<?php

declare(strict_types=1);

namespace app\api\controller\admin\v1;

use app\common\controller\Common;
use think\facade\Request;
use app\admin\model\AdminUsers as AdminUsersModel;
use app\admin\model\AdminUsersGroups as UserGroups;
use app\admin\model\AdminUsersVipGroups as VipGroups;

class Users extends Common
{
    public function __construct()
    {
        $this->model = new AdminUsersModel();
        $this->params = Request::param();
    }
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index($page, $limit)
    {
        //查询用户分组
        $user_group = UserGroups::field('name')->select();
        //查询 VIP 分组
        $vip_group = VipGroups::field('name')->select();

        //获取数据条数
        $count = $this->model->count('id');
        $data = $this->model->page($page, $limit)->order('id desc')->select();
        if ($data->isEmpty()) {
            return $this->returnJson($count, $data, '数据不存在');
        } else {
            return $this->returnJson($count, $data);
        }
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
        return 'read';
    }


    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
