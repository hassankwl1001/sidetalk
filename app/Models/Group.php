<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $table = 'groups';

    protected $fillable = [
        'name',
        'about',
        'profile_pic',
        'banner'
    ];

    public function members(){
        return $this->belongsToMany(User::class, 'group_users', 'group_id', 'user_id')
        ->withTimestamps()->withPivot('user_id', 'group_id');
    }

    public function groupUser(){
        return $this->belongsToMany(User::class, 'group_users', 'group_id', 'user_id')
        ->withTimestamps()->withPivot('user_id', 'group_id')
        ->where('user_id', auth()->id());
    }

    public function groupAdmins(){
        return $this->belongsToMany(User::class, 'group_users', 'group_id', 'user_id')
        ->withTimestamps()->withPivot('user_id', 'group_id')
        ->where('is_admin', 1);
    }
}
