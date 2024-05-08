<?php

use App\Models\User;
use InvadersXX\FilamentGridstackDashboard\Models\GridStackDashboard;

return [
    'table' => 'filament_gridstack_dashboards',
    'model' => GridStackDashboard::class,
    'field' => 'parameters',
    'foreign_key' => 'user_id',
    'users' => [
        'model' => User::class,
        'table' => 'users',
    ],
];
