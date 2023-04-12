<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class GeneralEvent implements ShouldBroadcastNow
{
  use Dispatchable, InteractsWithSockets, SerializesModels;

  public $data;
  public $event;

  public function __construct($data, $event)
  {
      $this->data = $data;
      $this->event = $event;
  }

  public function broadcastOn()
  {
      return ['skilledtalk'];
  }

  public function broadcastAs()
  {
      return $this->event;
  }

}
