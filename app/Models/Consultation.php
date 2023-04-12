<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    use HasFactory;

    protected $table = 'consultations';

    protected $fillable = [
        'consult_from',
        'consult_with',
        'consult_type',
        'desc',
        'attachment',
        'date',
        'time',
        'is_accepted',
        'meeting_id',
        'session_price',
        'skilled_talk_percentage',
        'actual_payment_earned'
    ];

    public function consultFrom(){
        return $this->belongsTo(User::class, 'consult_from', 'id');
    }

    public function consultWith(){
        return $this->belongsTo(User::class, 'consult_with', 'id');
    }
}
