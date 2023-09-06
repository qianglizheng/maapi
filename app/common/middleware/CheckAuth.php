<?php

declare(strict_types=1);

namespace app\common\middleware;

use app\common\controller\Common;
use app\common\controller\JwtAuth;
use app\admin\model\AdminKeyConfig;
use app\user\model\UserApps as Apps;
use think\facade\Request;

class CheckAuth extends Common
{
    /**
     * 检查
     * 返回的request里面的data是解码后的用户信息
     * @param \think\Request $request
     * @param \Closure       $next
     * @return Response
     */
    public function handle($request, \Closure $next)
    {
        header('Content-Type:application/json; charset=utf-8');
        $token = Request::header('Authorization');
        if (empty($token) || $token == "null") {
            echo json_encode(['code' => 400, 'msg' => 'token不能为空'], JSON_UNESCAPED_UNICODE);
            die;
        }

        //根据是否有参数app_id和uid判断是否是应用接口->判断应用和用户是否对应->防止获取不到key  如果没有这两个参数就将它们置为null
        if (!isset($request['app_id'], $request['uid'])) {
            $request['app_id'] = $request['uid']  = null;
        } else {
            if (!$this->checkApp($request['app_id'], $request['uid'])) {
                echo json_encode(['code' => 400, 'msg' => '应用不存在或者不属于该用户'], JSON_UNESCAPED_UNICODE);
                die;
            }
        }

        //根据地址判断接口类型同时设置type 然后获取key $type为a：admin接口 $type为u->user接口 $type为w->web接口  $type为v->公共接口
        $type = $request->url()[5];
        $key = $this->getKeyType($type, $request['app_id'], $request['uid'], $request);

        //如果$kye是一个数组说明是公共接口，所以用户、管理员、web用户的token均可 公共接口会根据token设置$request->type
        $this->decodeData($token, $key, $request);

        //权限验证 返回的是true或者false 表示权限验证通过和不通过 这里的$request和AddonsAuth的不一样，这里的是对象，插件是数组
        $res = $this->checkAuth($request);
        if (!$res) {
            //权限不够
            echo json_encode(['code' => 400, 'msg' => '没有权限'], JSON_UNESCAPED_UNICODE);
            die;
        }
        return $next($request);
    }

    /**
     * 根据前端的地址判断是哪个接口，获取相应的key和传递接口类型到鉴权中间件
     */
    public function getKeyType($type, $app_id, $uid, $request)
    {
        if ($type == 'u') {
            $request->type = 'user';
            $key = AdminKeyConfig::find(1)['user'];                             //用户接口
        } elseif ($type == 'a') {
            $request->type = 'admin';
            $key = AdminKeyConfig::find(1)['admin'];                            //管理接口
        } elseif ($type  == 'w') {
            $request->type = 'web';
            $key = Apps::where(['id' => $app_id, 'uid' => $uid])->value('token_key'); //应用接口
        } elseif ($type  == 'v') {                                               //公共接口 根据token来判断是谁在调用
            $key_user = AdminKeyConfig::find(1)['user'];
            $key_admin = AdminKeyConfig::find(1)['admin'];
            $key_web = Apps::where(['id' => $app_id, 'uid' => $uid])->value('token_key');
            return $arr = [$key_user, $key_admin, $key_web];
        }
        return $key;
    }

    /**
     * 判断应用是否存在和是否是当前用户的
     */
    public function checkApp($app_id, $uid)
    {
        $res = Apps::where([
            'id' => $app_id,
            'uid' => $uid
        ])->findOrEmpty();

        if ($res->isEmpty()) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * 解码token
     */
    public function decodeData($token, $key, $request)
    {
        if (is_array($key)) {
            //解码token获取数据或者提示错误 $data为解析token后得到的用户信息
            $jwt = JwtAuth::getInstance();
            $data = $jwt->setKey($key[0])->decode($token)->getData();          //判断是不是用户token
            if ($data == null) {
                $data = $jwt->setKey($key[1])->decode($token)->getData();      //判断是不是管理token
                if ($data == null) {
                    $data = $jwt->setKey($key[2])->decode($token)->getData();  //判断是不是web token
                    if ($data == null) {
                        echo json_encode(['code' => 400, 'msg' => 'token错误'], JSON_UNESCAPED_UNICODE);
                        die;                                                   //三种key都没有查询出来就说明token错误
                    } else {
                        $request->type = 'web'; //应用token
                        $request->data = $data;
                    }
                } else {
                    $request->type = 'admin'; //管理token
                    $request->data = $data;
                }
            } else {
                $request->type = 'user'; //用户token
                $request->data = $data;
            }
        } else {
            //解码token获取数据或者提示错误
            $jwt = JwtAuth::getInstance();
            $data = $jwt->setKey($key)->decode($token)->getData();
            if ($data == null) {
                echo json_encode(['code' => 400, 'msg' => 'token错误'], JSON_UNESCAPED_UNICODE);
                die;
            } else {
                $request->data = $data;
            }
        }
    }

    /**
     * 检查访问者权限
     */
    public function checkAuth($data)
    {
        return $data->type;
        switch ($data->type) {
            case  'admin':
                //可以在这里根据用户的身份来做一些权限判断
                // if ($data->data['id'] != '1') {
                //     return false;
                // }
                return true;
                break;
            case  'user':
                // echo $request->data['id'];
                return true;
                break;
            case  'web':
                // echo $request->data['id'];
                return true;
                break;
            case  'all':
                // echo $request->data['id'];
                return true;
                break;
        }
    }
}
