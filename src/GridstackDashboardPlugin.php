<?php

namespace InvadersXX\FilamentGridstackDashboard;

use Closure;
use Filament\Contracts\Plugin;
use Filament\Panel;
use Filament\Support\Concerns\EvaluatesClosures;
use Illuminate\Contracts\Support\Htmlable;
use InvadersXX\FilamentGridstackDashboard\Filament\Pages\Dashboard;

class GridstackDashboardPlugin implements Plugin
{
    use EvaluatesClosures;

    protected string|Closure|null $navigationGroup = null;

    protected string|Closure|null $navigationIcon = null;

    protected string $settingsPath = 'dashboard.layout';

    protected array|Closure $defaultGrid = [];

    protected int|Closure|null $navigationSort = -200;

    protected int|Closure|null $columns = 12;

    protected int|Closure|null $rows = 0;

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

    public function settingsPath(string|Closure $path): static
    {
        $this->settingsPath = $path;

        return $this;
    }

    public function defaultGrid(array|Closure $grid): static
    {
        $this->defaultGrid = $grid;

        return $this;
    }

    public function columns(int|Closure $columns): static
    {
        $this->columns = $columns;

        return $this;
    }

    public function rows(int|Closure $rows): static
    {
        $this->rows = $rows;

        return $this;
    }

    public function navigationSort(int|Closure $navigationSort): static
    {
        $this->navigationSort = $navigationSort;

        return $this;
    }

    public function navigationGroup(string|Closure $navigationGroup): static
    {
        $this->navigationGroup = $navigationGroup;

        return $this;
    }

    public function navigationIcon(string|Closure $navigationIcon): static
    {
        $this->navigationIcon = $navigationIcon;

        return $this;
    }

    public function getSettingsPath(): string
    {
        return $this->evaluate($this->settingsPath);
    }

    public function getDefaultGrid(): array
    {
        return $this->evaluate($this->defaultGrid);
    }

    public function getNavigationSort(): int
    {
        return $this->evaluate($this->navigationSort);
    }

    public function getNavigationGroup(): ?string
    {
        return $this->evaluate($this->navigationGroup);
    }

    public function getNavigationIcon(): string|Htmlable|null
    {
        return $this->evaluate($this->navigationIcon);
    }

    public function getColumns(): int
    {
        return $this->evaluate($this->columns);
    }

    public function getRows(): int
    {
        return $this->evaluate($this->rows);
    }

    public function boot(Panel $panel): void
    {
    }
}
