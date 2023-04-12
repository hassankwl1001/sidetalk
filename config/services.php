<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'google' => [
        'client_id' => '301374340263-q180gamn56v41l9et3u8174j2me9pnn6.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => 'http://skilledtalk.com/callback/google',
    ],

    'facebook' => [
        'client_id' => '590660926364479',
        'client_secret' => '3bd28a05edcef1413ec63645a2273bdd',
        'redirect' => 'http://skilledtalk.com/callback/facebook',
    ],

];
