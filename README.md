# Create and manage filament Dashboards using gridstack js

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

you can configure the settings path (string in dotted format where to store in the settings)
By default the path is 'dashboard.layout'

```php
use InvadersXX\FilamentGridstackDashboard\GridstackDashboardPlugin;

public function panel(Panel $panel): Panel
{
    return $panel
        ->plugins([
            GridstackDashboardPlugin::make()->settingsPath('dashboard.settings'),
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
