<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Power;
use App\Models\RolePower;
use Exception;
use Illuminate\Support\Facades\DB;

class PowerController extends Controller
{
    /**
     * 渲染权限列表
     *
     * @return void
     */
    public function power(Request $request)
    {
        $h = $request->get('h');

        $power = Power::when($h, function ($query) use ($h) {
            $query->where("power_name", "like", "%$h%");
        })->get();

        $data = $this->treen($power->toArray());

        return view('power.admin-permission', ['powers' => $data, 'h' => $h ?? '']);
    }

    /**
     * 权限添加页面
     *
     * @return void
     */
    public function powerAdd(Request $request)
    {
        $id = $request->get('id') ?? '';

        if (!empty($id)) {
            $data = Power::find($id);
        }

        $power = Power::all();

        $power = $this->treen($power);

        return view('power.admin-permission-add', ['powers' => $power, 'data' => $data ?? null]);
    }

    /**
     * 权限添加功能
     *
     * @return void
     */
    public function powerSave(Request $request, Power $power)
    {
        $validated = $request->validate([
            'power_name' => ['required', 'unique:powers,power_name'],
            'pid' => ['required'],
            'route_name' => ['required'],
            'is_show' => []
        ]);
        try {
            $power->powerAdd($validated);
        } catch (Exception $e) {
            return $this->fail($e->getMessage(), $e->getCode());
        }

        return $this->success([], 'ok');
    }

    /**
     * 权限修改功能
     *
     * @return void
     */
    public function powerUpdate(Request $request, Power $power)
    {
        $validated = $request->validate([
            'id' => ['required'],
            'power_name' => ['required'],
            'pid' => ['required'],
            'route_name' => ['required'],
            'is_show' => []
        ]);

        try {
            $power->powerAlter($validated);
        } catch (Exception $e) {
            return $this->fail($e->getMessage(), $e->getCode());
        }

        return $this->success([], 'ok');
    }

    /**
     * 权限删除功能
     *
     * @return void
     */
    public function powerDelete(Request $request)
    {
        $id = $request->all('id')['id'];
        $id = is_array($id) ? $id : [$id];
        // 验证参数
        if (empty($id)) {
            return $this->fail('参数错误', 1001);
        }

        try {
            // 如果权限表中有pid为该权限主键则不删除
            Power::whereIn('pid', $id)->firstOr(function () use ($id) {
                DB::transaction(function () use ($id) {
                    Power::destroy($id);
                    RolePower::whereIn('power_id', $id)->delete();
                });
            }) ? abort(0, '无法删除，因为：该权限下还有子权限') : null;
        } catch (Exception $e) {
            return $this->fail($e->getMessage(), $e->getCode());
        }

        return $this->success([], 'ok');
    }
}
