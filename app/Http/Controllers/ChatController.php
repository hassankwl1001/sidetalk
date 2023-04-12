<?php

namespace App\Http\Controllers;

use App\Events\NewMessageEvent;
use App\Events\GeneralEvent;
use App\Models\Message;
use App\Models\User;
use App\Repositories\Stripe\iStripeRepository;
use Illuminate\Http\Request;
use App\Repositories\ChatRepository\iChatRepository;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\Consultation;
use App\Traits\NotificationTrait;


class ChatController extends Controller
{
    use NotificationTrait;

    private $chat;
    private $stripe;

    public function __construct(iChatRepository $chat, iStripeRepository $stripe)
    {
        $this->chat = $chat;
        $this->stripe=$stripe;
    }

    public function inbox($id = null){
//        $profileUrl = env('PROFILE_URL');
        $profileUrl = url('/')."/storage/app/media";
        $conversations = $this->chat->getConversationsList();
        $temp_arr=[];
        if($id != null | $id != ''){
            $user = User::find($id);
                foreach ($conversations as $conv){
                    if($conv->send_to != $user->id){
                        $temp_arr[] = $conv;
                    }
                }

            $conversations = $temp_arr;

            return view('inbox')->with(compact('user', 'profileUrl', 'conversations'));
        }

        return view('inbox')->with(compact('profileUrl', 'conversations'));
    }

    public function getConversationMessages(Request $request){
        $connection = $this->chat->getConnection(auth()->id(), $request->user_id);

        if($connection == '' || $connection == null){
            return response()->json(['ResponseCode' => 0, 'ResponseMessage' => 'No Conversation yet'], 200);
        }else{
//            $url = env('MEETING_ATTACHMENTS');
//            $url = "https://skilledtalk.codefirms.com/storage/files/meetings/attachments/";
                $url = url("/")."/storage/app/public/files/meetings/attachments/";
            $conversation = $this->chat->getConversationMessages($connection->id);
            return response()->json(['ResponseCode' => 1, 'ResponseMessage' => 'conversationMessages', 'data' => $conversation, 'meeting_attachment_url' => $url], 200);

        }
    }

    public function sendMessage(Request $request){
        $message = $this->chat->sendMessage($request);

        $name = auth()->user()->firstname . ' ' . auth()->user()->lastname;
//
        $notification = [
            'user_id' => $message->send_to,
            'other_user_id' => auth()->id(),
            'text' => $name . ' message you,please check inbox.',
            'url'=> "https://skilledtalk.com/inbox/".auth()->id()
        ];

        $data = [
            'action' => 'MESSAGE',
            'text' => $name . ' message you,please check inbox.'
        ];


        if($message->send_to != auth()->id()){
            $this->storeNotification($notification);
            event(new GeneralEvent($data, $message->send_to));
        }


        event(new NewMessageEvent($message));


        if($message){
            return response()->json(['ResponseCode' => 1, 'ResponseMessage' => 'message sent', 'data' => $message], 200);
        }
    }

    public function setMeeting(Request $request){


        if ($request->has('file')){
            $filNameWithExtention = $request->file('file')->getClientOriginalName();
            $fileName = pathinfo($filNameWithExtention, PATHINFO_FILENAME);
            $extention = $request->file('file')->getClientOriginalExtension();
            $image = $fileName . '_' . time() . '.' . $extention;
            $path = $request->file('file')->storeAs('public/files/meetings/attachments', $image);

            $request['attachment'] = $image;
        }

        $user = User::findOrFail($request->consult_with);
        $session_price = $user->session_price;

        $payment=$this->stripe->captureSessionPrice($request->CardToken, $session_price);
        
        if($payment["status"] == "requires_capture"){

            $skilltalk_percentage = ($session_price * 10) /100;
            $actualPrice =  $session_price - $skilltalk_percentage;
            unset($request['CardToken']);
            unset($request['_token']);
            unset($request['file']);

            // dd($request->all());
            $meeting_id = (string) Str::uuid();
            $request['meeting_id']  = $meeting_id;
            $request['session_price'] =  $session_price;
            $request['skilled_talk_percentage'] = $skilltalk_percentage;
            $request['actual_payment_earned'] =  $actualPrice;
            $request['transaction_id'] = $payment["id"];

            auth()->user()->consultation()->attach($request->consult_with, $request->except('file'));

            $request['send_to'] = $request->consult_with;
            $request['type'] = 'Consultation';
            $request['text']  = $request->desc;

            $this->chat->sendMessage($request);

            $data = [
                'action' => 'NEW_ENGAGEMENT',
                'name' => auth()->user()->firstname.' '.auth()->user()->lastname,
                'message'=>"Has sent you a new Engagement",
                'consult_with'=>$request->consult_with
            ];

            event(new GeneralEvent($data, $request->consult_with));

            return back()->with(['success' => 'You meeting has been sent successfully']);

        }

        return back()->with(['error' => 'Something Went Wrong Please Try again.!']);



    }

