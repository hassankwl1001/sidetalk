<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndustryTypes extends Model
{
    use HasFactory;

    protected $table = 'industry_types';

    protected $fillable = [
        'name',
        'is_active',
        'user_id'
    ];


    public function users(){
        return $this->belongsTo(User::class, 'industry_type_id');
    }
}
