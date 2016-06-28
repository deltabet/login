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

    'mailgun' => [
        'domain' => env('sandbox42aefdd431ff454981b1f3fcebed5441.mailgun.org'),
        'secret' => env('key-3ca4e136c25d67915d1ca1f88a30a89e'),
    ],

    'mandrill' => [
        'secret' => env('MANDRILL_SECRET'),
    ],

    'ses' => [
        'key' => 'AKIAI3BDZRNV5NHYVQBQ',
        'secret' => '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',
        'region' => 'us-west-2',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

];
