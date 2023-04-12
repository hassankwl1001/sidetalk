<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostPrivacy extends Model
{
    use HasFactory;
    protected $table = 'post_privacy';

    protected $fillable =  [
        'name'
    ];

    public $timestamps = false;
}
