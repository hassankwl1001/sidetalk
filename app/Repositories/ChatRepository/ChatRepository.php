<?php

namespace App\Repositories\ChatRepository;

use App\Repositories\ChatRepository\iChatRepository;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Connection;
use App\Traits\FileUploadTrait;
use App\Traits\MakePaginationTrait;
use Twilio\Jwt\AccessToken;
use Twilio\Jwt\Grants\VideoGrant;
class ChatRepository implements iChatRepository
{

    use FileUploadTrait, MakePaginationTrait;

    public function sendMessage(Request $request)
    {
        $request->validate([
            'send_to'       =>  'exists:users,id|required',
             'type'          =>  'string|max:15|min:4|required',
             'text'          =>  'string|max:500|required|nullable|sometimes',
             'file'        =>  'required|sometimes|max:20480',
        ]);

        $request['send_from'] = auth()->user()->id;

        $connection = $this->getConnection($request->send_from, $request->send_to);


        if (!$connection) {
            $connection = $this->createConnection($request->send_from, $request->send_to, 0);
        }

        $request['connection_id'] = $connection->id;

        $message = Message::create($request->all());

        return $message;
    }

    public function getConversationsList()
    {

        $conversations = Connection::with([
            'sender' => function ($query) {
                $query->select('id', 'firstname', 'lastname', 'profile_pic', 'current_position', 'experience', 'job_title')->where('id', '!=', auth()->user()->id);
            },
            'receiver' => function ($query) {
                $query->select('id', 'firstname', 'lastname', 'profile_pic', 'current_position', 'experience', 'job_title')->where('id', '!=', auth()->user()->id);
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

        return $this->paginate($conversations);
    }

    public function getConversationMessages($connection_id)
    {
        $messages = Message::with('consultation')->where('connection_id', $connection_id)->orderBy('created_at', 'ASC')->paginate(100);
        return $messages;
    }

    public function getConnection($sender_id, $receiver_id)
    {

        return Connection::where(['send_from' => $sender_id, 'send_to' => $receiver_id])

            ->orwhere(function ($query) use ($sender_id, $receiver_id) {
                $query->where(['send_from' => $receiver_id, 'send_to' => $sender_id]);
            })
            ->first();
    }

    public function createConnection($sender_id, $receiver_id, $is_direct_reply)
    {

        return Connection::create([
            'send_from' => $sender_id,
            'send_to'   => $receiver_id,
            'is_direct_reply' => $is_direct_reply
        ]);
    }

    public function readAll($connection_id)
    {
        Message::where(['send_to' => auth()->id(), 'connection_id' => $connection_id, ['status', '!=', 2]])->update([
            'status'  => 2
        ]);
    }

    // public function getAccessToken(Request $request){

    //     $request->validate([
    //         'device_type'   =>  'required|string',
    //         'call_type'     =>  'required|string',
    //          'user_id'      =>  'sometimes|exists:users,id|nullable'
    //     ]);

    //     $account_sid = getenv("TWILIO_ACCOUNT_SID");
    //     $apiKeySid = getenv("TWILIO_API_KEY_SID");
    //     $apiKeySecret = getenv("TWILIO_API_KEY_SECRET");
    //     $outgoingApplicationSid = env("TWILIO_SID");
    //     // $push_sid   = env('TWILIO_PUSH_SID');
    //     // $push_sid_ios = env('TWILIO_PUSH_SID_IOS');

    //     if($request->device_type == 'IOS'){
    //         $push_sid = env('TWILIO_PUSH_SID_IOS');
    //     }elseif($request->device_type == 'ANDROID'){
    //         $push_sid   = env('TWILIO_PUSH_SID');
    //     }else{
    //         responseNow(0, null, 'Invalid device type');
    //     }

    //     // $identity = uniqid();
    //     $identity = auth()->user()->id;

    //     $token = new AccessToken(
    //         $account_sid,
    //         $apiKeySid,
    //         $apiKeySecret,
    //         3600,
    //         $identity
    //     );

    //     if($request->call_type == 'AUDIO'){

    //         // Create Voice grant
    //         $voiceGrant = new VoiceGrant();
    //         $voiceGrant->setOutgoingApplicationSid($outgoingApplicationSid);
    //         $voiceGrant->setPushCredentialSid($push_sid);

    //         // Optional: add to allow incoming calls
    //         $voiceGrant->setIncomingAllow(true);

    //         $token->addGrant($voiceGrant);

    //     }elseif($request->call_type == 'VIDEO'){

    //         //  Grant access to Video
    //         $video = new VideoGrant();
    //         $video->setRoom('cool room');
    //         $token->addGrant($video);

    //     }else{
    //         responseNow(0, null, 'Invalid call type');
    //     }

    //      // Grant access to Video
    //     //  $grant = new VideoGrant();
    //     //  $grant->setRoom('cool room');
    //     //  $token->addGrant($grant);

    //     return $token->toJWT();
    // }


    public function getVideoAccessToken($meeting_id){

        $account_sid = getenv("TWILIO_ACCOUNT_SID");
        $apiKeySid = getenv("TWILIO_API_KEY_SID");
        $apiKeySecret = getenv("TWILIO_API_KEY_SECRET");

        // $identity = uniqid();
        $identity = auth()->user()->id;

        $token = new AccessToken(
            $account_sid,
            $apiKeySid,
            $apiKeySecret,
            3600,
            $identity
        );

        $video = new VideoGrant();
        $video->setRoom($meeting_id);
        $token->addGrant($video);

        return $token->toJWT();
    }
}
