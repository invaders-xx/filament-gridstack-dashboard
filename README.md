![invaders-xx-gridstack-dashboard](https://github.com/invaders-xx/filament-gridstack-dashboard/assets/604907/7b94f470-9e83-4cc5-95af-e5794db76feb)

# Create and manage filament Dashboards using gridstack js

<img width="1715" alt="image" src="https://github.com/invaders-xx/filament-gridstack-dashboard/assets/604907/cadb4346-d3fe-4749-ba6e-0e4eed2c9576">

<img width="1715" alt="image" src="https://github.com/invaders-xx/filament-gridstack-dashboard/assets/604907/f41809b0-3ef0-4dd9-a894-ff199050ca2d">


[![Latest Version on Packagist](https://img.shields.io/packagist/v/invaders-xx/filament-gridstack-dashboard.svg?style=flat-square)](https://packagist.org/packages/invaders-xx/filament-gridstack-dashboard)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/invaders-xx/filament-gridstack-dashboard/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/invaders-xx/filament-gridstack-dashboard/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/invaders-xx/filament-gridstack-dashboard/fix-php-code-styling.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/invaders-xx/filament-gridstack-dashboard/actions?query=workflow%3A"Fix+PHP+code+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/invaders-xx/filament-gridstack-dashboard.svg?style=flat-square)](https://packagist.org/packages/invaders-xx/filament-gridstack-dashboard)

This package allows to add widgets and define the layout of the dashboard page on a per-user basic. This package
uses [Laravel model settings](https://github.com/glorand/laravel-model-settings) package to ensure persistence of data
in the database.

## Installation

You can install the package via composer:

```bash
composer require invaders-xx/filament-gridstack-dashboard
```

```bash
php artisan filament:assets
```

> **Note: Add plugin Blade files to your custom theme `tailwind.config.js` for dark mode.**
>
> To set up your own custom theme, you can visit
> the [official instruction page](https://filamentphp.com/docs/3.x/panels/themes#creating-a-custom-theme) on the
> Filament
> website.

Add the plugin's views to your `tailwind.config.js` file.

```js
content: [
    '<path-to-vendor>/invaders-xx/filament-gridstack-dashboard/resources/**/*.blade.php',
]
```

Please visit [Laravel model settings](https://github.com/glorand/laravel-model-settings) to configure your User model to
use
this package.

You can publish the config file with:

```bash
php artisan vendor:publish --tag="filament-gridstack-dashboard-config"
```

This is the contents of the published config file:

```php
return [
];
```

There is no option at the moment.

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="filament-gridstack-dashboard-views"
```

## Usage

All functions used to configure the plugin can have a closure as argument.

```php
use InvadersXX\FilamentGridstackDashboard\GridstackDashboardPlugin;

public function panel(Panel $panel): Panel
{
    return $panel
        ->plugins([
            GridstackDashboardPlugin::make()
        ])
}
```

You can configure the number of columns of the grid. Default is 12.

```php
use InvadersXX\FilamentGridstackDashboard\GridstackDashboardPlugin;

public function panel(Panel $panel): Panel
{
    return $panel
        ->plugins([
            GridstackDashboardPlugin::make()
                ->columns(3),
        ])
}
```

You can configure the number of rows of the grid. Default is 0 (no constraint).

```php
use InvadersXX\FilamentGridstackDashboard\GridstackDashboardPlugin;

public function panel(Panel $panel): Panel
{
    return $panel
        ->plugins([
            GridstackDashboardPlugin::make()
                ->rows(3),
        ])
}
```

You can configure the settings path (string in dotted format where to store in the settings)
By default the path is 'dashboard.layout'

```php
use InvadersXX\FilamentGridstackDashboard\GridstackDashboardPlugin;

public function panel(Panel $panel): Panel
{
    return $panel
        ->plugins([
            GridstackDashboardPlugin::make()
                ->settingsPath('dashboard.settings'),
        ])
}
```

You can enable/disable floating widgets (default: true).

```php
use InvadersXX\FilamentGridstackDashboard\GridstackDashboardPlugin;

public function panel(Panel $panel): Panel
{
    return $panel
        ->plugins([
            GridstackDashboardPlugin::make()
                ->float(false),
        ])
}
```

You can enable/disable dragging widgets (default: false).

```php
use InvadersXX\FilamentGridstackDashboard\GridstackDashboardPlugin;

public function panel(Panel $panel): Panel
{
    return $panel
        ->plugins([
            GridstackDashboardPlugin::make()
                ->disableDrag(true),
        ])
}
```

You can enable/disable resizing widgets (default: false).

```php
use InvadersXX\FilamentGridstackDashboard\GridstackDashboardPlugin;

public function panel(Panel $panel): Panel
{
    return $panel
        ->plugins([
            GridstackDashboardPlugin::make()
                ->disableResize(true),
        ])
}
```

You can specify resizing handles position of widgets. It can be any combination of n,ne,e,se,s,sw,w,nw or all (
default: 'se').

```php
use InvadersXX\FilamentGridstackDashboard\GridstackDashboardPlugin;

public function panel(Panel $panel): Panel
{
    return $panel
        ->plugins([
            GridstackDashboardPlugin::make()
                ->resizable('all'),
        ])
}
```

You can configure the navigationIcon, the navigationGroup, the navigationLabel, the navigationSort, canAccess and
shouldRegisterNavigation

```php
use InvadersXX\FilamentGridstackDashboard\GridstackDashboardPlugin;

public function panel(Panel $panel): Panel
{
    return $panel
        ->plugins([
            GridstackDashboardPlugin::make()
                ->navigationIcon('heroicon-o-chart-bar')
                ->navigationGroup('Admin')
                ->shouldRegisterNavigation(false)
                ->canAccess(fn() => auth()->id()===1)
                ->navigationLabel('Dashboard')
                ->navigationSort(1),
        ])
}
```

You can configure a default grid using defaultGrid() function. This function has an array as parameter. This array
should have the following format:

```php
[
    'widget' => AccountWidget::class, // Widget class
    'x' => 0, // starting column on the grid
    'y' => 0, // row on the grid
    'w' => 12, // number of columns on the grid
]
```

FYI, a 12 columns grid, x goes from 0 to 11

```php
use InvadersXX\FilamentGridstackDashboard\GridstackDashboardPlugin;
use Filament\Widgets\AccountWidget;
public function panel(Panel $panel): Panel
{
    return $panel
        ->plugins([
            GridstackDashboardPlugin::make()
                ->defaultGrid([
                    [
                        'widget' => AccountWidget::class,
                        'x' => 0,
                        'y' => 0,
                        'w' => 12,
                    ],
                ]),
        ])
}
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [David Vincent](https://github.com/invaders-xx)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
