<?php

declare(strict_types=1);

namespace app\common\middleware;

use app\common\controller\jwtAuth;
use app\common\model\apiKey;
class CheckToken
{
    public function __construct()
    {
        $this->model = new apiKey();
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
        $key = $this->model->find(1);
        $jwt = jwtAuth::getInstance();
        // echo $jwt;
        return $next($request);
    }
}
