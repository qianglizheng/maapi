<?php

declare(strict_types=1);

namespace app\api\middleware;

class CheckParam
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
        //根据控制器和方法查找对应的验证规则对参数进行验证
        // $validate = \think\facade\Validate::rule($this->rule[$request->controller()][$request->action()]);
        // if (!$validate->check($request->param())) {
        //     return json(['code' => 200, 'msg' => $validate->getError()]);
        // }
        echo '进来了';
        return $next($request);
    }
    /**
     * 验证规则 控制器->方法->验证规则
     */
    protected $rule =   [
        'Index' => [
            'check' => [
                'name'  => 'require|max:0.1',
                'age'   => 'number|between:1,120',
                'email' => 'email',
            ]
        ]
    ];
}
