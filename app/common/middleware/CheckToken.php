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
    public function __construct()
    {
    }
    /**
     * 检查
     *
     * @param \think\Request $request
     * @param \Closure       $next
     * @return Response
     */
    public function handle($request, \Closure $next)
    {
        $token = Request::param('token');
        $app_id = Request::param('app_id');
        $uid = Request::param('uid');
        $type = Request::url()[1];
        $key = $this->getKey($type, $app_id, $uid);
        $jwt = jwtAuth::getInstance();
        $id = $jwt->setKey($key)->decode($token)->getId();
        if ($id==null) {
            return $this->return_json(0, [], $jwt->getError());
        } else {
            return $this->return_json(1, ['id'=>$id]);
        }
        return $next($request);
    }
    /**
     * 根据前端的地址判断是哪个接口，获取相应的key
     */
    public function getKey($type, $app_id=null, $uid=null)
    {
        if ($type=='u') {
            $key = ApiKey::find(1)['user'];//用户接口
        } elseif ($type=='a') {
            $key = ApiKey::find(1)['admin'];//管理接口
        } else {
            $key = Apps::where('id', $app_id)::where('uid', $uid)->column('key');//应用接口
        }
        return $key;
    }
}
