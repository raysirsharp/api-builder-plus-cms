<?php

/*
|--------------------------------------------------------------------------
| A map from email providers to their configuration settings
|--------------------------------------------------------------------------
|
| The key is the email provider type name, and the value is an
| array of its available config settings.
|
| Note: Reference keyword ALL for settings that apply to all providers
|
*/


return [
    'all' => [
        'MAIL_FROM_ADDRESS',
        'MAIL_FROM_NAME'
    ],
    'smtp' => [
        'MAIL_HOST',
        'MAIL_PORT',
        'MAIL_USERNAME',
        'MAIL_PASSWORD',
        'MAIL_ENCRYPTION' => ['tls', 'ssl'],
    ]
];
