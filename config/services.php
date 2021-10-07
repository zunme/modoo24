<?php
return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
	'kakao' => [
	  'client_id' => env('KAKAO_KEY'),
	  'client_secret' => env('KAKAO_CLIENT_SECRET'),
	  'redirect' => $_SERVER['APP_URL'].env('KAKAO_REDIRECT_URI'),
	  'admin_key' => '47fd77fd40f2c9512db0283ff000042d',
	],
	'naver' => [
        'client_id' => env('NAVER_CLIENT_ID'),
        'client_secret' => env('NAVER_CLIENT_SECRET'),
        'redirect' => $_SERVER['APP_URL'].env('NAVER_REDIRECT')
    ],

];
