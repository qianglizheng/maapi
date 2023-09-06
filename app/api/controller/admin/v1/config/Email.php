<?php

declare(strict_types=1);

namespace app\api\controller\admin\v1\config;

use app\common\controller\CheckSignTimes;
use think\facade\Request;
use app\admin\model\AdminEmailConfig as AdminEmailConfigModel;

class Email extends CheckSignTimes
{
    public function __construct()
    {
        //检查是否需要验证签名和时间
        $this->checkSignTimes('admin');

        $this->model = new AdminEmailConfigModel();
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
        if ($data->isEmpty()) {
            return $this->returnJson(0, $data, '数据不存在');
        } else {
            return $this->returnJson(1, $data);
        }
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
        unset($this->params['id']);
        $res = $this->model::update($this->params, ['id' => $id]);
        if ($res) {
            return $this->returnJson(0, $res, '数据修改成功',204);
        }
        return $this->returnJson(0, $res, '没有修改任何配置或者修改失败', 400);
    }
}
