<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $table = 'company';

    protected $fillable = [
        'name',
        'is_active',
        'user_id'
    ];


    public function users(){
        return $this->belongsTo(User::class, 'company_id');
    }
}
