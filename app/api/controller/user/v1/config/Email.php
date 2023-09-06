<?php

declare(strict_types=1);

namespace app\api\controller\user\v1\config;

use app\common\controller\CheckSignTimes;
use think\facade\Request;
use app\user\model\UserEmailConfig as UserEmailConfigModel;

class Email extends CheckSignTimes
{
    public function __construct()
    {
        //检查是否需要验证签名和时间 user是用来获取签名的
        $this->checkSignTimes('user');
        $this->model = new UserEmailConfigModel();
        $this->params = Request::param();
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        $data = $this->model::findOrEmpty($id);
        unset($data['user_id']);
        if ($data->isEmpty()) {
            return $this->returnJson(0, $data, '数据不存在',204);
        } else {
            return $this->returnJson(1, $data, 200);
        }
    }


    /**
     * 保存更新的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function update($id)
    {
        //判断要修改的id和用户的id是否一致
        if (request()->data['id'] != $id) {
            return $this->returnJson(0, 0, '你没有修改权限！', 400);
        }

        unset($this->params['id']);
        $res = $this->model::update($this->params, ['id' => $id]);
        if ($res) {
            return $this->returnJson(0, $res, '数据修改成功', 204);
        }
        return $this->returnJson(0, $res, '没有修改任何配置或者修改失败', 400);
    }
}
