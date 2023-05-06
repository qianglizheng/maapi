<?php

declare(strict_types=1);

namespace app\common\middleware;

use think\facade\Request;

class CheckAuth
{
    /**
     * 用户鉴权
     *
     * @param \think\Request $request
     * @param \Closure       $next
     * @return Response
     */
    public function handle($request, \Closure $next)
    {
        dump($request->data);
        return $next($request);
        
    }

}
