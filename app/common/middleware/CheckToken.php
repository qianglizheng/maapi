<?php

declare(strict_types=1);

namespace app\common\middleware;

use app\common\controller\Common;
use app\common\controller\jwtAuth;
use app\common\model\ApiKey;
use app\common\model\Apps;
use think\facade\Request;

class CheckToken extends Common
{
    /**
     * 请求参数
     */
    protected $params;
    /**
     * 检查
     *
     * @param \think\Request $request
     * @param \Closure       $next
     * @return Response
     */
    public function handle($request, \Closure $next)
    {
        $data = $this->params = Request::param();
        //判断是否是应用接口
        $data['app_id'] = isset($data['app_id']) ? $data['app_id'] : null;
        $data['uid'] = isset($data['uid']) ? $data['uid'] : null;
        //判断应用和用户是否对应->防止获取不到key
        if ($data['app_id'] && $data['uid']) {
            if (!$this->checkApp($data['app_id'], $data['uid'])) {
                return $this->return_json(0, [], '应用不存在或者不属于该用户', 400);
            }
        }
        //根据地址判断接口类型
        $type = Request::url()[1];
        $key = $this->getKey($type, $data['app_id'], $data['uid']);
        //解码token获取id或者提示错误
        $jwt = jwtAuth::getInstance();
        $id = $jwt->setKey($key)->decode($data['token'])->getId();
        if ($id == null) {
            return $this->return_json(0, [], $jwt->getError(), 400);
        } else {
            return $this->return_json(1, ['id' => $id]);
        }
        return $next($request);
    }
    /**
     * 根据前端的地址判断是哪个接口，获取相应的key
     */
    public function getKey($type, $app_id, $uid)
    {
        if ($type == 'u') {
            $key = ApiKey::find(1)['user']; //用户接口
        } elseif ($type == 'a') {
            $key = ApiKey::find(1)['admin']; //管理接口
        } else {
            $key = Apps::where('id', $app_id)::where('uid', $uid)->column('key'); //应用接口
        }
        return $key;
    }
    /**
     * 判断应用是否存在和是否是当前用户的
     */
    public function checkApp($app_id, $uid)
    {
        $res = Apps::where('id', $app_id)::where('uid', $uid)->find(); //应用接口
        if ($res->isEmpty()) {
            return 0; //应用不存在或者不属于该用户
        } else {
            return 1;
        }
    }
}
