<?php

declare(strict_types=1);

namespace app\common\middleware;

use app\common\controller\Common;

class CheckAuth extends Common
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
        switch ($request->type) {
            case  'admin':
                if($request->data['id'] != '1'){
                    return $this->returnJson(0, [], '你没有权限', 400);
                }
                break;
            case  'user':
                echo $request->data->id;
                break;
            case  'web':
                echo $request->data->id;
                break;
        }
        return $next($request);
    }
}
