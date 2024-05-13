<?php

namespace InvadersXX\FilamentGridstackDashboard;

use Filament\Contracts\Plugin;
use Filament\Panel;
use Filament\Support\Concerns\EvaluatesClosures;
use InvadersXX\FilamentGridstackDashboard\Filament\Pages\Dashboard;

class GridstackDashboardPlugin implements Plugin
{
    use EvaluatesClosures;

    protected string $settingsPath = 'dashboard.layout';

    public static function make(): static
    {
        return app(static::class);
    }

    public static function get(): static
    {
        /** @var static $plugin */
        $plugin = filament(app(static::class)->getId());

        return $plugin;
    }

    public function getId(): string
    {
        return 'filament-gridstack-dashboard';
    }

    public function register(Panel $panel): void
    {
        $panel
            ->pages([
                Dashboard::class,
            ]);
    }

    public function settingsPath(string $path): static
    {
        $this->settingsPath = $path;

        return $this;
    }

    public function getSettingsPath(): string
    {
        return $this->evaluate($this->settingsPath);
    }

    public function boot(Panel $panel): void
    {
    }
}
