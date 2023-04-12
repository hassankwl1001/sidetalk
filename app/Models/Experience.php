<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;

    protected $table = 'experiences';

    protected $fillable = [
      'user_id',
      'title',
      'employee_type_id',
      'company',
      'start_date',
      'end_date',
      'responsibility',
      'location',
        'currently_working'
    ];
}
