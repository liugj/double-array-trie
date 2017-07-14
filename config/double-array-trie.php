<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Double Array Trie Path
    |--------------------------------------------------------------------------
    |
    */

    'dest' => env('VIEW_COMPILED_PATH', realpath(storage_path('framework/views'))). '/tree',

    /*
    |--------------------------------------------------------------------------
    | Sensitive Words File path
    |--------------------------------------------------------------------------
    |
    | Sensitive words one word per line
    |
    */

    'src' => resource_path(). '/words',
];
