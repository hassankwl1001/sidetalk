<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class SendRequestEvent implements ShouldBroadcastNow
{
  use Dispatchable, InteractsWithSockets, SerializesModels;

  public $notification;

  public function __construct($notification)
  {
      $this->notification = $notification;
  }

  public function broadcastOn()
  {
      return ['skilledtalk'];
  }

  public function broadcastAs()
  {
      return 'sendRequest';
  }

}
