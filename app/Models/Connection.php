<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Connection extends Model
{
    use HasFactory;

    protected $table = 'connections';

    protected $fillable = [
        'send_to',
        'send_from'
    ];

    public function messages(){
        return $this->hasMany(Message::class, 'connection_id', 'id');
    }

    public function sender(){
        return $this->belongsTo(User::class, 'send_from', 'id');
    }

    public function receiver(){
        return $this->belongsTo(User::class, 'send_to', 'id');
    }
}
