<?php

declare(strict_types=1);

namespace app\api\controller\user\v1;

use app\common\controller\CheckSignTimes;
use think\facade\Request;
use app\user\model\UserNotices as Model;

class Notices extends CheckSignTimes
{
    public function __construct()
    {
        //检查是否需要验证签名和时间
        $this->checkSignTimes('admin');
        $this->model = new Model();
        $this->params = Request::param();
        $this->uid = request()->data['id'];
        $this->params['uid'] = $this->uid;
    }
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index($page, $limit)
    {
        $page = (int)$this->params['page'];
        $limit = (int)$this->params['limit'];
        //获取全部数据
        $data = $this->model::page($page, $limit)->order('id desc')->select();
        //获取数据条数
        $count = count($data);
        if ($data->isEmpty()) {
            return $this->returnJson(1, $data, '数据不存在', 400);
        } else {
            return $this->returnJson($count, $data);
        }
    }

    /**
     * 保存新建的资源
     *
     * @return \think\Response
     */
    public function save()
    {

        //检查
        $res = $this->model::where([
            'name' => $this->params['name'],
            'uid'      => $this->uid,
        ])->find();
        if ($res) {
            return $this->returnJson(0, [], '应用名已存在', 400);
        }

        //添加应用
        $res = $this->model::create($this->params);
        if ($res) {
            return $this->returnJson(0, [], '添加应用成功');
        }
        return $this->returnJson(0, [], '添加应用失败', 400);
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
        return $this->returnJson(0, [], '应用不存在', 400);
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
        //检查
        if (!empty($this->params['name'])) {
            $res = $this->model::where('name', $this->params['name'])->where([
                ["uid", '=', $this->uid],
                ['id', '<>', $id]
            ])->findOrEmpty();
            if (!$res->isEmpty()) {
                return $this->returnJson(0, [], '应用名已存在', 400);
            }
        }

        unset($this->params['id']); //不允许修改应用ID

        //执行更新
        $res = $this->model::update($this->params, ['id' => $id]);
        if ($res) {
            return $this->returnJson(0, [], '应用信息更新成功');
        }
        return $this->returnJson(0, [], '应用信息更新失败', 400);
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        $res = $this->model::where([
            "uid" => $this->uid
        ])->delete($id);
        if ($res) {
            return $this->returnJson(0, [], '应用删除成功');
        }
        return $this->returnJson(0, [], '应用删除失败', 400);
    }
}
