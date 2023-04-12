<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $table = 'notifications';

    protected $fillable = [
        'user_id',
        'other_user_id',
        'text',
        'is_read',
        'url'
    ];

    protected $appends = ['notification_time'];

    public function otherUser(){
        return $this->belongsTo(User::class, 'other_user_id', 'id');
    }

        /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getNotificationTimeAttribute()
    {
        return $this->created_at->diffForHumans();
    }
}
