# Settings package for Laravel
[![Version](https://poser.pugx.org/robiussani152/settings/v/stable.svg)](https://github.com/robiussani152/settings/releases)
[![Downloads](https://poser.pugx.org/robiussani152/settings/d/total.svg)](https://github.com/robiussani152/settings)

This package is for managing most basic settings in your laravel application like site title, site logo etc. You can add your custom settings using this package.

## Getting Started

### 1. Install

Run the following command:

```bash
composer require robiussani152/settings
```

### 2. Register (for Laravel < 5.5)

Register the service provider in `config/app.php`

```php
Robiussani152\Settings\SettingServiceProvider::class,
```

Add alias if you want to use the facade.

```php
'Settings' => Robiussani152\Settings\Facades\Settings::class,
```

## Usage

You can use the facade `Setting::get('foo')`

### Facade

```php
Settings::get('foo');
Settings::set('foo', 'bar');
Settings::forget('foo');
$settings = Settings::all();
```
## License

The MIT License (MIT). Please see [LICENSE](LICENSE) for more information.
