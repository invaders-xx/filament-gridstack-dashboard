<?php

namespace InvadersXX\FilamentGridstackDashboard;

use Filament\Support\Assets\AlpineComponent;
use Filament\Support\Assets\Asset;
use Filament\Support\Assets\Css;
use Filament\Support\Facades\FilamentAsset;
use Filament\Support\Facades\FilamentIcon;
use Illuminate\Filesystem\Filesystem;
use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentGridstackDashboardServiceProvider extends PackageServiceProvider
{
    public static string $name = 'filament-gridstack-dashboard';

    public static string $viewNamespace = 'filament-gridstack-dashboard';

    public function configurePackage(Package $package): void
    {
        $package->name(static::$name)
            ->hasCommands($this->getCommands())
            ->hasConfigFile('gridstack-dashboard')
            ->hasMigrations($this->getMigrations())
            ->hasViews(static::$viewNamespace)
            ->hasTranslations()
            ->hasInstallCommand(function (InstallCommand $command) {
                $command
                    ->publishConfigFile()
                    ->askToStarRepoOnGitHub('invaders-xx/filament-gridstack-dashboard');
            });
    }

    public function packageRegistered(): void
    {
    }

    public function packageBooted(): void
    {
        // Asset Registration
        FilamentAsset::register(
            $this->getAssets(),
            $this->getAssetPackageName()
        );

        FilamentAsset::registerScriptData(
            $this->getScriptData(),
            $this->getAssetPackageName()
        );

        // Icon Registration
        FilamentIcon::register($this->getIcons());

        // Handle Stubs
        if (app()->runningInConsole()) {
            foreach (app(Filesystem::class)->files(__DIR__ . '/../stubs/') as $file) {
                $this->publishes([
                    $file->getRealPath() => base_path("stubs/filament-gridstack-dashboard/{$file->getFilename()}"),
                ], 'filament-gridstack-dashboard-stubs');
            }
        }

        // Testing
    }

    /**
     * @return array<class-string>
     */
    protected function getCommands(): array
    {
        return [];
    }

    /**
     * @return array<string>
     */
    protected function getMigrations(): array
    {
        return [];
    }

    /**
     * @return array<Asset>
     */
    protected function getAssets(): array
    {
        return [
            AlpineComponent::make('filament-gridstack-dashboard-script', __DIR__ . '/../resources/dist/components/filament-gridstack-dashboard.js'),
            Css::make('filament-gridstack-dashboard-styles', __DIR__ . '/../resources/dist/filament-gridstack-dashboard.css')->loadedOnRequest(),
            // Js::make('filament-gridstack-dashboard-scripts', __DIR__ . '/../resources/dist/filament-gridstack-dashboard.js')->loadedOnRequest(),
        ];
    }

    protected function getAssetPackageName(): ?string
    {
        return 'invaders-xx/filament-gridstack-dashboard';
    }

    /**
     * @return array<string, mixed>
     */
    protected function getScriptData(): array
    {
        return [];
    }

    /**
     * @return array<string>
     */
    protected function getIcons(): array
    {
        return [];
    }

    /**
     * @return array<string>
     */
    protected function getRoutes(): array
    {
        return [];
    }
}
