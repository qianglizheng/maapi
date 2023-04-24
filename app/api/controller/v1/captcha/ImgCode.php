<?php

namespace app\api\controller\v1\captcha;

use think\facade\Cache;
use think\facade\Request;

class ImgCode extends SetCode
{
    /**
     * 调用父类生成验证码并且存放在redis中
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 添加干扰元素 线条
     */
    protected function addLine($image)
    {
        for ($i = 0; $i < 5; $i++) {
            $lineColor = imagecolorallocate($image, rand(0, 255), rand(0, 255), rand(0, 255));
            imageline($image, rand(0, 100), rand(0, 30), rand(0, 100), rand(0, 30), $lineColor);
        }
    }

    /** 
     * 绘制验证码图片
     */
    protected function codeImg($image, $code)
    {
        for ($i = 0; $i < 4; $i++) {
            $digitColor = imagecolorallocate($image, rand(0, 255), rand(0, 255), rand(0, 255));
            imagestring($image, 5, 20 + $i * 20, 8, $code[$i], $digitColor);
        }
    }

    /**
     * 创建画布
     */
    protected function creatImg($width = 100, $height = 30)
    {
        $image = imagecreatetruecolor($width, $height);
        $bgColor = imagecolorallocate($image, 255, 255, 255);   // 设置画布背景色为白色
        imagefill($image, 0, 0, $bgColor);
        return $image;
    }

    /**
     * 显示验证码图片
     */
    public function getImg($uuid)
    {
        $code = Cache::get($uuid);
        if (empty($code)) {
            return $this->returnJson(0, [], '用户标识不正确或者已过期', 400);
        }
        $image = $this->creatImg();            // 创建一个白色背景画布
        $this->addLine($image);                // 添加干扰元素
        $this->codeImg($image, $code);         // 在画布上绘制验证码文本
        imagepng($image);                      // 输出验证码图片
        imagedestroy($image);                  // 释放画布资源
        return response()->header([
            'Content-Type' => ' image/png'
        ]);                                    // 设置响应头，告诉浏览器输出的是图片
    }

    /**
     * 返回验证码相关信息
     */
    public function sendImgCode()
    {
        $data = [
            'uuid' => $this->uuid,
            'url' => Request::domain() . '/api/v1/captcha/get_img?uuid=' . $this->uuid,
        ];
        return $this->returnJson(1, $data);
    }
}
