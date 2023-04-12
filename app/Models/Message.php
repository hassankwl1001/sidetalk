<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Message extends Model
{
    use HasFactory;

    protected $table = 'messages';

    protected $fillable = [
        'connection_id',
        'send_from',
        'send_to',
        'type',
        'text',
        'meeting_id',
        'transaction_id'
    ];

    public function sender(){
        return $this->belongsTo(User::class, 'send_from', 'id');
    }

    public function receiver(){
        return $this->belongsTo(User::class, 'send_to', 'id');
    }

    public function consultation(){
        return $this->hasOne(Consultation::class, 'meeting_id', 'meeting_id');
    }


   /**
     * Get the user's first name.
     *
     * @param  string  $value
     * @return string
     */
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->diffForHumans();
    }

}
