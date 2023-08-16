<?php

namespace app\common\controller;

use app\common\controller\Common;
use think\facade\Request;
use app\admin\model\AdminApiConfig;
use app\user\model\UserApiConfig;
use app\user\model\Apps;
use think\facade\Cache;

class CheckSignTimes extends Common
{
    public function checkSignTimes($type = null)
    {
        header('Content-Type:application/json; charset=utf-8');

        $this->params = Request::param();

        //检查接口设置的配置缓存是否存在，不存在则从数据库查询，放入缓存
        $this->checkCache($type); //type是接口类型

        //判断签名验证有没有开启 开启则执行验证
        if (Cache::get('web_security_sign') || Cache::get('user_security_sign') || Cache::get('admin_security_sign')) {
            $this->checkSign($type);
        }

        //判断时间戳验证有没有开启 开启则执行验证
        if (Cache::get('web_security_timestamp') || Cache::get('user_security_timestamp') || Cache::get('admin_security_timestamp')) {
            $this->checkTimes($type);
        }
    }

    /**
     * 检查请求是否超时
     */
    public function checkTimes()
    {
        //检查参数是否存在
        if (empty($this->params['timestamp'])) {
            echo json_encode(['code' => 400, 'msg' => 'timestamp不能为空'], JSON_UNESCAPED_UNICODE);
            die;
        }

        $timestamp = $this->params['timestamp']; //获取请求时间
        $timeout = Cache::get('security_timestamp_timeout'); //获取超时时间

        //判断是否超时
        if ((time() - $timestamp) > $timeout) {
            echo json_encode(['code' => 400, 'msg' => '请求已超时'], JSON_UNESCAPED_UNICODE);
            die;
        }
    }

    /**
     * 检查签名是否正确
     */
    public function checkSign($type)
    {
        //检查参数是否存在
        if (empty($this->params['sign'])) {
            echo json_encode(['code' => 400, 'msg' => 'sign不能为空'], JSON_UNESCAPED_UNICODE);
            die;
        }
        $params = $this->params;
        //按照规则签名
        unset($params['sign']);
        $str = null;
        foreach ($params as $param) {
            $str .= md5($param);
        }
        //根据不同的type获取不同的盐
        if ($type == 'admin') {
            $mix = Cache::get('admin_security_sign_key');
        } elseif ($type == 'user') {
            $mix = Cache::get('user_security_sign_key');
        } else {
            $mix = Cache::get('web_security_sign_key');
        }

        $str = $mix . $str . $mix;
        $sign = md5($str);

        //判断签名是否一致
        if ($this->params['sign'] != $sign) {
            echo json_encode(['code' => 400, 'msg' => '签名验证失败'], JSON_UNESCAPED_UNICODE);
            die;
        }
    }

    /**
     * 检查是否有缓存配置 没有则查询
     */
    public function checkCache($type)
    {
        //$type是调用这个方法的接口的类型 分为后台接口、用户接口、应用接口
        if ($type == 'admin') {
            if (Cache::get('admin_timestamp') == null) {
                $this->apiConfig = AdminApiConfig::find(1);
                Cache::set('admin_security_timestamp', $this->apiConfig->security_timestamp);
                Cache::set('admin_security_sign', $this->apiConfig->security_sign);
                Cache::set('admin_security_sign_key', $this->apiConfig->security_sign_key);
                Cache::set('admin_timestamp', $this->apiConfig->security_timestamp);
                Cache::set('admin_security_timestamp_timeout', $this->apiConfig->security_timestamp_timeout);
            }
        } elseif ($type == 'user') {
            if (Cache::get('user_timestamp') == null) {
                $this->apiConfig = UserApiConfig::find(1);
                Cache::set('user_security_timestamp', $this->apiConfig->security_timestamp);
                Cache::set('user_security_sign', $this->apiConfig->security_sign);
                Cache::set('user_security_sign_key', $this->apiConfig->security_sign_key);
                Cache::set('user_timestamp', $this->apiConfig->security_timestamp);
                Cache::set('user_security_timestamp_timeout', $this->apiConfig->security_timestamp_timeout);
            }
        } elseif ($type == 'web') {
            if (Cache::get('web_timestamp') == null) {
                $this->apiConfig = Apps::where(['id' => $this->params['app_id'], 'uid' => $this->param['uid']])->find();
                Cache::set('web_security_timestamp', $this->apiConfig->security_timestamp);
                Cache::set('web_security_sign', $this->apiConfig->security_sign);
                Cache::set('web_security_sign_key', $this->apiConfig->security_sign_key);
                Cache::set('web_timestamp', $this->apiConfig->security_timestamp);
                Cache::set('web_security_timestamp_timeout', $this->apiConfig->security_timestamp_timeout);
            }
        }
    }
}
