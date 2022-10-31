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
}
