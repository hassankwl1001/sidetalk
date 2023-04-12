<?php

namespace App\Repositories\Mail;

interface iMailRepository {
    public function emailVerification($email, $code);
    public function driverRequest($mail, $status);
}