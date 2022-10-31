<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RolePower extends Model
{
    use HasFactory;

    protected $fillable = ['role_id', 'power_id'];

    /**
     * 修改角色权限
     *
     * @param array $array
     * @param integer $id
     * @return void
     */
    public static function updatePower($array, $id)
    {
        return DB::transaction(function () use ($array, $id) {
            self::where('role_id', $id)->delete();
            self::insert($array);
        });
    }
}
