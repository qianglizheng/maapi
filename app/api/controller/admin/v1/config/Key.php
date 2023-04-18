<?php

declare(strict_types=1);

namespace app\api\controller\admin\v1\config;

use app\common\controller\Common;
use think\Request;
use app\admin\model\AdminKeyConfig as AdminKeyConfigModel;

class Key extends Common
{
    public function __construct()
    {
        $this->model = new AdminKeyConfigModel();
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
        $request = $request->only(['user','admin']);
        $res = $this->model::where('id', $id)->save($request);
        if ($res) {
            return $this->returnJson(1, $res, '数据修改成功');
        } else {
            return $this->returnJson(0, $res, '没有修改任何配置或者修改失败', 400);
        }
    }
}
