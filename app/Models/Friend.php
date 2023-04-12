<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    use HasFactory;

    protected $table = 'friends';

    protected $fillable = [
           'request_from',
           'request_to',
           'is_accepted',
    ];

    public function sender(){
        return $this->belongsTo(User::class, 'request_from', 'id');
    }
    public function receiver(){
        return $this->belongsTo(User::class, 'request_to', 'id');
    }

}
