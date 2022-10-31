<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use HasFactory, SoftDeletes, BtnShow;

    /**
     * 文章添加
     *
     * @param array $data
     * @return void
     */
    public static function articleCreate($data) {
        $model = (new Article());
        $model->title = $data['title'];
        $model->desc = $data['desc'];
        $model->author = $data['author'];
        $model->pic = $data['pic'];
        $model->body = $data['body'];
        return $model->save();
    }

    /**
     * 文章修改
     *
     * @param array $data
     * @param integer $id
     * @return void
     */
    public static function articleUpdate($data, $id) {
        $model = self::find($id);
        $model->title = $data['title'];
        $model->desc = $data['desc'];
        $model->author = $data['author'];
        empty($data['pic'])?:$model->pic = $data['pic'];
        $model->body = $data['body'];
        return $model->save();
    }
}
