<?php

namespace App\Repositories\Auth;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\SetPasswordRequest;
use App\Jobs\UserNotificationJob;
use App\Models\User;
use App\Repositories\Auth\iAuthRepository;
use App\Repositories\Users\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
class AuthRepository extends UserRepository implements iAuthRepository{


    public function login(array $attributes, $user){
        if (Auth::attempt($attributes)) {
            $token = $user->createToken('test Token')->plainTextToken;
            return [
                'ResponseCode' => 1,
                'token' => $token,
                'data' => $user
            ];
        }

    }

    public function CheckSocialUserExists(Request $request){
        $user = User::where('social_id', $request->social_id)->first();
        if($user){
            return $user;
        }else{
            return false;
        }
    }

    public function ifUserExists(RegisterRequest $request){
        $user = User::where('email', $request->email)->first();
        if($user){
            if($user->password !=null){
                return 400;
            }else{
                $user->update([
                    'otp'   =>  mt_rand(100000, 999999)
                ]);
                dispatch(new UserNotificationJob($user));
                return 1;
            }
        }
    }

    public function otpResend(Request $request){

        $user = $this->getUser($request);

        $otp = mt_rand(100000, 999999);
        $user->update(['otp' => $otp]);
        dispatch(new UserNotificationJob($user));

        return 1;

    }


    public function checkOTPValidation(Request $request)
    {
        $request->validate([
            'email'     => 'required|exists:users,email',
            'otp'       => 'required',
        ]);

        $user = User::where($request->all())->first();

        if (!$user) {
         return false;
        }

        $user->update([
            'otp'   => mt_rand(100000, 999999)
        ]);

        return $user;
    }


    public function verifyOTP(Request $request){
        $user = $this->checkOTPValidation($request);
        if(!$user){
            return 0;
        }
        $newCode = mt_rand(100000, 999999);
        $user->update(['otp' => $newCode]);
        return $newCode;
    }


    public function setPassword(SetPasswordRequest $request){
        $request->store();
    }

    public function resetPassword(Request $request){

        $request->validate([
            'email'                  => 'required|exists:users,email',
            'password'               => 'required|string|min:8|confirmed',
            'password_confirmation'  => 'required|same:password',
            'otp'                    =>  'required|exists:users,otp'
        ]);

        $user = $this->getUser($request);

        $newCode = mt_rand(1000, 9999);

        $user->update(['password' => $request->password, 'otp' => $newCode]);

    }

    public function getUser(Request $request){
        return User::where('email', $request->email)->first();
    }

    public function logout(){

    }
}
