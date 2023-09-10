<?php

namespace app\common\controller;

use app\common\controller\Common;
use app\common\controller\jwtAuth;
use think\facade\Request;
use app\admin\model\AdminKeyConfig;
use app\user\model\Apps;

class AddonsAuth extends Common
{
    public function addonsAuth()
    {
        $token = Request::header('authorization');
        $request = Request::param(); //这是一个数组

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

        //根据地址判断接口类型 同时设置type 然后获取key->$type为a：admin接口 $type为u->user接口 $type为w->web接口  $type为其他->公共接口
        $type = $request['addon'][0];  //addons是控制器的名子
        $key = $this->getKeyType($type, $request['app_id'], $request['uid']);
// echo $key;
// die;
        //解码token得到用户信息 如果$kye是一个数组说明是公共接口，所以用户、管理员、web用户的token均可 公共接口会根据token设置$this->type
        $request['data'] = $this->decodeData($token, $key);

        if(!$request['data']) {
            return $this->returnJson(0, [], 'token错误', 400);
        }

        $res = $this->checkAuth($request);
        if (!$res) {
            //权限不够
            return $this->returnJson(0, [], '没有权限', 400);
        }

        return $request;
    }

    /**
     * 根据前端的地址判断是哪个接口，获取相应的key和传递接口类型到鉴权中间件
     */
    public function getKeyType($type, $app_id, $uid)
    {
        if ($type == 'u') {
            $this->type = 'user';
            $key = AdminKeyConfig::find(1)['user'];                             //用户接口
        } elseif ($type == 'a') {
            $this->type = 'admin';
            $key = AdminKeyConfig::find(1)['admin'];                            //管理接口
        } elseif ($type  == 'w') {
            $this->type = 'web';
            $key = Apps::where(['id' => $app_id, 'uid' => $uid])->value('token_key'); //应用接口
        } else {
            $key_user = AdminKeyConfig::find(1)['user'];
            $key_admin = AdminKeyConfig::find(1)['admin'];
            $key_web = Apps::where(['id' => $app_id, 'uid' => $uid])->value('token_key');
            return $arr = [$key_user, $key_admin, $key_web];                    //公共接口
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

    /**
     * 解码token到$request数组里面的data
     */
    public function decodeData($token, $key)
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
                        die;
                    } else {
                        $this->type = 'web';
                        return $data;
                    }
                } else {
                    $this->type = 'admin';
                    return $data;
                }
            } else {
                $this->type = 'user';
                return $data;
            }
        } else {
            //解码token获取数据或者提示错误
            $jwt = JwtAuth::getInstance();
            $data = $jwt->setKey($key)->decode($token)->getData();
            if ($data == null) {
                echo json_encode(['code' => 400, 'msg' => 'token错误'], JSON_UNESCAPED_UNICODE);
                die;
            } else {
                return $data;
            }
        }
    }

    /**
     * 检查访问者权限
     */
    public function checkAuth($data)
    {
        switch ($this->type) {
            case  'admin':
                //可以在这里根据用户的身份来做一些权限判断
                if ($data['data']['id'] != '1') {
                    return false;
                }
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
        }
    }
}
