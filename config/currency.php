<?php

return [
    'default' => env('APP_CURRENCY', 'VND'),

    'currencies' => [
        'VND' => [
            'symbol' => 'VND',
            'name' => 'Vietnamese Dong',
            'decimal_places' => 0,
            'thousands_separator' => '.',
            'decimal_separator' => ',',
            'position' => 'after',
        ],
        'USD' => [
            'symbol' => '$',
            'name' => 'US Dollar',
            'decimal_places' => 2,
            'thousands_separator' => ',',
            'decimal_separator' => '.',
            'position' => 'before',
        ],
        'JPY' => [
            'symbol' => '¥',
            'name' => 'Japanese Yen',
            'decimal_places' => 0,
            'thousands_separator' => ',',
            'decimal_separator' => '.',
            'position' => 'before',
        ],
        'EUR' => [
            'symbol' => '€',
            'name' => 'Euro',
            'decimal_places' => 2,
            'thousands_separator' => '.',
            'decimal_separator' => ',',
            'position' => 'after',
        ],
    ],
];
