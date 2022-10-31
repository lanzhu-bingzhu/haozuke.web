<?php

namespace App\Http\Controllers;

use App\Models\Power;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    /**
     * 展示主页
     *
     * @return void
     */
    public function index() {
        $user = Auth::user();
        // $user = Auth::guard('webapi')->user();

        $power = session('login_power_' . $user->username);

        $power = $this->treenChildren($power);

        $role_name = Role::find($user->role_id);

        return view('admin.index', ['powers' => $power, 'role_name' => $role_name, 'user' => $user]);
    }
}
