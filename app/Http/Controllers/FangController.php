<?php

namespace App\Http\Controllers;

use App\Http\Business\FangBusiness;
use App\Http\Requests\FangCreateRequest;
use App\Http\Requests\FangUpdateRequest;
use App\Models\City;
use App\Models\Fang;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class FangController extends Controller
{
    /**
     * 房源列表页面
     *
     * @param Request $request
     * @return void
     */
    public function index(Request $request) {
        $h = $request->get('h') ?? '';

        $data = Fang::when($h, function ($query) use ($h) {
            return $query->where('name', 'like', "%$h%");
        })->with(['owner'])->get();

        $data = $this->treen($data);

        return view('fang.fang-list', ['fang' => $data, 'h' => $h ?? null]);
    }

    /**
     * 房源添加页面
     *
     * @param Request $request
     * @param FangBusiness $fang
     * @return void
     */
    public function create(Request $request, FangBusiness $fang) {
        $id = $request->get('id');
        if (!empty($id) || is_numeric($id)) {
            $model = Fang::find($id);
            $model->fang_config = explode(',', $model->fang_config);
            $fang_city = City::where('pid', $model->fang_province)->get();
            $fang_region = City::where('pid', $model->fang_region)->get();
        }

        $data = $fang->relationData();

        return view('fang.fang-add', ['data' => $data, 'fang' => $model??null, 'city' => $fang_city??null, 'region' => $fang_region??null]);
    }

    /**
     * 添加房源信息
     *
     * @param FangCreateRequest $request
     * @return void
     */
    public function save(FangCreateRequest $request, FangBusiness $fang) {
        $validated = $request->validated();

        try {
            $data = $fang->map($validated['fang_addr']);
            // 获取经纬度
            $validated['latitude'] = $data[1];
            $validated['longitude'] = $data[0];

            $validated['fang_config'] = implode(',', $validated['fang_config']);
            // 文件上传
            $validated['fang_pic'] =  "/upload/fang/" . $request->file('fang_pic')->store('', 'fang');
            // 添加到数据库
            Fang::create($validated);
        } catch (Exception $e) {
            return $this->fail($e->getMessage(), $e->getCode());
        }

        return $this->success([], 'ok');
    }
    
    /**
     * 修改房源信息
     *
     * @param FangUpdateRequest $request
     * @param FangBusiness $fangBusiness
     * @param Fang $fang
     * @return void
     */
    public function update(FangUpdateRequest $request, FangBusiness $fangBusiness, Fang $fang) {
        $validated = $request->validated();

        try {
            $data = $fangBusiness->map($validated['fang_addr']);
            // 获取经纬度
            $validated['latitude'] = $data[1];
            $validated['longitude'] = $data[0];

            $validated['fang_config'] = implode(',', $validated['fang_config']);
            if (!empty($validated['pic'])) {
                // 文件上传
                $validated['fang_pic'] =  "/upload/article/" . $request->file('fang_pic')->store('', 'fang');
            }
            // 修改房源信息
            $fang->fangUpdate($validated);
        } catch (Exception $e) {
            return $this->fail($e->getMessage(), $e->getCode());
        }

        return $this->success();
    }

    /**
     * 删除房源信息
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
            $res = Fang::whereIn('id', $id)->where([
                ['updated_at', '<', date('Y-m-d', strtotime('-6 day'))],
                ['fang_status', '=', '1']
            ])->delete();

            if (!$res) {
                abort(0, '删除失败');
            }
        } catch (Exception $e) {
            return $this->fail($e->getMessage(), $e->getCode());
        }

        return $this->success([], 'ok');
    }

    /**
     * 省市区多级联动
     *
     * @param Request $request
     * @return void
     */
    public function city(Request $request) {
        $id = $request->get('id');
        if (empty($id) || !is_numeric($id)) {
            return $this->fail('参数错误', 1001);
        }

        try {
            $data = City::where('pid', $id)->get();
        } catch (Exception $e) {
            return $this->fail($e->getMessage(), $e->getCode());
        }

        return $this->success($data);
    }

    /**
     * 富文本文件上传接口
     *
     * @return void
     */
    public function imageUpload(Request $request)
    {
        // 验证上传文件信息
        $file = $request->file();

        if (empty($file)) {
            return $this->fail('没有上传文件', 0);
        }

        // 文件上传
        $path = [];
        foreach ($file as $val) {
            $path[]['url'] = "/upload/fang/" . Storage::disk('fang')->put('', $val);
        }

        return ['errno' => 0, 'data' => $path];
    }

    public function chart() {
        //近7天
        $shijian = [
            date('Y-m-d', strtotime('-6 day')),
            date('Y-m-d', strtotime('-5 day')),
            date('Y-m-d', strtotime('-4 day')),
            date('Y-m-d', strtotime('-3 day')),
            date('Y-m-d', strtotime('-2 day')),
            date('Y-m-d', strtotime('-1 day')),
            date('Y-m-d')
        ];

        $data = Fang::select(DB::raw("DATE_FORMAT(created_at, '%Y%-%m-%d') days, count(*) as num"))
            ->whereRaw("DATE_SUB(CURTIME(), INTERVAL 14 DAY) <= date(created_at) and fang_status = 0")
            ->groupByRaw("days")
            ->get();

        $data = $data? $data->toArray(): null;

        $arr = [];
        foreach ($shijian as $k => $v) {
            foreach ($data as $val) {
                if ($v == $val['days']) {
                    $arr[$k]['days'] = $v;
                    $arr[$k]['num'] = $val['num'];
                    break;
                } else {
                    $arr[$k]['days'] = $v;
                    $arr[$k]['num'] = 0;
                }
            }
        }

        return view('fang.fang-chart', ['time' => $arr]);
    }

    /**
     * 房源租出状态修改
     *
     * @param Request $request
     * @return void
     */
    public function status(Request $request) {
        $id = $request->get('id');
        if (empty($id) || !is_numeric($id)) {
            return $this->fail('参数错误', 1001);
        }

        try {
            $model = Fang::find($id);
            $model->fang_status == '0'? $model->fang_status = '1': $model->fang_status = '0';
            $model->save();
        } catch (Exception $e) {
            return $this->fail($e->getMessage(), $e->getCode());
        }

        return $this->success();
    }
}
