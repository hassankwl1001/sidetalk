<?php

namespace App\Http\Livewire;

use App\Models\Friend;
use Livewire\Component;

class FriendsList extends Component
{
    public function render()
    {
         $friends=Friend::with('sender')->where('request_to',auth()->id())->get();
        return view('livewire.friends-list');
    }
}
