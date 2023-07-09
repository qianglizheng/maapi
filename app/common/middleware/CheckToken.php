<?php

declare(strict_types=1);

namespace app\common\middleware;

use app\common\controller\Common;
use app\common\controller\JwtAuth;
use app\admin\model\AdminKeyConfig;
use app\user\model\Apps;
use think\facade\Request;

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
        $token = Request::header('authorization');
        if (empty($token)) {
            return $this->returnJson(0, [], 'token不能为空', 400);
        }

        //根据是否有参数app_id和uid判断是否是应用接口->判断应用和用户是否对应->防止获取不到key  如果没有这两个参数就将它们置为null
        if (!isset($request['app_id'], $request['uid'])) {
            $request['app_id'] = $request['uid'] = null;
        } else {
            if (!$this->checkApp($request['app_id'], $request['uid'])) {
                return $this->returnJson(0, [], '应用不存在或者不属于该用户', 400);
            }
        }

        //根据地址判断接口类型然后获取key->$type为a：admin接口->$type为u->user接口->$type为v->web接口
        $type = $request->url()[5];
        $key = $this->getKey($type, $request['app_id'], $request['uid'], $request);

        //解码token获取数据或者提示错误
        $jwt = JwtAuth::getInstance();
        $data = $jwt->setKey($key)->decode($token)->getData();

        if ($data == null) {
            return $this->returnJson(0, [], 'token错误', 400);
        } else {
            // $request->id = $data['id'];
            $request->data = $data;
            // return $this->returnJson(1, ['id' => $data['id']]);//解析id
        }
        return $next($request);
    }

    /**
     * 根据前端的地址判断是哪个接口，获取相应的key和传递接口类型到鉴权中间件
     */
    public function getKey($type, $app_id, $uid, $request)
    {
        if ($type == 'u') {
            $request->type = 'user';
            $key = AdminKeyConfig::find(1)['user'];                             //用户接口
        } elseif ($type == 'a') {
            $request->type = 'admin';
            $key = AdminKeyConfig::find(1)['admin'];                            //管理接口
        } else {
            $request->type = 'web';
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
