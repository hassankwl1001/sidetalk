<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    use HasFactory;

    protected $fillable = [
           'user_id',
           'user_ebank_mail_id',
            'price',
           'is_approved',
           'declined_reason',
    ];

    public function userEbank(){
         return $this->belongsTo(UserEbank::class, 'user_ebank_mail_id', 'id');
    }
}
