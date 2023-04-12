<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $table = 'pages';

    protected $fillable = [
       'user_id',
        'page_type_id',
       'name',
       'public_url',
       'website',
       'industry',
       'company_size',
       'company_type',
       'logo',
       'banner',
       'about',
       'tagline',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
//    public function pageUser(){
//        return $this->belongsToMany(User::class, 'page_followers', 'page_id', 'user_id')
//            ->withTimestamps()->withPivot('user_id', 'page_id')->where('user_id', auth()->id());
//    }


    public function pageUser(){
        return $this->belongsToMany(User::class, 'page_followers', 'page_id', 'user_id')
            ->withTimestamps()->withPivot('user_id', 'page_id');
    }


}
