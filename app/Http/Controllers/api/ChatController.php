<?php

namespace App\Http\Controllers\api;

use App\Events\NewMessageEvent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\ChatRepository\iChatRepository;
use App\Repositories\Stripe\iStripeRepository;


class ChatController extends Controller
{

    private $chat;
    private $stripe;

    public function __construct(iChatRepository $chat, iStripeRepository $stripe)
    {
        $this->chat = $chat;
        $this->stripe = $stripe;
    }

    public function inbox(){

        $profileUrl = env('PROFILE_URL');

        $conversations = $this->chat->getConversationsList();

        return response()->success(1, 'list of conversations', ['profile_url' => $profileUrl, 'conversations' => $conversations]);
    }

    public function getConversationMessages(Request $request){
        $request->validate([
            'user_id'   =>  'required'
        ]);

        $connection = $this->chat->getConnection(auth()->id(), $request->user_id);

        if($connection == '' || $connection == null){
           return response()->error(0, null, 'No conversation found');
        }else{
            $url = env('MEETING_ATTACHMENTS');
            $conversation = $this->chat->getConversationMessages($connection->id);
            return response()->success(1, 'conversation list', ['conversation' => $conversation, 'meeting_attachment_url' => $url]);
        }

    }

    public function sendMessage(Request $request){
        $message = $this->chat->sendMessage($request);
        event(new NewMessageEvent($message));
        if($message){
            return response()->json(['ResponseCode' => 1, 'ResponseMessage' => 'message sent', 'data' => $message], 200);
        }
    }
}
