<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect(route('login'))->with('message', '请登陆');
        }
        // 获取登录用户信息
        $user = Auth::user();
        // 判断不是超级管理员
        if ($user->role_id != 1) {

            $user_power = array_filter(array_merge(array_column(session('login_power_'.$user->username), 'route_name'), config('power.route')));

            $route_name = $request->route()->getName();

            if (!in_array($route_name, $user_power)) {
                return redirect(route('error/power'));
            }
        }

        return $next($request);
    }
}
