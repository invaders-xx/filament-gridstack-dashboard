<?php

namespace InvadersXX\FilamentGridstackDashboard;

use Filament\Contracts\Plugin;
use Filament\Panel;
use Filament\Support\Concerns\EvaluatesClosures;
use InvadersXX\FilamentGridstackDashboard\Filament\Pages\Dashboard;
use Closure;

class GridstackDashboardPlugin implements Plugin
{
    use EvaluatesClosures;

    protected int | Closure  | null $navigationSort = null;

    protected bool | Closure | null $shouldRegisterNavigation = null;

    protected string | Closure | null $navigationGroup = null;

    protected array | Closure | null $allowedWidgets = null;

    protected array | Closure | null $emptyStateWidgets = null;


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

    public function shouldRegisterNavigation(): ?bool
    {
        return $this->evaluate($this->shouldRegisterNavigation) ?? config('gridstack-dashboard.should_register_navigation');
    }

    public function navigationGroup(string | Closure | null $group = null): static
    {
        $this->navigationGroup = $group;

        return $this;
    }

    public function navigationSort(int | Closure $order): static
    {
        $this->navigationSort = $order;

        return $this;
    }

    public function registerNavigation(bool | Closure $condition = true): static
    {
        $this->shouldRegisterNavigation = $condition;

        return $this;
    }

    public function allowedWidgets(array | Closure $widgets): static
    {
        $this->allowedWidgets = $widgets;

        return $this;
    }

    public function emptyStateWidgets(array | Closure $widgets): static
    {
        $this->emptyStateWidgets = $widgets;

        return $this;
    }

    public function getNavigationSort(): ?int
    {
        return $this->evaluate($this->navigationSort) ?? config('gridstack-dashboard.navigation_sort');
    }

    public function getNavigationGroup(): ?string
    {
        return $this->evaluate($this->navigationGroup) ?? config('gridstack-dashboard.navigation_group');
    }

    public function getAllowedWidgets(): ?array
    {
        return $this->evaluate($this->allowedWidgets) ?? config('gridstack-dashboard.allowed_widgets');
    }

    public function getEmptyStateWidgets(): ?array
    {
        return $this->evaluate($this->emptyStateWidgets) ?? config('gridstack-dashboard.empty_state_widgets');
    }
}
