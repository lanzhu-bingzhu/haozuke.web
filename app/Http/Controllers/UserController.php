<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Rules\PhoneUppercase;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        $user = User::all();
        return view('user.member-list', ['users' => $user]);
    }

    public function save(Request $request) {
        // 表单验证
        $validated = $request->validate([
            'username' => ['required'],
            'sex' => ['required'],
            'phone' => ['required', new PhoneUppercase],
            'email' => ['required', 'email']
        ]);
        $validated['password'] = bcrypt('root');
        // 数据添加
        try {
            User::insert($validated);
        } catch (Exception $e) {
            return $this->fail($e->getMessage(), $e->getCode());
        }

        return redirect(route('view/member-add'));
    }
}
