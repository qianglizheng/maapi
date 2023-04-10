<?php

namespace app\api\controller\v1;

class Upload
{
    public function upload($path)
    {
        // 获取表单上传文件
        $files = request()->file();
        $savename = [];

        foreach ($files as $file) {
            $savename[] = \think\facade\Filesystem::putFile($path, $file);
        }
    }
}
