<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Broadcaster
    |--------------------------------------------------------------------------
    |
    | This option controls the default broadcaster that will be used by the
    | framework when an event needs to be broadcast. You may set this to
    | any of the connections defined in the "connections" array below.
    |
    | Supported: "pusher", "redis", "log", "null"
    |
    */

    'default' => env('BROADCAST_DRIVER', 'null'),

    /*
    |--------------------------------------------------------------------------
    | Broadcast Connections
    |--------------------------------------------------------------------------
    |
    | Here you may define all of the broadcast connections that will be used
    | to broadcast events to other systems or over websockets. Samples of
    | each available type of connection are provided inside this array.
    |
    */

    'connections' => [

//        'pusher' => [
//            'driver' => 'pusher',
//            'key' => env('PUSHER_APP_KEY'),
//            'secret' => env('PUSHER_APP_SECRET'),
//            'app_id' => env('PUSHER_APP_ID'),
//            'options' => [
//                'cluster' => env('PUSHER_APP_CLUSTER'),
//                'encrypted' => true,
//                'host' => '127.0.0.1',
//                'port' => 8000,
//            ],
//        ],

        'pusher' => [
            'driver' => 'pusher',
            'key' => env('a34e1ecd6001d50c92f3'),
            'secret' => env('2ce3403051c655eec4fa'),
            'app_id' => env('786948'),
            'options' => [
                'cluster' => env('ap2'),
                'encrypted' => true,
                'host' => '127.0.0.1',
                'port' => 8000,
            ],
        ],

        'redis' => [
            'driver' => 'redis',
            'connection' => 'default',
        ],

        'log' => [
            'driver' => 'log',
        ],

//        'gcm' => [
//            'key' => env('AIzaSyAVXLaMkIYTVPFHBY_beq004e6bmlA8_58'),
//        ],

        'null' => [
            'driver' => 'null',
        ],

    ],

];
