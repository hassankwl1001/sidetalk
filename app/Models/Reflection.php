<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reflection extends Model
{
    use HasFactory;

    protected $table = 'reflections';

    protected $fillable = [
      'user_id',
      'post_id',
      'reflection_id',
      'reflection',
    ];

    public function user(){
      return $this->belongsTo(User::class);
    }
//    public function post(){
//        return $this->hasMany(Posts::class,'post_id','id');
//    }

    public function post(){
        return $this->belongsTo(Posts::class,'post_id','id');
    }

}
