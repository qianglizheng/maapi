<?php

namespace app\api\controller\v1;

use app\common\controller\Common;

class Upload extends Common
{
    public function upload($path)
    {
        // 获取表单上传文件
        $files = request()->file();
        $savename = [];

        foreach ($files as $file) {
            $savename[] = \think\facade\Filesystem::putFile($path, $file);
        }
        $count = count($savename);
        if ($count != 0) {
            return $this->returnJson($count, $savename, '文件上传成功');
        } else {
            return $this->returnJson(0,[],'文件上传失败');
        }
    }
}
