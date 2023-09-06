<?php

declare(strict_types=1);

namespace app\api\controller\user\v1;

use app\common\controller\CheckSignTimes;
use think\facade\Request;
use app\user\model\UserUsers as UserUsersModel;

// use app\admin\model\AdminUsersGroups as UserGroups;
// use app\admin\model\AdminUsersVipGroups as VipGroups;

class Users extends CheckSignTimes
{
    public function __construct()
    {
        //检查是否需要验证签名和时间
        $this->checkSignTimes('admin');
        $this->model = new UserUsersModel();
        $this->params = Request::param();
        $this->uid = request()->data['id'];
        //根据用户的分组和VIP分组享受某些功能
        //查询用户分组
        //$user_group = UserGroups::field('name')->select();
        //查询 VIP 分组
        //$vip_group = VipGroups::field('name')->select();
    }
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $page = (int)$this->params['page'];
        $limit = (int)$this->params['limit'];
        //搜索 查询指定数据
        if (!empty($this->params['username'])) {
            $data = $this->model::where([
                'username' => $this->params['username'],
                'uid'      => $this->uid
            ])->findOrEmpty();

            if (!$data->isEmpty()) {
                $res[] = $data;
                return $this->returnJson(1, $res);
            }
        }
        //获取全部数据
        $data = $this->model::where('uid', $this->uid)->page($page, $limit)->order('id desc')->select();
        //获取数据条数
        $count = count($data);
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
        //判断用户名是否存在
        $res = $this->model::where([
            'username' => $this->params['username'],
            'uid'      => $this->uid,
            'app_id'   => $this->params['app_id']
        ])->find();

        if ($res) {
            return $this->returnJson(0, [], '用户名已存在', 400);
        }

        //添加用户
        $res = $this->model::create($this->params);
        if ($res) {
            return $this->returnJson(0, [], '添加用户成功');
        }
        return $this->returnJson(0, [], '添加用户失败', 400);
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        $data = $this->model::where('uid', $this->uid)->find($id); //没有则返回null
        if ($data) {
            return $this->returnJson(1, $data);
        }
        return $this->returnJson(0, [], '用户不存在', 400);
    }


    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update($id)
    {
        //这个判断是解决前端的问题
        if (empty($this->params['vip_end_time'])) {
            unset($this->params['vip_end_time']);
        }

        //检查
        // if (isset($this->params['username'])) {
        //     $res = $this->model::where('username', $this->params['username'])->where('id', '<>', $id)->findOrEmpty();
        //     if (!$res->isEmpty()) {
        //         return $this->returnJson(0, [], '用户名已存在', 400);
        //     }
        // }
        if (isset($this->params['mobile'])) {
            $res = $this->model::where('mobile', $this->params['mobile'])->where('id', '<>', $id)->findOrEmpty();
            if (!$res->isEmpty()) {
                return $this->returnJson(0, [], '手机已存在', 400);
            }
        }
        if (isset($this->params['email'])) {
            $res = $this->model::where('email', $this->params['email'])->where('id', '<>', $id)->findOrEmpty();
            if (!$res->isEmpty()) {
                return $this->returnJson(0, [], '邮箱已存在', 400);
            }
        }

        unset($this->params['id']);
        unset($this->params['username']);

        //create_time 和update_time 会自动设置为当前时间
        $res = $this->model::update($this->params, ['id' => $id]);
        if ($res) {
            return $this->returnJson(0, [], '用户信息更新成功');
        }
        return $this->returnJson(0, [], '用户信息更新失败', 400);
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        $res = $this->model::destroy($id);
        if ($res) {
            return $this->returnJson(0, [], '用户删除成功');
        }
        return $this->returnJson(0, [], '用户删除失败', 400);
    }
}
