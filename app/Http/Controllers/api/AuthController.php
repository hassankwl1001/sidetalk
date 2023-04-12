<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\SetPasswordRequest;
use App\Http\Resources\LoginResource;
use App\Models\User;
use Illuminate\Http\Request;
use App\Repositories\UnitOfWork\iUnitOfWork;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use App\Traits\CreateStripeCustomerTrait;

class AuthController extends Controller
{
    use CreateStripeCustomerTrait;

    private $unitOfWork;

    public function __construct(iUnitOfWork $unitOfWork)
    {
        $this->unitOfWork = $unitOfWork;
    }

    public function register(RegisterRequest $request){
        if($request->has('email')){
            $response =  $this->unitOfWork->auth->ifUserExists($request);
            if($response == 400){

             return response()->error(2, 'Redirect to login screen', 'Account Already exists. Please login');

            }elseif($response == 1){
               return response()->success(1, 'A verification code been sent');
            }
         }

         $user = $request->store();

         $stripe_customer_id = $this->createStripeCustomer($user);

         $user->update([
             'stripe_customer_id' => $stripe_customer_id
         ]);

         $response = [
             'ResponseCode' => 1,
             'ResponseMessage' => 'A verification code been sent',
         ];

         return response()->json($response, 200);
    }

    public function login(LoginRequest $request){
        if ($request->has('email')) {
            if (!Auth::attempt($request->only(['email', 'password']))) {
                return response()->error(0, null, 'Provided credentials are not correct', 401);
            }
            $user =  $this->unitOfWork->user->validateUser($request->email);
            if($user){
                $user = $this->makeToken($user);
            }else{
                return response()->error(0, null, 'User not found with this email');
            }
        }elseif($request->has('social_id')){
            if($user = $this->unitOfWork->auth->CheckSocialUserExists($request)){
                $user = $this->makeToken($user);
            }else{
               $user =  $request->createSocialUser();
               $user = User::find($user->id);
               $user = $this->makeToken($user);
            }
        }

        if($user->firstname == null && $user->lastname == null){
            return response()->success(2, 'logged in successfully', $user);
        }

        return response()->success(1, 'logged in successfully', $user);

    }

    public function makeToken($user){
        $token = $user->createToken('2AgainToken')->plainTextToken;
        $user->token = $token;
        $user = new LoginResource($user);
        return $user;
    }

    public function resendOTP(Request $request){
        $request->validate([
            'email' =>  'required|exists:users,email'
        ]);

        $this->unitOfWork->auth->otpResend($request);

        return response()->success(1, 'A Fresh OTP sent successfully');
   }

    public function getUser(Request $request){
        return $request->user();
    }

    public function verifyUser(Request $request){
        $user = $this->unitOfWork->auth->checkOTPValidation($request);

        if(!$user){
            return response()->error(0, null, 'Invalid OTP code');
        }

        $token = $user->createToken('2AgainToken')->plainTextToken;

        return response()->success(1, 'OTP verified successfully', ['token' => $token]);
    }

    public function setPassword(SetPasswordRequest $request){
        $this->unitOfWork->auth->setPassword($request);
        return response()->success(1, 'Password set successfully');
    }

    public function resetPassword(Request $request){
        $this->unitOfWork->auth->resetPassword($request);
        return response()->success(1, 'Password Reset Successfully');
    }

    public function verifyOTP(Request $request)
    {
        $verified =  $this->unitOfWork->auth->verifyOTP($request);

        if(!$verified){
            return response()->error(0, null, 'Invalid OTP Code');
        }
        return response()->success(1, 'OTP verified successfully.', ['otp' => $verified]);
    }

    public function logout(){
        auth()->user()->currentAccessToken()->delete();
        return response()->success(1, 'logout successfully');
    }

    //function to check if email exits or not
    public function userStatus(Request $request){
        $user=User::where('email',$request->email)->first();
        if(isset($user) && $user!=''){
            $data['status']=true;
        } else{
            $data['status']=false;
        }
       return $data;
    }
}
