
# Flatpickr Date/Time Picker as a Filament Field

[![Latest Version on Packagist](https://img.shields.io/packagist/v/savannabits/filament-flatpickr.svg?style=flat-square)](https://packagist.org/packages/savannabits/filament-flatpickr)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/savannabits/filament-flatpickr/run-tests?label=tests)](https://github.com/savannabits/filament-flatpickr/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/savannabits/filament-flatpickr/Fix%20PHP%20code%20style%20issues?label=code%20style)](https://github.com/savannabits/filament-flatpickr/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/savannabits/filament-flatpickr.svg?style=flat-square)](https://packagist.org/packages/savannabits/filament-flatpickr)

Flatpickr is one of the most popular js datepickers. This filament plugin allows you to use flatpickr as a Filament Field without the sweat of configuration.

![image](https://user-images.githubusercontent.com/5610289/183527622-4d26a2cb-ed8b-46d6-ba57-08aeeccdd7d6.png)
![image](https://user-images.githubusercontent.com/5610289/183527983-17401461-a1eb-4ba4-a83e-d65b267b8a7d.png)

## Features
- Configure easily using fluent (chained) methods
- Supports an optional month Selector
- Supports an optional week selector
- Support for both light and dark modes
- Specify the theme (among the available themes) as a configuration
- Supports Range Selection mode
- Supports multiple date selection mode
- And many more features are coming...

## Installation

You can install the package via composer:

```bash
composer require savannabits/filament-flatpickr
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="filament-flatpickr-config"
```

This is the contents of the published config file:

```php
return [
    'default_theme' => 'airbnb', // 'default','dark','material_blue','material_green','material_red','material_orange','airbnb','confetti'
];
```
If you are using a custom filament theme (using tailwind.config.js), append the following to `tailwind.config.js` under `content` for proper styling:
```js
module.exports = {
    content: [
        ...,
        './vendor/savannabits/filament-flatpickr/**/*.blade.php', // <== Add this line
    ],
```

## Usage
Use the `Flatpickr` field anywhere in your filament forms as shown in the following examples
```php
use Savannabits\Flatpickr\Flatpickr;

// Basic, Date Field
Flatpickr::make('read_at')->default(now()),
```
![image](https://user-images.githubusercontent.com/5610289/183526410-e1318643-f9ee-4a5b-b344-4eb1dcf86cf9.png)

```php
// Datetime field
Flatpickr::make('read_at')->enableTime(),
```
![image](https://user-images.githubusercontent.com/5610289/183526312-f76afd0f-2132-4179-9120-e6730beb7093.png)
```php
// Month Selector field
Flatpickr::make('read_at')->monthSelect(),
```
![image](https://user-images.githubusercontent.com/5610289/183527776-09de10a0-9caa-4c73-a114-0855c1d72c67.png)

```php
// Date Range picker field
Flatpickr::make('read_at')->rangePicker(),
```
![image](https://user-images.githubusercontent.com/5610289/183526584-121d9062-5a4a-487f-8afc-1b118c4ac474.png)

```php
// Specify the Date format
Flatpickr::make('read_at')->dateFormat('Y-m-d'),

// Toggle AltInput (true by default) and set Alt Display Format:
Flatpickr::make('read_at')->altInput(true)->altFormat('F J Y'),
```
![image](https://user-images.githubusercontent.com/5610289/183525593-ff27da63-199f-4cda-b444-74cae729d5be.png)
```php
// Specify the input Date Format
Flatpickr::make('read_at')->dateFormat('d/m/Y')->altInput(false),
```
![image](https://user-images.githubusercontent.com/5610289/183526041-9dbebc2b-14b9-400b-8362-434719cd556b.png)

```php
// Specify the Datepicker's Theme: See for https://flatpickr.js.org/themes/ available themes
Flatpickr::make('read_at')->theme('material_red'),
```
![image](https://user-images.githubusercontent.com/5610289/183527163-62abbf8c-436d-4609-aa17-4cd135780ce8.png)
## Automatic dark mode:
![image](https://user-images.githubusercontent.com/5610289/183527360-952ff77f-df8b-4f5b-b00b-489b302b43fa.png)


## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](https://github.com/savannabits/.github/blob/main/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Savannabits](https://github.com/savannabits)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
