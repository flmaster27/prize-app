<?php

return [
    'bonus' => [
        'min' => env('BONUS_MIN', 1),
        'max' => env('BONUS_MAX', 1000),
    ],
    'money_to_bonus_factor' => env('MONEY_TO_BONUS_FACTOR', 2),
];
