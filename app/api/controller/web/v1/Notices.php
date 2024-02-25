<?php

declare(strict_types=1);

namespace app\api\controller\web\v1;

use app\common\controller\CheckSignTimes;
use think\facade\Request;
use app\user\model\UserNotices as Model;

class Notices extends CheckSignTimes
{
    public function __construct()
    {
        //检查是否需要验证签名和时间
        $this->checkSignTimes('web');
        $this->model = new Model();
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
        $data = $this->model::where([
            'uid' => $this->params['uid'],
            'id'  => $id,
            ])->find(); //没有则返回null
        if ($data) {
            return $this->returnJson(1, $data);
        }
        return $this->returnJson(0, [], '数据不存在', 400);
    }

}
