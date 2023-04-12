<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserEbank extends Model
{
    use HasFactory;

    protected $table = 'user_ebank_mail';

    protected $fillable = [
        'user_id',
        'ebank_id',
        'email'
    ];

    public function ebank(){
        return $this->belongsTo(Ebank::class, 'ebank_id', 'id');
    }
}
