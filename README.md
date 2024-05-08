# Create and manage filament Dashboards using gridstack js

[![Latest Version on Packagist](https://img.shields.io/packagist/v/invaders-xx/filament-gridstack-dashboard.svg?style=flat-square)](https://packagist.org/packages/invaders-xx/filament-gridstack-dashboard)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/invaders-xx/filament-gridstack-dashboard/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/invaders-xx/filament-gridstack-dashboard/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/invaders-xx/filament-gridstack-dashboard/fix-php-code-styling.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/invaders-xx/filament-gridstack-dashboard/actions?query=workflow%3A"Fix+PHP+code+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/invaders-xx/filament-gridstack-dashboard.svg?style=flat-square)](https://packagist.org/packages/invaders-xx/filament-gridstack-dashboard)



This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Installation

You can install the package via composer:

```bash
composer require invaders-xx/filament-gridstack-dashboard
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="filament-gridstack-dashboard-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="filament-gridstack-dashboard-config"
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="filament-gridstack-dashboard-views"
```

This is the contents of the published config file:

```php
return [
];
```

## Usage

```php
$filamentGridstackDashboard = new InvadersXX\FilamentGridstackDashboard();
echo $filamentGridstackDashboard->echoPhrase('Hello, InvadersXX!');
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
