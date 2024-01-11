<?php

return [
    "sandbox"         => '',
    "bkash_app_key"     => '',
    "bkash_app_secret" => '',
    "bkash_username"      => '',
    "bkash_password"     => '',

    "bkash_app_key_2"     => env("BKASH_APP_KEY_2", ""),
    "bkash_app_secret_2" => env("BKASH_APP_SECRET_2", ""),
    "bkash_username_2"      => env("BKASH_USERNAME_2", ""),
    "bkash_password_2"     => env("BKASH_PASSWORD_2", ""),

    "bkash_app_key_3"     => env("BKASH_APP_KEY_3", ""),
    "bkash_app_secret_3" => env("BKASH_APP_SECRET_3", ""),
    "bkash_username_3"      => env("BKASH_USERNAME_3", ""),
    "bkash_password_3"     => env("BKASH_PASSWORD_3", ""),

    "bkash_app_key_4"     => env("BKASH_APP_KEY_4", ""),
    "bkash_app_secret_4" => env("BKASH_APP_SECRET_4", ""),
    "bkash_username_4"      => env("BKASH_USERNAME_4", ""),
    "bkash_password_4"     => env("BKASH_PASSWORD_4", ""),

    "callbackURL"     => env("BKASH_CALLBACK_URL", "bkash/callback"),
    'timezone'        => 'Asia/Dhaka',
];

// config('bkash.sandbox')
// config("bkash.bkash_app_key",'')
// config("bkash.bkash_app_secret",'')
// config("bkash.bkash_username",'')
// config("bkash.bkash_password",'')