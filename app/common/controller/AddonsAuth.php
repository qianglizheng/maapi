<?php

namespace app\common\controller;

use app\common\controller\Common;
use app\common\controller\jwtAuth;
use think\facade\Request;
use app\admin\model\AdminKeyConfig;

class AddonsAuth extends Common
{
    public function CheckToken()
    {
        $token = Request::header('authorization');
        $request = Request::param();
        if (empty($token)) {
            return $this->returnJson(0, [], 'token不能为空', 400);
        } else {
            $token = substr($token, 6);
        }
        if (!isset($request['app_id'], $request['uid'])) {
            $request['app_id'] = $request['uid'] = null;
        }

        //根据是否有参数app_id和uid判断是否是应用接口->判断应用和用户是否对应->防止获取不到key
        if ($request['app_id'] && $request['uid']) {
            if (!$this->checkApp($request['app_id'], $request['uid'])) {
                return $this->returnJson(0, [], '应用不存在或者不属于该用户', 400);
            }
        }

        //根据地址判断接口类型然后获取key->$type为a：admin接口->$type为u->user接口->$type为v->web接口
        $type = Request::url()[8];
        $key = $this->getKey($type, $request['app_id'], $request['uid']);

        //解码token获取数据或者提示错误
        $jwt = JwtAuth::getInstance();
        $data = $jwt->setKey($key)->decode($token)->getData();

        if ($data == null) {
            echo $this->returnJson(0, [], 'token错误', 400);
        } else {
            // return $this->returnJson(1, ['id' => $data['id']]);//解析id
        }
    }
    /**
     * 根据前端的地址判断是哪个接口，获取相应的key
     */
    public function getKey($type, $app_id, $uid)
    {
        if ($type == 'u') {
            $key = AdminKeyConfig::find(1)['user'];                             //用户接口
        } elseif ($type == 'a') {
            $key = AdminKeyConfig::find(1)['admin'];                            //管理接口
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
