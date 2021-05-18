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

    'app-status' => [
        'domain' => env('APP_STATUS_DOMAIN', '127.0.0.1'),
        'endpoint' => env('APP_STATUS_ENDPOINT', 'api/toxic-apps/actual'),
        'token' => env('APP_STATUS_TOKEN', ''),
    ],

    'search-ads' => [
        'domain' => env('SEARCH_ADS_DOMAIN', '127.0.0.1'),
        'api-version' => env('SEARCH_ADS_API_VERSION', 3),
    ],
];