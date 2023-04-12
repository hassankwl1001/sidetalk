<?php

namespace App\Repositories\Stripe;

interface iStripeRepository{

    public function payment($CardToken);
    public function captureSessionPrice($token, $price);
}
