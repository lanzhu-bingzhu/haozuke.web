<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Fang;
use App\Models\Fangattr;
use Exception;
use Illuminate\Http\Request;

class FangController extends Controller
{
    /**
     * 获取房源列表
     *
     * @param Request $request
     * @return void
     */
    public function index(Request $request) {
        $field = [
            'id', 'fang_name', 'fang_pic', 'fang_shi', 'fang_ting', 'fang_rent', 'fang_build_area'
        ];

        $data = Fang::select($field)->paginate(2);

        return $this->success($data);
    }

    /**
     * 获取首页推荐房源
     *
     * @param Request $request
     * @return void
     */
    public function recommend(Request $request) {
        $data = Fang::where('is_recommend', '1')->orderBy('id', 'desc')->limit(5)->get(['id', 'fang_name', 'fang_pic']);

        if (empty($data)) {
            return $this->fail('数据为空', 0);
        }

        return $this->success($data);
    }
    
    /**
     * 获取租房小组
     *
     * @param Request $request
     * @return void
     */
    public function attr(Request $request) {
        $field_name = $request->get('field');

        try {
            $id = Fangattr::where('field_name', $field_name)->value('id');
        } catch (Exception $e) {
            return $this->fail($e->getMessage(), $e->getCode());
        }
        
        if (empty($id)) {
            return $this->fail('没有数据', 0);
        }
        
        $data = Fangattr::where('pid', $id)->limit(4)->get(['id', 'name', 'icon']);
        
        return $this->success($data);
    }

    /**
     * 房源详情
     *
     * @param Request $request
     * @return void
     */
    public function details(Request $request) {
        $id = $request->get('id');

        if (empty($id) and !is_numeric($id)) {
            return $this->fail('参数错误,请重新输入', 0);
        }

        $fang = Fang::find($id);
        // 获取房东
        $owner = $fang->owner;
        // 获取房屋配置
        $fang_config = explode(',', $fang->fang_config);
        $fang->fang_config = Fangattr::whereIn('id', $fang_config)->get(['id', 'name', 'icon']);
        // 获取房屋朝向
        $fang->fang_direction = Fangattr::where('id', $fang->fang_direction)->value('name');

        return $this->success($fang);
    }
}
