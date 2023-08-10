<?php

declare(strict_types=1);

namespace app\api\controller\admin\v1;

use app\common\controller\CheckSignTimes;
use think\facade\Request;
use app\admin\model\Admin as AdminModel;

class User extends CheckSignTimes
{
    public function __construct()
    {
        //检查是否需要验证签名和时间
        $this->checkSignTimes('admin');
        $this->model = new AdminModel();
        $this->params = Request::param();
    }

    /**
     * 显示指定的资源
     *
     */
    public function read()
    {
        $data = $this->model::find(1); //没有则返回null
        if ($data) {
            $data->password = null;
            return $this->returnJson(1, $data);
        }
        return $this->returnJson(0, [], '用户不存在', 400);
    }


    /**
     * 保存更新的资源
     *
     */
    public function update()
    {
        unset($this->params['id']);
        $res = $this->model::update($this->params, ['id' => 1]);
        if ($res) {
            return $this->returnJson(0, [], '用户信息更新成功');
        }
        return $this->returnJson(0, [], '用户信息更新失败', 400);
    }
}
