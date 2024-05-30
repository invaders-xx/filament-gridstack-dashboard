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

    protected int|Closure $columns = 12;

    protected int|Closure $rows = 0;

    protected bool|Closure $float = true;

    protected bool|Closure $disableDrag = false;

    protected bool|Closure $disableResize = false;

    protected bool|Closure $canAccess = true;

    protected bool|Closure $shouldRegisterNavigation = true;

    protected string|Closure $resizable = 'se';

    protected string|Closure|null $navigationLabel = null;

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

    public function float(bool|Closure $float): static
    {
        $this->float = $float;

        return $this;
    }

    public function disableDrag(bool|Closure $disableDrag = true): static
    {
        $this->disableDrag = $disableDrag;

        return $this;
    }

    public function disableResize(bool|Closure $disableResize = true): static
    {
        $this->disableResize = $disableResize;

        return $this;
    }

    public function resizable(string|Closure $resizable): static
    {
        $this->resizable = $resizable;

        return $this;
    }

    public function canAccess(bool|Closure $canAccess = true): static
    {
        $this->canAccess = $canAccess;

        return $this;
    }

    public function shouldRegisterNavigation(bool|Closure $shouldRegisterNavigation = true): static
    {
        $this->shouldRegisterNavigation = $shouldRegisterNavigation;

        return $this;
    }

    public function navigationLabel(string|Closure $navigationLabel): static
    {
        $this->navigationLabel = $navigationLabel;

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

    public function getNavigationLabel(): ?string
    {
        return $this->evaluate($this->navigationLabel);
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

    public function getFloat(): bool
    {
        return $this->evaluate($this->float);
    }

    public function getResizable(): ?string
    {
        return $this->evaluate($this->resizable);
    }

    public function getDisableDrag(): ?bool
    {
        return $this->evaluate($this->disableDrag);
    }

    public function getCanAccess(): ?bool
    {
        return $this->evaluate($this->canAccess);
    }

    public function getShouldRegisterNavigation(): ?bool
    {
        return $this->evaluate($this->shouldRegisterNavigation);
    }

    public function getDisableResize(): ?bool
    {
        return $this->evaluate($this->disableResize);
    }

    public function boot(Panel $panel): void
    {
    }
}
