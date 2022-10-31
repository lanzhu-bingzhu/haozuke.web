<?php

namespace App\Http\Controllers;

use App\Models\Fangattr;
use Exception;
use Illuminate\Http\Request;

class FangattrController extends Controller
{
    /**
     * 房源属性列表页面
     *
     * @param Request $request
     * @return void
     */
    public function index(Request $request) {
        $h = $request->get('h') ?? '';

        $data = Fangattr::when($h, function ($query) use ($h) {
            return $query->where('name', 'like', "%$h%");
        })->get();

        $data = $this->treen($data);
        
        return view('fangattr.fangattr-list', ['fangattrs' => $data,'h' => $h ?? null]);
    }

    /**
     * 房源属性添加页面
     *
     * @param Request $request
     * @return void
     */
    public function create(Request $request) {
        $id = $request->get('id') ?? '';

        if (!empty($id)) {
            $data = Fangattr::find($id);
        }

        $attr = Fangattr::where('pid', 0)->get();

        return view('fangattr.fangattr-add', ['data' => $data ?? null, 'attr' => $attr]);
    }

    /**
     * 房源属性添加
     *
     * @param Request $request
     * @param Fangattr $fangattr
     * @return void
     */
    public function save(Request $request, Fangattr $fangattr) {
        $validated = $request->validate([
            'pid' => ['required'],
            'field_name' => ['required'],
            'icon' => ['required'],
            'name' => ['required']
        ]);

        try {
            // 文件上传
            $validated['icon'] = $request->file('icon')->store('', 'fangattr-icon');

            // 调用模型添加方法
            $fangattr->attrAdd($validated);
        } catch (Exception $e) {
            return $this->fail($e->getMessage(), $e->getCode());
        }

        return $this->success([], 'ok');
    }

    /**
     * 房源属性修改
     *
     * @param Request $request
     * @param Fangattr $fangattr
     * @return void
     */
    public function update(Request $request, Fangattr $fangattr) {
        $validated = $request->validate([
            'id' => ['required'],
            'pid' => ['required'],
            'field_name' => ['required'],
            'icon' => [''],
            'name' => ['required']
        ]);

        // 验证参数
        if (empty($validated['id']) && !is_numeric($validated['id'])) {
            return $this->fail('参数错误', 1001);
        }

        try {
            if (!empty($validated['icon'])) {
                // 文件上传
                $validated['icon'] = $request->file('icon')->store('', 'fangattr-icon');
            }

            // 调用模型添加方法
            $fangattr->attrUpdate($validated);
        } catch (Exception $e) {
            return $this->fail($e->getMessage(), $e->getCode());
        }

        return $this->success([], 'ok');
    }

    /**
     * 房源属性删除
     *
     * @param Request $request
     * @return void
     */
    public function delete(Request $request) {
        $id = $request->all('id')['id'];
        $id = is_array($id) ? $id : [$id];
        // 验证参数
        if (empty($id)) {
            return $this->fail('参数错误', 1001);
        }

        try {
            Fangattr::whereIn('pid', $id)->firstOr(function () use ($id) {
                Fangattr::destroy($id);
            }) ? abort(0, '无法删除，因为：该规格下还有子规格') : null;
        } catch (Exception $e) {
            return $this->fail($e->getMessage(), $e->getCode());
        }

        return $this->success([], 'ok');
    }
}
