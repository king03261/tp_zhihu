<?php
declare (strict_types = 1);

namespace app\middleware;

use think\facade\Session;

class Auth
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
        if (!Session::has("user")) {
            Session::flash("error","请登录");
            return redirect("/account/login");
        }
        return $next($request);
    }
}
