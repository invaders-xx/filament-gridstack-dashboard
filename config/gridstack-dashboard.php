<?php

use App\Models\User;

return [
    'table' => 'filament_gridstack_dashboards',
    'users' => [
        'model' => User::class,
        'table' => 'users',
    ],
];
