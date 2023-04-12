<?php

namespace App\Repositories\Mail;

use App\Repositories\Mail\iMailRepository;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailVerification;
use App\Mail\ForgetPassword;
use App\Mail\DriverRequest;

class MailRepository implements iMailRepository{

    public function emailVerification($email, $code)
    {
        Mail::to($email)->send(new EmailVerification($code));
    }

    public function forgetPassword($email, $code){
        Mail::to($email)->send(new ForgetPassword($code));
    }

    public function driverRequest($email, $status){
        Mail::to($email)->send(new DriverRequest($status));
    }

}