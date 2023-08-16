<?php

namespace app\api\controller\admin\v1;

use app\common\controller\JwtAuth;
use think\facade\Request;
use app\admin\model\AdminKeyConfig;
use app\admin\model\Admin;
use app\common\controller\CheckSignTimes;
use think\facade\Cache;

class Login extends CheckSignTimes
{
    public function __construct()
    {
        //检查是否需要验证签名和时间
        $this->checkSignTimes('admin');
        $this->params = Request::post();
        header('Content-Type:application/json; charset=utf-8');
    }

    /**
     * 用户登录 图片验证码 用户名、手机号、邮箱+密码
     */
    public function loginPassword()
    {
        $data = $this->params;                                                     //获取参数
        $this->checkImgCode($data);                                                //验证码验证
        $key = AdminKeyConfig::find(1)['admin'];                                   //获取管理员后台key

        if (filter_var($data['username'], FILTER_VALIDATE_EMAIL)) {
            $res = Admin::where('email', $data['username'])->findOrEmpty();       //通过邮箱查询用户信息
        } elseif (preg_match("/^1[345678]{1}\d{9}$/", $data['username'])) {
            $res = Admin::where('mobile', $data['username'])->findOrEmpty();      //通过手机查询用户信息
        } else {
            $res = Admin::where('username', $data['username'])->findOrEmpty();    //通过用户名查询用户信息
        }

        if ($res->isEmpty()) {
            return $this->returnJson(0, [], '账号或者密码错误', 400);              //账号不存在
        } else {
            if ($res->password == $data['password']) {
                //登录成功根据管理后台key下发token
                $jwt = JwtAuth::getInstance();
                $token = $jwt->setKey($key)->setId($res->id)->getToken();
                return $this->returnJson(1, ['token' => $token], '登录成功', 200);
            } else {
                return $this->returnJson(0, [], '账号或者密码错误', 400);
            }
        }
    }

    /**
     * 用户登录 手机号+验证码
     */
    public function loginMobile()
    {
        $data = $this->params;                                                     //获取参数
        $this->checkMobileCode($data);                                             //验证码验证
        $key = AdminKeyConfig::find(1)['admin'];                                   //获取管理员后台key
        $res = Admin::where('mobile', $data['mobile'])->findOrEmpty();    //通过用户名查询用户信息
        if ($res->isEmpty()) {
            return $this->returnJson(0, [], '账号或者密码错误', 400);              //账号不存在
        } else {
            //登录成功根据管理后台key下发token
            $jwt = JwtAuth::getInstance();
            $token = $jwt->setKey($key)->setId($res->id)->getToken();
            return $this->returnJson(1, ['token' => $token], '登录成功', 200);
        }
    }

    /**
     * 用户登录 手机号+验证码
     */
    public function loginEmail()
    {
        $data = $this->params;                                                     //获取参数
        $this->checkEmailCode($data);                                              //验证码验证
        $key = AdminKeyConfig::find(1)['admin'];                                   //获取管理员后台key
        $res = Admin::where('email', $data['email'])->findOrEmpty();    //通过用户名查询用户信息
        if ($res->isEmpty()) {
            return $this->returnJson(0, [], '账号或者密码错误', 400);              //账号不存在
        } else {
            //登录成功根据管理后台key下发token
            $jwt = JwtAuth::getInstance();
            $token = $jwt->setKey($key)->setId($res->id)->getToken();
            return $this->returnJson(1, ['token' => $token], '登录成功', 200);
        }
    }

    /**
     * 用户注册
     */
    public function reg()
    {
        return '注册成功';
    }

    /**
     * 判断图片验证码验证是否成功
     */
    public function checkImgCode($data)
    {
        //通过uuid在缓存中拿到验证码
        if (strtolower(Cache::get($data['uuid'])) != strtolower($data['code'])) {
            Cache::delete($data['uuid']); //验证码验证失败删除验证码
            echo json_encode(['code' => 400, 'msg' => '验证码错误'], JSON_UNESCAPED_UNICODE);
            die;
        } else {
            Cache::delete($data['uuid']); //验证码验证成功删除验证码
        }
    }

    /**
     * 判断手机验证码是否正确
     */
    public function checkMobileCode($data)
    {
        if (strtolower(Cache::get($data['mobile'])) != strtolower($data['code'])) {
            Cache::delete($data['mobile']); //验证码验证失败删除验证码
            echo json_encode(['code' => 400, 'msg' => '验证码错误'], JSON_UNESCAPED_UNICODE);
            die;
        } else {
            Cache::delete($data['mobile']); //验证码验证成功删除验证码
        }
    }

    /**
     * 判断邮箱验证码是否正确
     */
    public function checkEmailCode($data)
    {
        if (strtolower(Cache::get($data['email'])) != strtolower($data['code'])) {
            Cache::delete($data['email']); //验证码验证失败删除验证码
            echo json_encode(['code' => 400, 'msg' => '验证码错误'], JSON_UNESCAPED_UNICODE);
            die;
        } else {
            Cache::delete($data['email']); //验证码验证成功删除验证码
        }
    }
}
