<?php

namespace App\Http\Livewire;

use App\Models\Connection;
use App\Repositories\ChatRepository\iChatRepository;
use App\Repositories\Stripe\iStripeRepository;
use Livewire\Component;

class ConversationList extends Component
{
    public $chat;
    public $conversations;


    public function render()
    {

        $this->conversations = Connection::with([
            'sender' => function ($query) {
                $query->select('id', 'firstname', 'lastname', 'profile_pic')->where('id', '!=', auth()->user()->id);
            },
            'receiver' => function ($query) {
                $query->select('id', 'firstname', 'lastname', 'profile_pic')->where('id', '!=', auth()->user()->id);
            },
            'messages' => function ($query) {
                $query->orderBy('id', 'desc');
            }
        ])
            ->where('send_from', auth()->user()->id)
            ->orwhere('send_to', auth()->user()->id)
            ->orderBy('updated_at', 'DESC')
            ->get()
            ->map(function ($query) {
                $query->setRelation('messages', $query->messages->take(1));
                return $query;
            });

        return view('livewire.conversation-list');
    }
}
