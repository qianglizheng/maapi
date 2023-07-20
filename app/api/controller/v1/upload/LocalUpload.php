<?php

namespace app\api\controller\v1\upload;

use think\facade\Request;
use app\common\controller\CheckSignTimes;

class LocalUpload extends CheckSignTimes
{
    public function __construct()
    {
        //检查是否需要验证签名和时间 request()->type是检查权限中间件设置根据token的类型设置的接口类型
        $this->checkSignTimes(request()->type);
    }

    /**
     * 上传文件到本地服务器
     */
    public function upload($path)
    {
        // 获取表单上传文件
        $files = request()->file();
        if (empty($files)) {
            return $this->returnJson(0, [], '上传为空');
        }

        $savename = [];

        foreach ($files as $file) {
            $temp = Request::host().'/storage/'.\think\facade\Filesystem::putFile($path, $file);
            $savename[] = str_replace('\\','/',$temp);
        }
        $count = count($savename);
        if ($count != 0) {
            return $this->returnJson($count, $savename, '文件上传成功');
        } else {
            return $this->returnJson(0, [], '文件上传失败');
        }
    }
}
