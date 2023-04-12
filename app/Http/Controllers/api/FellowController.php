<?php

namespace App\Http\Controllers\api;

use App\Events\GeneralEvent;
use App\Events\SendRequestEvent;
use App\Http\Controllers\Controller;
use App\Http\Resources\MyFellowResource;
use App\Models\Friend;
use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\CheckFriendTrait;

class FellowController extends Controller
{
    use CheckFriendTrait;
    public function myFellows(){
        $myFellows = Friend::with('sender', 'receiver')
        ->whereHas('receiver')
        ->whereHas('sender')
        ->where(['request_from' => auth()->id()])
        ->orWhere(['request_to' => auth()->id()])
        ->paginate(10);
        $myFellows = MyFellowResource::collection($myFellows);

        return response()->success(1, 'list of my fellows', $myFellows);
    }

    public function sendRequest(Request $request ){
        $request->validate([
            'user_id'   =>  'required|exists:users,id'
        ]);


        $user = User::find($request->user_id);

        auth()->user()->makeFriend()->attach($request->user_id);

        $notification = [
            'name' => $user->firstname.' '.$user->lastname,
            'profile' => $user->profile_pic,
            'position' => $user->current_position,
            'id'    =>  $user->id
        ];

        event(new SendRequestEvent($notification));

        return response()->success(1, 'request sent successfully');
    }

    public function friendRequestList(Request $request){
        $requests = Friend::with('sender')
        ->where('request_to', auth()->id())
        ->where('is_accepted', 0)
        ->orderBy('id', 'DESC')
        ->limit(5)
        ->get();


        $url = env('PROFILE_URL');

        return response()->success(1, 'friend request list', ['url' => $url, 'requests' => $requests]);

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

                    return response()->success(1, 'request accepted successfully');
                }
            }else{
                $friendRequest->delete();
                return response()->success(1, 'request rejected successfully');
            }

        }catch(\Exception $e){
            return response()->error(1, null, 'something went wrong. please try again');
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
