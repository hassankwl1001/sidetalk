<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ebank extends Model
{
    use HasFactory;

    protected $table = 'ebank';

    protected $fillable = [
        'ebank_name',
        'ebank_icon'
    ];
}
