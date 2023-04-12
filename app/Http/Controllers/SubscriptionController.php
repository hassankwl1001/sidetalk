<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Repositories\Stripe\iStripeRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class SubscriptionController extends Controller
{
    public function __construct( iStripeRepository $stripe)
    {
        $this->stripe=$stripe;
    }

    public function getSubscription(Request $request)
    {
//        dd($request->all());

        $payment = $this->stripe->payment($request->CardToken);
        if ($payment['status'] == 'succeeded') {
            $subscription=Subscription::first();
//            auth()->user()->subscription()->attach($subscription->id);
            DB::table('user_subscriptions')->insert([
                'user_id'=>auth()->id(),
                'subscription_id'=>$subscription->id,
                'valid_till'=> Carbon::now()->addMonths($subscription->month),
                'transaction_id'=>$payment["id"]
            ]);
        }
        return redirect(route('home'))->with('success','Subscription successfully subscribe');
    }

    public function unsubscribe(){
        auth()->user()->subscription()->detach();
        return redirect(route('home'))->with('success','You have UnSubscribed successfully');

    }
}
