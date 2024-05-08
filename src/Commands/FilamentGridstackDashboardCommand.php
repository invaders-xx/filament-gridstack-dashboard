<?php

namespace InvadersXX\FilamentGridstackDashboard\Commands;

use Illuminate\Console\Command;

class FilamentGridstackDashboardCommand extends Command
{
    public $signature = 'filament-gridstack-dashboard';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
