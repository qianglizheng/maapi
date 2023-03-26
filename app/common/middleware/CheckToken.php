<?php

declare(strict_types=1);

namespace app\common\middleware;

use app\common\controller\Common;
use app\common\controller\JwtAuth;
use app\common\model\AdminKeyConfig;
use app\common\model\Apps;

class CheckToken extends Common
{
    /**
     * 检查
     *
     * @param \think\Request $request
     * @param \Closure       $next
     * @return Response
     */
    public function handle($request, \Closure $next)
    {
        //根据是否有参数app_id和uid判断是否是应用接口->判断应用和用户是否对应->防止获取不到key
        if ($request['app_id'] && $request['uid']) {
            if (!$this->checkApp($request['app_id'], $request['uid'])) {
                return $this->return_json(0, [], '应用不存在或者不属于该用户', 400);
            }
        }
        //根据地址判断接口类型然后获取key->$type为a：admin接口->$type为u->user接口->$type为v->web接口
        $type = $request->url()[5];
        $key = $this->getKey($type, $request['app_id'], $request['uid']);
        //解码token获取数据或者提示错误
        $jwt = JwtAuth::getInstance();
        $data = $jwt->setKey($key)->decode($request['token'])->getData();

        if ($data == null) {
            return $this->return_json(0, [], $jwt->getError(), 400);
        } else {
            if ($data['exp'] < time()) {
                return $this->return_json(0, [], 'token已过期', 400);
            } else {
                return $this->return_json(1, ['id' => $data['id']]);
            }
        }
        return $next($request);
    }
    /**
     * 根据前端的地址判断是哪个接口，获取相应的key
     */
    public function getKey($type, $app_id, $uid)
    {
        if ($type == 'u') {
            $key = AdminKeyConfig::find(1)['user']; //用户接口
        } elseif ($type == 'a') {
            $key = AdminKeyConfig::find(1)['admin']; //管理接口
        } elseif ($type == 'v') {
            $key = Apps::where(['id' => $app_id, 'uid' => $uid])->value('key'); //应用接口
        }
        return $key;
    }
    /**
     * 判断应用是否存在和是否是当前用户的
     */
    public function checkApp($app_id, $uid)
    {
        $res = Apps::where(['id' => $app_id, 'uid' => $uid])->findOrEmpty();
        if ($res->isEmpty()) {
            return 0;
        } else {
            return 1;
        }
    }
}
