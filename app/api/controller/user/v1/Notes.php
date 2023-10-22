<?php

declare(strict_types=1);

namespace app\api\controller\user\v1;

use app\common\controller\CheckSignTimes;
use think\facade\Request;
use app\user\model\UserNotes as Model;

class Notes extends CheckSignTimes
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
        $res = $this->model::create($this->params);
        if ($res) {
            return $this->returnJson(0, [], '添加成功');
        }
        return $this->returnJson(0, [], '添加失败', 400);
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        $data = $this->model::where([
            'uid' => $this->uid,
            'id'  => $id
            ])->find(); //没有则返回null
        if ($data) {
            return $this->returnJson(1, $data);
        }
        return $this->returnJson(0, [], '数据不存在', 400);
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
        unset($this->params['id']); //不允许修改更新ID
        //执行更新
        $res = $this->model::where([
            'uid' => $this->uid,
            'id'  => $id
        ])->update($this->params);
        if ($res) {
            return $this->returnJson(0, [], '更新成功');
        }
        return $this->returnJson(0, [], '更新失败', 400);
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
            "uid" => $this->uid,
            'id'  => $id
        ])->delete();
        if ($res) {
            return $this->returnJson(0, [], '删除成功');
        }
        return $this->returnJson(0, [], '删除失败', 400);
    }
}
