<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Power extends Model
{
    use HasFactory;

    public function role_powers() {
        return $this->belongsToMany(Role::class, 'role_powers', 'power_id', 'role_id');
    }

    public function rolePower($id)
    {
        return $this->select(DB::raw('powers.id, power_name,pid, if((select count(*) from role_powers where role_powers.power_id = powers.id and role_id = '.$id.') = 0, "false", "true") as is_power'))
            ->leftJoin('role_powers', 'powers.id', '=', 'role_powers.power_id')
            ->leftJoin('roles', 'roles.id', '=', 'role_powers.role_id')
            ->get();
    }

    /**
     * 权限添加
     *
     * @param array $data
     * @return void
     */
    public function powerAdd($data) {
        $model = new Power();
        $model->power_name = $data['power_name'];
        $model->pid = $data['pid'];
        $model->route_name = $data['route_name'];
        $model->is_show = empty($data['is_show'])? '0': '1';
        return $model->save();
    }

    /**
     * 权限修改
     *
     * @param array $data
     * @return void
     */
    public function powerAlter($data) {
        $model = Power::find($data['id']);
        $model->power_name = $data['power_name'];
        $model->pid = $data['pid'];
        $model->route_name = $data['route_name'];
        $model->is_show = empty($data['is_show']) ? '0' : '1';
        return $model->save();
    }
}
