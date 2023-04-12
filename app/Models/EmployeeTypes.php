<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeTypes extends Model
{
    use HasFactory;

    protected $table = 'employee_types';

    protected $fillable = [
        'name'
    ];

    public $timestamps = false;

    public function users(){
        return $this->hasMany(User::class, 'employee_types_id');
    }
}
