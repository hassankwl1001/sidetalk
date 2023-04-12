<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use App\Repositories\Stripe\iStripeRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubscriptionController extends Controller
{

    private $stripe;

    public function __construct(iStripeRepository $stripe)
    {
        $this->stripe  = $stripe;
    }

    public function subscribe(Request $request){

        $request->validate([
            'CardToken'  => 'required'
        ]);


        $payment = $this->stripe->payment($request->CardToken);
        if ($payment['status'] == 'succeeded') {
            $subscription=Subscription::first();
//            auth()->user()->subscription()->attach($subscription->id);
            DB::table('user_subscriptions')->insert([
                'user_id'=>auth()->id(),
                'subscription_id'=>$subscription->id,
                'valid_till'=> Carbon::now()->addMonths($subscription->month),
            ]);

            return response()->success(1, 'User Subscribed successfully');
        }
    }
}
