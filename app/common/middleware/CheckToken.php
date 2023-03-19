<?php

declare(strict_types=1);

namespace app\common\middleware;

use app\common\controller\jwtAuth;
use app\common\model\apiKey;
use app\common\model\Apps;
use think\facade\Request;

class CheckToken
{
    public function __construct()
    {
    }
    /**
     * 处理请求
     *
     * @param \think\Request $request
     * @param \Closure       $next
     * @return Response
     */
    public function handle($request, \Closure $next)
    {
        //判断是user的api还是admin的api或者是前端的api
        // echo Request::url();
        // echo '中间件';
        // $key = apiKey::find(1);//根据API类型获取相应的key
        // $jwt = jwtAuth::getInstance();
        // $jwt->setKey($key);
        return $next($request);
    }
}
