<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fang extends Model
{
    use HasFactory, BtnShow;

    protected $guarded = [];

    public function owner() {
        return $this->belongsTo(Owner::class, 'fang_owner');
    }

    public function fangUpdate($data) {
        $model = $this->find($data['id']);
        
        $model->fang_name = $data['fang_name'];
        $model->fang_addr = $data['fang_addr'];
        $model->fang_xiaoqu = $data['fang_xiaoqu'];
        $model->fang_rent = $data['fang_rent'];
        $model->fang_floor = $data['fang_floor'];
        $model->fang_rent_type = $data['fang_rent_type'];
        $model->fang_shi = $data['fang_shi'];
        $model->fang_ting = $data['fang_ting'];
        $model->fang_wei = $data['fang_wei'];
        $model->fang_direction = $data['fang_direction'];
        $model->fang_rent_class = $data['fang_rent_class'];
        $model->fang_build_area = $data['fang_build_area'];
        $model->fang_using_area = $data['fang_using_area'];
        $model->fang_year = $data['fang_year'];
        $model->fang_config = $data['fang_config'];
        $data['fang_pic']? $model->fang_pic = $data['fang_pic']: '';
        $model->fang_owner = $data['fang_owner'];
        $model->is_recommend = $data['is_recommend'];
        $model->fang_desn = $data['fang_desn'];
        $model->fang_body = $data['fang_body'];
        $model->fang_province = $data['fang_province'];
        $model->fang_city = $data['fang_city'];
        $model->fang_region = $data['fang_region'];

        $model->save();
    }

    public function getFangPicAttribute($key) {
        return config('url.domain') . $this->attributes['fang_pic'];
    }
}
