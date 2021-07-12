<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Package activity
    |--------------------------------------------------------------------------
    | If you change this value to false, this package will not check the routes! (SHUT DOWN BUTTON)
    |
     */
    'isEnable' => true,

    /*
    |--------------------------------------------------------------------------
    | Database Engine
    |--------------------------------------------------------------------------
    |
    | Supported Engines: "redis", "eloquent"
    | Strongly we recommend Redis database! Eloquent may adversely affect your speed
    |
    */
    'engine' => 'redis',

    /*
    |--------------------------------------------------------------------------
    | Header Status
    |--------------------------------------------------------------------------
    | If you want another status, you can add the header status to the following array.
    |
    */
    'status' => [
        'redirect' => [
            300, 301, 302, 303, 304
        ],
        'abort' => [
            400, 401, 402, 403, 404, 405, 406, 500, 501, 502, 503
        ]
    ],

];
