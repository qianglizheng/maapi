<?php

declare(strict_types=1);

namespace app\common\middleware;

class CheckToken
{
    /**
     * 处理请求
     *
     * @param \think\Request $request
     * @param \Closure       $next
     * @return Response
     */
    public function handle($request, \Closure $next)
    {
        echo '处理token';
        return $next($request);
    }
}
