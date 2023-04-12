<?php

namespace App\Repositories\Stripe;

use App\Repositories\Stripe\iStripeRepository;
use Stripe;
class StripeRepository implements iStripeRepository{

   private $stripe;
   private $stripe_secret = "sk_test_51LokHfFPy6qhi114FZNzxPDr1naYLW5bIJEccgYNHfLiQCDbVezR9rKefwSvSU6ZBKDTUPe6H3e0gQhCuPJT4zF600V4iv0o4t";

   public function __construct(){

       $this->stripe=new \Stripe\StripeClient($this->stripe_secret);
   }

   //Creating Subscription with refrence of customer
    public function payment($CardToken)
    {
//        //first creating card and then proceeding to payment
//       $source = $this->stripe->customers->createSource(
//            auth()->user()->stripe_customer_id,
//            ['source' => $CardToken]
//        );
//
//       //Creating charge
//        $payment = $this->stripe->charges->create([
//            "amount" => 50*100,
//            "currency" => "usd",
//            "source" => $source, // obtained with Stripe.js
//            "customer"=>auth()->user()->stripe_customer_id
//        ]);



        $payment=$this->stripe->charges->create([
            "amount" => 50*100,
            "currency" => "usd",
            "source" => $CardToken, // obtained with Stripe.js
//            "customer"=>auth()->user()->stripe_customer_id
        ]);
        return $payment;


    }

    public function captureSessionPrice($token, $price){

        //first creating card and then proceeding to payment
        $source = $this->stripe->customers->createSource(
            auth()->user()->stripe_customer_id,
            ['source' => $token]
        );

        $payment=$this->stripe->paymentIntents->create([
            "amount" => (int) $price * 100,
            "currency" => "usd",
            'payment_method_types' => ['card'],
            "payment_method" => $source, // obtained with Stripe.js
            "customer"=>auth()->user()->stripe_customer_id,
            'capture_method' => 'manual',
            'off_session' => true,
            'confirm' => true,
        ]);
        return $payment;
    }


}
