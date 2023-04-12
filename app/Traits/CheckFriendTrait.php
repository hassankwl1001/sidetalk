<?php

namespace App\Traits;

use App\Models\Friend;
use Illuminate\Http\Request;

trait CheckFriendTrait
{
    public function is_friend($user1, $user2){

        return Friend::where(['request_from' => $user1, 'request_to' => $user2])

            ->orwhere(function ($query) use ($user1, $user2) {
                $query->where(['request_from' => $user2, 'request_to' => $user1]);
            })

            ->first();
    }
}
