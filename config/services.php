<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */
'google' => [
    'client_id' => '795001262914-nkq9vjsd7427n52i2htpkeip1ocsj59h.apps.googleusercontent.com',
<<<<<<< HEAD
    'client_secret' => 'wtmDqlGdF1JxQjrxlhVu8pqT',
=======
       'client_secret' => 'wtmDqlGdF1JxQjrxlhVu8pqT',
>>>>>>> master
    'redirect' => 'http://srtes.palazon.com/callback',
],
    'mailgun' => [
        'domain' => '',
        'secret' => '',
    ],

    'mandrill' => [
        'secret' => '',
    ],

    'ses' => [
        'key'    => '',
        'secret' => '',
        'region' => 'us-east-1',
    ],

    'stripe' => [
        'model'  => App\User::class,
        'key'    => '',
        'secret' => '',
    ],

];
