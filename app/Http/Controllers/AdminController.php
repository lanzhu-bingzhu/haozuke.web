<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminCreateRequest;
use App\Http\Requests\AdminUpdateRequest;
use App\Models\Admin;
use App\Models\Role;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * 渲染管理员列表
     *
     * @return void
     */
    public function admin(Request $request)
    {
        $h = $request->get('h');

        $admin = Admin::with(['role'])->when($h, function ($query) use ($h) {
            $query->where("username", "like", "%$h%");
        })->orderBy('id', 'asc')->paginate(6);

        // dd($admin->toArray());
        return view('admin.admin-list', ['admins' => $admin, 'h' => $h, 'adminModel' => new Admin()]);
    }

    /**
     * 管理员添加页面
     *
     * @return void
     */
    public function adminAdd(Request $request)
    {
        $id = $request->get('id') ?? '';
        if (!empty($id)) {
            $admin = Admin::with('role')->find($id);
        }

        $role = Role::all();

        return view('admin.admin-add', ['roles' => $role, 'admin' => $admin ?? null]);
    }

    /**
     * 管理员添加
     *
     * @param AdminCreateRequest $request
     * @return void
     */
    public function adminSave(AdminCreateRequest $request)
    {
        $request->validated();

        try {
            Admin::create($request->except(['_token', 'password2']));
        } catch (Exception $e) {
            return $this->fail($e->getMessage(), $e->getCode());
        }
        // 发送邮件
        $this->email('create', [], 'lanzhubingzhu@qq.com');

        return $this->success([], 'ok');
    }

    /**
     * 编辑管理员信息
     *
     * @return void
     */
    public function adminUpdate(AdminUpdateRequest $request)
    {
        $validated = $request->validated();

        try {
            Admin::adminUpdate($validated);
        } catch (Exception $e) {
            return $this->fail($e->getMessage(), $e->getCode());
        }
        // 发送邮件
        $this->email('update', [], 'lanzhubingzhu@qq.com');

        return $this->success([], 'ok');
    }

    /**
     * 修改管理员启用状态
     *
     * @return void
     */
    public function adminStatic(Request $request)
    {
        $id = $request->get('id');
        // 验证参数
        if (empty($id) or !is_numeric($id)) {
            return $this->fail('参数错误', 1001);
        }
        $user = Auth::user();
        if ($user->id == $id) {
            return $this->fail('无法修改当前正在操作的管理员的状态', 1005);
        }
        try {
            // 修改状态
            $admin = Admin::find($id);
            $admin->is_invoke = $admin->is_invoke == '0' ? '1' : '0';
            $admin->save();
        } catch (Exception $e) {
            return $this->fail($e->getMessage(), $e->getCode());
        }
        // 发送邮件
        $this->email('update-static', [], 'lanzhubingzhu@qq.com');

        return $this->success([], 'ok');
    }

    /**
     * 删除管理员
     *
     * @return void
     */
    public function adminDelete(Request $request)
    {
        $id = $request->all('id')['id'];
        $id = is_array($id) ? $id : [$id];
        // 验证参数
        if (empty($id)) {
            return $this->fail('参数错误', 1001);
        }
        // 验证操作是否合法
        $user = Auth::user();
        if (in_array($user->id, $id)) {
            return $this->fail('无法删除当前正在操作的管理员', 1002);
        }
        try {
            $admin = Admin::where('is_invoke', '0')->whereIn('id', $id)->firstOr(function () {
                abort(1003, '无法删除启用的管理员');
            });
            $admin->delete();
        } catch (Exception $e) {
            return $this->fail($e->getMessage(), $e->getCode());
        }
        // 发送邮件
        $this->email('delete', [], 'lanzhubingzhu@qq.com');

        return $this->success([], 'ok');
    }

    /**
     * 唯一性验证
     *
     * @return void
     */
    public function remote(Request $request)
    {
        $username = $request->get('username');

        $res = Admin::where('username', $username)->first();

        if ($res) {
            return 'false';
        }
        return 'true';
    }
}
