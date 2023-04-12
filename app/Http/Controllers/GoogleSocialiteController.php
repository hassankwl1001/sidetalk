<?php

namespace App\Http\Controllers;

use App\Models\User;
use DateTime;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use Carbon\Carbon;

class GoogleSocialiteController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleCallback()
    {
        try {

            $user = Socialite::driver('google')->stateless()->user();

            $finduser = User::where('email', $user->email)->first();

            if ($finduser) {

                if($finduser->social_id != NULL){

                    Auth::login($finduser);
                    return redirect('/');
                }
                session()->put("error","This email is associated with email and password. Please login with email and password.");
                return redirect('/');

            } else {

                //Creating Stripe Customer, on social login facebook
                $stripe = new \Stripe\StripeClient(
                    env('STRIPE_SECRET')
                );

                //Creating Stripe user for records
                try {
                    $stripe_customer = $stripe->customers->create([
                        'email' => $user->email,
                        'name' => $user->user["name"],
                        'description' => 'User',
                    ]);
                } catch (\Stripe\Exception\CardException $e) {
                    // Error code will be authentication_required if authentication is needed
                    // echo 'Error code is:' . $e->getError()->code;
                    $error = $e->getError();
                    $payment_intent_id = $e->getError()->payment_intent->id;
//                    return $error;
                    dd($error,64);
                }

                $newUser = User::create([
                    'email' =>   $user->email,
                    'firstname' => $user->user["name"],
                    'lastname' => "",
                    'social_id' => $user->id,
                    'password' => encrypt('my-google'),
                    'stripe_customer_id'=>$stripe_customer->id
                ]);

                $newUser->email_verified_at = Carbon::now()->toDateTimeString();
                $newUser->update();

                Auth::login($newUser);
                return redirect('/');
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
}
