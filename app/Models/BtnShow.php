<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;

trait BtnShow
{
    public function deleteBtn($route, $id) {
        $user = Auth::user();
        $user_power = array_filter(array_merge(array_column(session('login_power_' . $user->username), 'route_name'), config('power.route')));

        if (in_array($route, $user_power)) {
            return <<<here
                <a title="删除" href="javascript:;" onclick="admin_del(this,'$id')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a>
            here;
        } else {
            return '';
        }
    }

    public function deletesBtn($route) {
        $user = Auth::user();
        $user_power = array_filter(array_merge(array_column(session('login_power_' . $user->username), 'route_name'), config('power.route')));

        if (in_array($route, $user_power)) {
            return <<<here
                <a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a>
            here;
        } else {
            return '';
        }
    }
}