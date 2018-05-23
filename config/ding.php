<?php

return [

    'default' => [
        'enabled' => env('DING_ENABLED',true),

        'token' => env('DING_TOKEN',''),

        'timeout' => env('DING_TIME_OUT',2.0)
    ],

    'other' => [
        'enabled' => env('OTHER_DING_ENABLED',true),

        'token' => env('OTHER_DING_TOKEN',''),

        'timeout' => env('OTHER_DING_TIME_OUT',2.0)
    ]

];