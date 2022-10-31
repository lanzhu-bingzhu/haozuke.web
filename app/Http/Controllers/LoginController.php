<?php

namespace App\Http\Controllers;

use App\Models\Power;
use App\Models\RolePower;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class LoginController extends Controller
{
    /**
     * 获取验证码
     *
     * @return void
     */
    public function getCode()
    {
        $code = captcha_src();

        return $this->success(['code' => $code], 'ok');
    }

    /**
     * 渲染登陆页面
     *
     * @return void
     */
    public function index()
    {
        // 验证是否登陆，登陆跳转主页
        if (Auth::check()) {
            return redirect(route('admin/index'));
        }
        $code = captcha_src();

        return view('login.login', ['code' => $code]);
    }

    /**
     * 执行登陆方法
     *
     * @return void
     */
    public function send(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required',
            'password' => 'required',
            'code' => 'required',
            'online' => ''
        ]);
        
        $number = Redis::get('login_static_'.$validated['username'])?? 0;
        if ($number == 3) {
            return redirect(route('login'))->with('msg', '错误次数过多，请稍后再试');
        }

        // 验证码验证
        if (!captcha_check($validated['code'])) {
            return redirect(route('login'))->with('msg', '验证码错误');
        }
        // 管理员身份验证
        $bool = Auth::attempt(['username' => $validated['username'], 'password' => $validated['password']], !empty($validated['online'])? true: false);
        // 获取管理员身份信息
        $user = Auth::user();
        // 登录成功
        if ($bool) {
            // 存储管理员身份信息
            session(['user' => $user]);
            session(['login' => null]);

            $this->getPower($user);

            return redirect(route('admin/index'));
        }
        // 登陆失败
        Redis::set('login_static_' . $validated['username'], $number+1, time()+3600);

        session(['login' => $validated]);

        return redirect(route('login'))->with('msg', '账号或密码错误');
    }

    /**
     * 退出登陆
     *
     * @return void
     */
    public function quit(Request $request)
    {
        // 退出登陆
        Auth::logout();
        // 销毁session
        $request->session()->invalidate();
        // 重置CSRF
        $request->session()->regenerateToken();

        return redirect(route('login'));
    }

    /**
     * 获取权限
     *
     * @return void
     */
    public function getPower($user) {
        if ($user->role_id == 1) {
            $power = Power::all();
        } else {
            $power_id = RolePower::where('role_id', $user->role_id)->get();

            $power_id = array_column($power_id->toArray(), 'power_id');

            $power = Power::whereIn('id', $power_id)->get();
        }
        session(['login_power_'.$user->username => $power->toArray()]);
    }
}
