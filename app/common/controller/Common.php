<?php

namespace app\common\controller;

use app\BaseController;
use app\common\model\AdminKeyConfig;
use app\common\controller\jwtAuth;
use think\Response;
use think\facade\Cache;

class Common extends BaseController
{
    /**
     * 接口返回数据方法
     */
    public function return_json($count = 0, $data = [], $msg = "数据请求成功", $code = 200)
    {
        if (empty($data) && $code == 200) {
            $code = 204;
            if($msg == "数据请求成功"){
                $msg == "数据为空";
            }
        }
        if ($count == 0) {
            $result = [
                //状态码
                "code" => $code,
                //消息
                "msg" => $msg,
            ];
        } else {
            $result = [
                //状态码
                "code" => $code,
                //消息
                "msg" => $msg,
                //数据条数
                "count" => $count,
                //数据
                "data" => $data
            ];
        }

        return Response::create($result, 'json');
    }

    /**
     * 设置验证码 $key为缓存的键
     */
    public function setCode($key)
    {
        $code = substr(str_shuffle('123456789abcdefghijklmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ'), 0, 4);
        Cache::set($key, $code, 60);
        $this->code = $code;
    }

    public function upload($path){
        // 获取表单上传文件
        $files = request()->file();
        $savename = [];

        foreach($files as $file){
            var_dump($file);  $savename[] = \think\facade\Filesystem::putFile( $path, $file);
        }
    }
}
