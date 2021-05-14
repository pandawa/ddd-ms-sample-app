<?php

use Illuminate\Support\Str;

return [
    'default' => env('ARJUNA_BROKER', 'kafka'),

    'produce' => [
        'queue'      => env('ARJUNA_PRODUCE_QUEUE', false),
        'connection' => env('ARJUNA_PRODUCE_QUEUE_CONNECTION'),
    ],

    'default_topic' => env('ARJUNA_DEFAULT_TOPIC', Str::snake(config('app.name'))),
    'group'         => env('ARJUNA_GROUP', Str::snake(config('app.name'))),

    'drivers' => [
        'kafka' => [
            'brokers'          => env('KAFKA_BROKERS', '127.0.0.1'),
            'compression_type' => env('KAFKA_COMPRESSION', 'snappy'),
            'autocommit'       => env('KAFKA_AUTOCOMMIT', false),
            'debug'            => env('KAFKA_DEBUG', false),
        ],

        'redis' => [
            'connection'       => env('REDIS_BROKER_CONNECTION', 'default'),
            'retention_period' => env('REDIS_BROKER_RETENTION_PERIOD', 7),
        ],
    ],

    'event_mappers' => [
        // Register your event mappers
    ],
];
