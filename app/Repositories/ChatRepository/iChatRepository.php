<?php

namespace App\Repositories\ChatRepository;

use App\Http\Requests\AudioUploadRequest;
use Illuminate\Http\Request;

interface iChatRepository {

    public function sendMessage(Request $request);
    public function getConversationsList();
    public function getConversationMessages($connection_id);
    public function readAll($connection_id);
    // public function getAccessToken(Request $request);
    public function getVideoAccessToken($meeting_id);
    public function getConnection($sender_id, $receiver_id);
}
