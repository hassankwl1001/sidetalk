<?php

namespace App\Http\Controllers;

use App\Events\GeneralEvent;
use App\Events\SendRequestEvent;
use App\Models\Friend;
use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\CheckFriendTrait;
use App\Traits\NotificationTrait;

class FriendController extends Controller
{

    use CheckFriendTrait;
    use NotificationTrait;
    public function sendRequest(Request $request){
        $request->validate([
            'user_id'   =>  'required|exists:users,id'
        ]);

        $user = User::find($request->user_id);

        auth()->user()->makeFriend()->attach($request->user_id);


        $notification = [
            'name' => auth()->user()->firstname.' '.auth()->user()->lastname,
            'profile' => auth()->user()->profile_pic,
            'position' => auth()->user()->current_position,
            'id'    =>  auth()->user()->id
        ];

        $notification2 = [
            'user_id' => $request->user_id,
            'other_user_id' => auth()->id(),
            'text' => auth()->user()->firstname.' '.auth()->user()->lastname . ' sent you friend request.',
            'url'=>'https://skilledtalk.com/user/profile/'.auth()->id()
        ];

        $this->storeNotification($notification2);

        event(new SendRequestEvent($notification));

        return 1;
    }

    public function friendRequestList(Request $request){
        $requests = Friend::with('sender')
        ->where('request_to', auth()->id())
        ->where('is_accepted', 0)
        ->orderBy('id', 'DESC')
        ->limit(5)
        ->get();
        $follows=Friend::with('sender')
            ->where('request_to', auth()->id())
            ->where('is_accepted', 1)
            ->orderBy('id', 'DESC')
            ->limit(5)
            ->get();


//        $url = env('PROFILE_URL');
            $url = url('/').'/storage/app/media';

        return [
            'url'   =>    $url,
          'requests' =>   $requests,
            'follows'=>$follows
        ];
    }
    public function friendList(Request $request){
        $friends = Friend::with('sender')
            ->where('request_to', auth()->id())
            ->where('is_accepted', 1)
            ->paginate(10);
//        $url = env('PROFILE_URL');
        $url = url('/')."/storage/app/media";
        return view('friendsList',compact('friends','url'));
        return [
            'url'   =>    $url."/",
            'friends' =>   $friends
        ];
    }

    public function getFriendListAjax(Request $request){

        $friends_ids = [];

//        $friends = Friend::with('sender')
//            ->where('request_to', auth()->id())
//            ->where('is_accepted', 1)
//            ->paginate(10);

        $friends_ids = [];
        $friends = Friend::with("sender","receiver")->where(function ($query) {
            $query->where('request_to', auth()->id())
                ->orWhere('request_from', auth()->id());
        })
            ->where('is_accepted', 1)
            ->get();

        foreach ($friends as $friend) {

            if ($friend->request_from == auth()->user()->id) {
                $friends_ids[] = $friend;
            } elseif ($friend->request_to == auth()->user()->id) {
                $friends_ids[] = $friend;
            }
        }

        $friends  = $friends_ids;


//        $url = env('PROFILE_URL');
        $url = url('/')."/storage/app/media";
        return [
            'url'   =>    $url."/",
            'friends' =>   $friends,
            'auth_id'=>auth()->id()
        ];
    }

    public function friendRequestAction(Request $request){

        try{

            $friendRequest = Friend::where(['request_from' => $request->user_id, 'request_to' => auth()->id()])
            ->first();

            if($request->action){
                if($friendRequest){
                    $friendRequest->update([
                        'is_accepted' => 1
                    ]);

                   $data = [
                       'action' => 'FRIEND_REQUEST_ACCPETED',
                        'name' => auth()->user()->firstname.' '.auth()->user()->lastname
                   ];

                    event(new GeneralEvent($data, $request->user_id));

                    return 1;
                }
            }else{
                $friendRequest->delete();
                return 1;
            }

        }catch(\Exception $e){
            return 0;
        }
    }

    public function unfriend(Request $request){
        $friend = $this->is_friend($request->user_id, auth()->id());
        if($friend){
            $friend->delete();
            return 1;
        }else{
            return 0;
        }
    }
}
