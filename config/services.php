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
        'region' => env('SES_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
    //add google keys for api authorization
    'google' => [
        'client_id' => env('GOOGLE_ID'),
        'client_secret' => env('GOOGLE_SECRET'),
        'redirect' => env('GOOGLE_REDIRECT')
    ],
    'user_editable_fields' => [
        'phone_number',
        'skype',
        'telegram',
        'room_location'
    ],
    'validity' => [
        'access_token' => '1'
    ],

    'allowed_email_domains' => [
        'provectus-it.com',
        'provectus.com',
        'livenation.com',
        'determine.com',
        'reinvently.com'
    ],

    'admin_emails' => [
        'sklyack@gmail.com',
        'tokarmaxe@gmail.com',
        'kutalova.a@gmail.com',
        'rexar1988@gmail.com',
        'sergey.ponomarenko.od@gmail.com',
        'olga.bilyayeva@gmail.com',
        'ann.zhuravel7@gmail.com',
        'alexey.vronsky.v@gmail.com'
    ],


    'storage_images_path' => 'images' . DIRECTORY_SEPARATOR,

    'pagination_items' => 12,

    'types' => [
        'origin' => [
            'height' => 0,
            'width' => 0,
        ],
        'large' => [
            'height' => 1200,
            'width' => 1200,
        ],
        'thumbnail' => [
            'height' => 90,
            'width' => 90
        ],
    ],
];
