<?php

namespace InvadersXX\FilamentGridstackDashboard\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \InvadersXX\FilamentGridstackDashboard\FilamentGridstackDashboard
 */
class FilamentGridstackDashboard extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \InvadersXX\FilamentGridstackDashboard\FilamentGridstackDashboard::class;
    }
}
