<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fangattr extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * 房源规属性添加
     *
     * @param array $data
     * @return void
     */
    public function attrAdd($data) {
        $model = new Fangattr();
        $model->pid = $data['pid'];
        $model->name = $data['name'];
        $model->field_name = $data['field_name'];
        $model->icon = $data['icon'];
        return $model->save();
    }

    /**
     * 房源属性修改
     *
     * @param array $data
     * @return void
     */
    public function attrUpdate($data) {
        $model = Fangattr::find($data['id']);
        $model->pid = $data['pid'];
        $model->name = $data['name'];
        $model->field_name = $data['field_name'];
        if (!empty($data['icon'])) {
            $model->icon = $data['icon'];
        }
        return $model->save();
    }
}
