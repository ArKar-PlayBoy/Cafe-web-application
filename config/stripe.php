<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Stripe API Keys
    |--------------------------------------------------------------------------
    |
    | You can find your API keys in the Stripe Dashboard.
    | https://dashboard.stripe.com/apikeys
    |
    */

    'key' => env('STRIPE_KEY'),
    'secret' => env('STRIPE_SECRET'),
    'webhook_secret' => env('STRIPE_WEBHOOK_SECRET'),

    /*
    |--------------------------------------------------------------------------
    | Stripe Mode
    |--------------------------------------------------------------------------
    */

    'mode' => env('STRIPE_MODE', 'test'),

    /*
    |--------------------------------------------------------------------------
    | Currency Configuration
    |--------------------------------------------------------------------------
    */

    'currency' => env('STRIPE_CURRENCY', 'usd'),
    'currency_symbol' => env('STRIPE_CURRENCY_SYMBOL', '$'),

    /*
    |--------------------------------------------------------------------------
    | Application Information
    |--------------------------------------------------------------------------
    */

    'app_name' => env('APP_NAME', 'Cafe'),
    'app_url' => env('APP_URL', 'http://localhost:8000'),
];
