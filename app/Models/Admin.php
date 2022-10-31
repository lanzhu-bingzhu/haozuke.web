<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User;
use Laravel\Passport\HasApiTokens;

class Admin extends User
{
    use HasFactory, BtnShow, SoftDeletes, HasApiTokens;

    protected $fillable = ['username', 'password', 'phone', 'email', 'sex', 'desc', 'role_id'];

    public function role() {
        return $this->belongsTo(Role::class);
    }

    /**
     * 修改管理员信息
     *
     * @param array $data
     * @return boolean
     */
    public static function adminUpdate($data) {
        $model = self::find($data['id']);
        // 更新管理员表信息
        $model->username = $data['username'];
        $model->sex = $data['sex'];
        $model->phone = $data['phone'];
        $model->email = $data['email'];
        $model->desc = $data['desc'];
        $model->role_id = $data['role_id'];
        // 执行更改
        return $model->save();
    }

    public function setPassWordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
}