    public function AcceptRejectMeeting(Request $request){

        $stripe = new \Stripe\StripeClient(
            env("STRIPE_SECRET")
        );
        \Stripe\Stripe::setApiKey(env("STRIPE_SECRET"));



     $record = DB::table('consultations')
            ->where('meeting_id', $request->meeting_id)
            ->update(['is_accepted' => $request->action]);


    $meeting = DB::table('consultations')
        ->where('meeting_id', $request->meeting_id)->first();

    $send_notification_to = $meeting->consult_from;

        $data = [
            'action' => 'ENGAGEMENT_ACCEPTANCE',
            'name' => auth()->user()->firstname.' '.auth()->user()->lastname,
            'message'=>"has ".($request->action == 1 ? " Approved " : " Rejected ")." your Engagement",
            'send_notification_to'=>$send_notification_to
        ];

        event(new GeneralEvent($data, $send_notification_to));

        $intent = \Stripe\PaymentIntent::retrieve($meeting->transaction_id);
        $currency = "usd";
        $customer = $intent->customer;
        $payement_method = $intent->payment_method;
        $payement_method_type = $intent->payment_method_types;



        if($request->action == 1){

            try{

                $charge =   $stripe->paymentIntents->create([
                    'amount' => ($meeting->session_price * 100),
                    'currency' => $currency,
                    'customer' => $customer,
                    'payment_method' => $payement_method,
                    'payment_method_types' => $payement_method_type,
                    'confirm' => true,
                ]);

            }catch(\Stripe\Exception\ApiErrorException $e){
                $error = $e->getError();
                return [
                    "ResponseCode"=>0,
                    "ResponseMessage"=>$error->message
                ];
            }

            if ($intent) {

                //Cancelling the previous captured payment
                $refunded_ammount =  $stripe->paymentIntents->cancel(
                    $meeting->transaction_id,
                    []
                );
            }


//        $user_balance = auth()->user()->balance;
//        auth()->user()->update([
//           "balance"=> $user_balance + $meeting->actual_payment_earned
//        ]);


        }elseif ($request->action == -1){
            if ($intent) {

                //Cancelling the previous captured payment
                $refunded_ammount =  $stripe->paymentIntents->cancel(
                    $meeting->transaction_id,
                    []
                );
            }
        }

        return $request->action;
    }

    public function call($meeting_id){

        $token= $this->chat->getVideoAccessToken($meeting_id);
        return view('calling')->with(compact('token', 'meeting_id'));
    }


    public function CompleteMeeting(Request $request){



        $meeting = Consultation::where('id', $request->meeting_id)->first();

        if($request->has("consult_from_id") && $request->consult_from_id != ""){
            $meeting->consult_from_complete = 1;
        }elseif($request->has("consult_with_id") && $request->consult_with_id != ""){
            $meeting->consult_with_complete = 1;
        }
        $meeting->save();

        if($meeting->consult_from_complete == 1 && $meeting->consult_with_complete == 1){

            $user = User::find($meeting->consult_with);
            $user->balance = $user->balance + $meeting->actual_payment_earned;
            $user->update();
        }

        return true;
    }


}
