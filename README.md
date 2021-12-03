# Lighthouse Validator Assertions

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/daniel-de-wit/lighthouse-validator-assertions/run-tests?label=tests)](https://github.com/daniel-de-wit/lighthouse-validator-assertions/actions?query=workflow%3Atests+branch%3Amaster)
[![Coverage Status](https://coveralls.io/repos/github/daniel-de-wit/lighthouse-validator-assertions/badge.svg?branch=master)](https://coveralls.io/github/daniel-de-wit/lighthouse-validator-assertions?branch=master)
[![Latest Version on Packagist](https://img.shields.io/packagist/v/daniel-de-wit/lighthouse-validator-assertions.svg?style=flat-square)](https://packagist.org/packages/daniel-de-wit/lighthouse-validator-assertions)
[![Total Downloads](https://img.shields.io/packagist/dt/daniel-de-wit/lighthouse-validator-assertions.svg?style=flat-square)](https://packagist.org/packages/daniel-de-wit/lighthouse-validator-assertions)

A Laravel Package for adding eloquent methods support to [Laravel IDE Helper](https://github.com/barryvdh/laravel-ide-helper).

Features
 - `find`
 - `findOrFail`

## Installation

You can install the package via composer:

```bash
composer require --dev daniel-de-wit/laravel-ide-helper-hook-eloquent
```

The Eloquent Hook is loaded using [Package Discovery](https://laravel.com/docs/8.x/packages#package-discovery), when disabled read [Manual Installation](#manual-installation).

## Usage

Run standard model generation commands as normal:

`php artisan ide-helper:models "App\Models\Post"`

## Manual Installation
When disabled, register the LaravelIdeHelperHookEloquentServiceProvider manually by adding it to your config/app.php
```php
/*
 * Package Service Providers...
 */
 DanielDeWit\LaravelIdeHelperHookEloquent\Providers\LaravelIdeHelperHookEloquentServiceProvider::class,
```

## Testing

```bash
composer test
```

## Credits

- [Daniel de Wit](https://github.com/daniel-de-wit)
- [All Contributors](https://github.com/daniel-de-wit/php-cs-fixer-rules/graphs/contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
