<?php

namespace App\Http\Controllers;

use App\Http\Requests\OwnerPostRequest;
use App\Http\Requests\OwnerUpdateRequest;
use App\Models\Owner;
use Exception;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
    /**
     * 房东列表页面
     *
     * @param Request $request
     * @return void
     */
    public function index(Request $request) {
        $h = $request->get('h')?? '';
        
        $owners = Owner::when($h, function ($query) use ($h) {
            return $query->where('name', 'like', "%$h%");
        })->get();

        return view('owner.owner-list', ['owners' => $owners]);
    }

    /**
     * 房东添加页面
     *
     * @return void
     */
    public function create(Request $request) {
        $id = $request->get('id');
        if (!empty($id) && is_numeric($id)) {
            $data = Owner::find($id);
        }

        return view('owner.owner-add', ['owner' => $data??null]);
    }

    /**
     * 房东信息添加
     *
     * @param OwnerPostRequest $request
     * @return void
     */
    public function save(OwnerPostRequest $request) {
        $validated = $request->validated();
        try {
            // 文件上传
            $validated['pic'] = $request->file('pic')->store('', 'owner');
            // 房东信息添加
            Owner::insert($validated);
        } catch (Exception $e) {
            return $this->fail($e->getMessage(), $e->getCode());
        }

        return $this->success([], '添加成功');
    }

    /**
     * 修改房东数据
     *
     * @param OwnerUpdateRequest $request
     * @param Owner $owner
     * @return void
     */
    public function update(OwnerUpdateRequest $request, Owner $owner) {
        $validated = $request->validated();
        try {
            // 文件上传
            if (!empty($validated['pic'])) {
                $validated['pic'] = $request->file('pic')->store('', 'owner');
            }
            // 修改房东信息
            $owner->ownerUpdate($validated, $validated['id']);
        } catch (Exception $e) {
            return $this->fail($e->getMessage(), $e->getCode());
        }
    }

    /**
     * 删除房东信息
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
            // 删除房东信息
            Owner::destroy($id);
        } catch (Exception $e) {
            return $this->fail($e->getMessage(), $e->getCode());
        }

        return $this->success([], 'ok');
    }
}
