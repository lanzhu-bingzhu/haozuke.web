<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Stmt\Static_;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['role_name', 'role_desc'];

    public function admin() {
        return $this->hasMany(Admin::class, 'role_id');
    }

    /**
     * 修改角色信息
     *
     * @param array $data
     * @return void
     */
    public static function roleUpdate($data) {
        $model = self::find($data['id']);
        // 更新角色表信息
        $model->role_name = $data['role_name'];
        $model->role_desc = $data['role_desc'];
        // 执行更改
        return $model->save();
    }
}
