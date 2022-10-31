<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Power;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\RolePower;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    /**
     * 渲染角色列表
     *
     * @return void
     */
    public function role()
    {
        $role = Role::with('admin')->orderBy('id', 'asc')->get()->toArray() ?? null;

        foreach ($role as &$val) {
            $val['admin'] = implode(',', array_column($val['admin'], 'username'));
        }

        return view('role.admin-role', ['roles' => $role]);
    }

    /**
     * 角色添加视图
     *
     * @return void
     */
    public function roleAdd(Request $request)
    {
        $id = $request->get('id') ?? '';
        if (!empty($id)) {
            $role = Role::find($id);
        }
        return view('role.admin-role-add', ['roles' => $role ?? null]);
    }

    /**
     * 角色添加
     *
     * @return void
     */
    public function roleSave(Request $request)
    {
        $request->validate([
            'role_name' => 'required',
            'role_desc' => 'present'
        ]);

        try {
            Role::create($request->except('_token'));
        } catch (Exception $e) {
            return $this->fail($e->getMessage(), $e->getCode());
        }

        return $this->success([], 'ok');
    }

    /**
     * 角色修改
     *
     * @return void
     */
    public function roleUpdate(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required',
            'role_name' => 'required',
            'role_desc' => 'present'
        ]);

        try {
            Role::roleUpdate($validated);
        } catch (Exception $e) {
            return $this->fail($e->getMessage(), $e->getCode());
        }

        return $this->success([], 'ok');
    }

    /**
     * 角色删除
     *
     * @return void
     */
    public function roleDelete(Request $request)
    {
        $id = $request->all('id')['id'];
        $id = is_array($id) ? $id : [$id];
        if (empty($id)) {
            return $this->fail('参数错误', 1001);
        }

        try {
            // 是否有管理员关联，没有关联则删除
            Admin::whereIn('role_id', $id)->firstOr(function () use ($id) {
                Role::destroy($id);
            }) ? abort(0, '该角色还有管理员使用，无法删除') : '';
        } catch (Exception $e) {
            return $this->fail($e->getMessage(), $e->getCode());
        }

        return $this->success([], 'ok');
    }

    /**
     * 角色权限分配视图
     *
     * @param Power $power
     * @return void
     */
    public function alterPower(Request $request, Power $power)
    {
        $id = $request->get('id');

        if ($id == 1) {
            $data = $power->select(DB::raw('powers.id, power_name, pid, if(1, "true", "false") as is_power'))->get();
        } else {
            $data = $power->rolePower($id);
        }
        $data = $this->treenChildren($data->toArray());

        return view('role.admin-role-update', ['powers' => $data, 'id' => $id]);
    }

    /**
     * 修改角色权限分配
     *
     * @return void
     */
    public function rolePowerSave(Request $request)
    {
        // 获取id
        $ids = $request->post('id'); // 权限id
        $role_id = $request->post('role_id'); // 角色id
        // 查询是否有该权限
        $powers = Power::whereIn('id', $ids)->get();
        $powers = $powers->toArray();
        // 将所有的权限pid获取出来
        $pids = array_column($powers, 'pid');
        // 判断是否有顶级权限
        if (!in_array(0, $pids)) {
            return $this->fail('数据非法：未选择顶级权限', 0);
        }
        $data = [];
        // 循环判断子节点是否有父节点
        foreach ($powers as $power) {
            if (!in_array($power['pid'], $ids) and $power['pid'] != 0) {
                return $this->fail('数据有误', 0);
            }
            $data[] = [
                'role_id' => $role_id,
                'power_id' => $power['id']
            ];
        }
        try {
            // 修改角色权限
            RolePower::updatePower($data, $role_id);
        } catch (Exception $e) {
            return $this->fail($e->getMessage(), $e->getCode());
        }

        return $this->success([], '修改成功');
    }
}
