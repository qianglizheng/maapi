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

        //根据地址判断接口类型然后获取key->$type为a：admin接口 $type为u->user接口 $type为w->web接口  $type为v->公共接口
        $type = $request->url()[5];
        $key = $this->getKey($type, $request['app_id'], $request['uid'], $request);

        //如果$kye是一个数组说明是公共接口，所以用户、管理员、web用户的token均可
        if (is_array($key)) {
            //解码token获取数据或者提示错误 $data为解析token后得到的用户信息
            $jwt = JwtAuth::getInstance();
            $data = $jwt->setKey($key[0])->decode($token)->getData();          //判断是不是用户token
            if ($data == null) {
                $data = $jwt->setKey($key[1])->decode($token)->getData();      //判断是不是管理token
                if ($data == null) {
                    $data = $jwt->setKey($key[2])->decode($token)->getData();  //判断是不是web token
                    if ($data == null) {
                        return $this->returnJson(0, [], 'token错误', 400);
                    } else {
                        $request->data = $data;
                    }
                }else {
                    $request->data = $data;
                }
            }else {
                $request->data = $data;
            }
        } else {
            //解码token获取数据或者提示错误
            $jwt = JwtAuth::getInstance();
            $data = $jwt->setKey($key)->decode($token)->getData();

            if ($data == null) {
                return $this->returnJson(0, [], 'token错误', 400);
            } else {
                $request->data = $data;
            }
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
        } elseif ($type  == 'w') {
            $request->type = 'web';
            $key = Apps::where(['id' => $app_id, 'uid' => $uid])->value('key'); //应用接口
        } else {
            $key_user = AdminKeyConfig::find(1)['user'];
            $key_admin = AdminKeyConfig::find(1)['admin'];
            $key_web = Apps::where(['id' => $app_id, 'uid' => $uid])->value('key');
            return $arr = [$key_user, $key_admin, $key_web];
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
            return false;
        } else {
            return true;
        }
    }
}
