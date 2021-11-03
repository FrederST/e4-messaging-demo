<?php

use App\Events\NewUserEvent;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;

return [
    /*
    |--------------------------------------------------------------------------
    | Default App Connection Name
    |--------------------------------------------------------------------------
    */
    'default' => env('MSAPP_CONNECTION', 'rabbitmq'),

    /*
    |--------------------------------------------------------------------------
    | Messaging Apps Connections
    |--------------------------------------------------------------------------
    */
    'connections' => [
        'rabbitmq' => [
            'driver' => 'rabbitmq',
            'ssl' => env('MSAPP_RABBITMQ_SSL', false),
            'host' => [
                'host' => env('AMQP_HOST', 'beaver.rmq.cloudamqp.com'),
                'port' => env('AMQP_PORT', '5672'),
                'username' => env('AMQP_USERNAME', 'pzrjdqgp'),
                'password' => env('AMQP_PASSWORD', 'RExuiTPwf0ZxH68RLQoqBlodnMheoSfi'),
                'vhost' => env('AMQP_VHOST', 'pzrjdqgp'),
            ],
            'exchange' => [
                'name' => env('AMQP_EXCHANGE_NAME', 'place_to_pay_exchange'),
                'type' => env('AMQP_EXCHANGE_TYPE', 'direct')
            ],

            'queue' => [
                'name' => env('AMQP_QUEUE_NAME', 'panel')
            ],

            'ssl_options' => [
                'cafile' => env('MSAPP_RABBITMQ_SSL_CAFILE', null),
                'local_cert' => env('MSAPP_RABBITMQ_SSL_LOCAL_CERT', null),
                'local_key' => env('MSAPP_RABBITMQ_SSL_LOCAL_KEY', null),
                'verify_peer' => env('MSAPP_RABBITMQ_SSL_VERIFY_PEER', true),
                'passphrase' => env('MSAPP_RABBITMQ_SSL_PASSPHRASE', null),
            ],
            //'backupConnection' => 'rabbitmqBackup',
        ],
        /*'rabbitmqBackup' => [
            'driver' => 'rabbitmq',
            ...
        ]*/
    ],
    'signature' => [
        'algorithm' => env('MSAPP_SIGNATURE_ALGORITHM', OPENSSL_ALGO_SHA256),
        'publicKey' => env('MSAPP_SIGNATURE_PUBLICKEY_PATH', 'file:///C:/Users/frede/Documents/GitHub/escuela-php-messaging/tests/certs/signaturePublicKey.pem'),
        'privateKey' => env('MSAPP_SIGNATURE_PUBLICKEY_PATH', 'file:///C:/Users/frede/Documents/GitHub/escuela-php-messaging/tests/certs/signatureprivateKey.pem'),
    ],
    'encryption' => [
        'secretKey' => env('MSAPP_ENCRYPT_SECRET_KEY', 'CLASS-MESSAGE-KEY'),
        'method' => env('MSAPP_ENCRYPT_METHOD', 'AES-256-CBC'),
        'algorithm' => env('MSAPP_ENCRYPT_ALGORITHM', 'sha256'),
    ],
    'events' => [
        'user::created' => NewUserEvent::class
    ]
];
