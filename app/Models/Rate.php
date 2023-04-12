<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    use HasFactory;

    protected $table = 'rates';
    protected $fillable = [
        'post_id',
        'user_id',
        'stars'
    ];

//    public function post(){
//        return $this->hasMany(Posts::class,'post_id','id');
//    }

    public function post(){
        return $this->belongsTo(Posts::class,'post_id','id');
    }
}
