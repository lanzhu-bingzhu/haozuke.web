<?php
namespace App\Http\Business;

use App\Models\City;
use App\Models\Fang;
use App\Models\Fangattr;
use App\Models\Owner;

class FangBusiness
{
    /**
     * 表单关系数据渲染
     *
     * @return array
     */
    public function relationData() {
        // 业主
        $owners = Owner::all();
        // 地区
        $city = City::where('pid', 0)->get();
        // 租期方式
        $rent_type_id = Fangattr::where('field_name', 'fang_rent_type')->value('id');
        $rent_type_data = Fangattr::where('pid', $rent_type_id)->get();
        // 朝向
        $direction_id = Fangattr::where('field_name', 'fang_direction')->value('id');
        $direction_data = Fangattr::where('pid', $direction_id)->get();
        // 租赁方式
        $rent_class_id = Fangattr::where('field_name', 'fang_rent_class')->value('id');
        $rent_class_data = Fangattr::where('pid', $rent_class_id)->get();
        // 配套设施
        $config_id = Fangattr::where('field_name', 'fang_config')->value('id');
        $config_data = Fangattr::where('pid', $config_id)->get();

        return [
            'rent_type_data' => $rent_type_data,
            'direction_data' => $direction_data,
            'rent_class_data' => $rent_class_data,
            'config_data' => $config_data,
            'owners' => $owners,
            'city' => $city
        ];
    }

    /**
     * 获取经纬度
     *
     * @param string $address
     * @return string
     */
    public function map($address) {
        $url = "https://restapi.amap.com/v3/geocode/geo?key=". config('mapkey.key') ."&address=" . $address;

        $data = file_get_contents($url);

        $data = json_decode($data, true);

        $data = explode(',', $data['geocodes'][0]['location']);

        return $data;
    }
}