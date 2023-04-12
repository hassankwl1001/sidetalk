<?php

namespace App\Traits;

use App\Models\Friend;
use App\Models\Notification;
use Illuminate\Http\Request;

trait NotificationTrait
{
    public function storeNotification(array $data){
        Notification::create($data);
        return 1;
    }
}
