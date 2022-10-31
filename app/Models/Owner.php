<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    use HasFactory;

    /**
     * 更新房东数据
     *
     * @param array $data
     * @param integer $id
     * @return void
     */
    public function ownerUpdate($data, $id) {
        $model = Owner::find($id);
        
        $model->name = $data['name'];
        $model->sex = $data['sex'];
        $model->age = $data['age'];
        $model->phone  = $data['phone'];
        $model->email = $data['email'];
        $model->card = $data['card'];
        $model->address = $data['address'];
        !empty($data['pic'])? $model->pic = $data['pic']: null;
        
        return $model->save();
    }
}
