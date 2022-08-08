
[<img src="https://github-ads.s3.eu-central-1.amazonaws.com/support-ukraine.svg?t=1" />](https://supportukrainenow.org)

# The popular Datetime Picker as a Filament Field

[![Latest Version on Packagist](https://img.shields.io/packagist/v/savannabits/filament-flatpickr.svg?style=flat-square)](https://packagist.org/packages/savannabits/filament-flatpickr)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/savannabits/filament-flatpickr/run-tests?label=tests)](https://github.com/savannabits/filament-flatpickr/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/savannabits/filament-flatpickr/Fix%20PHP%20code%20style%20issues?label=code%20style)](https://github.com/savannabits/filament-flatpickr/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/savannabits/filament-flatpickr.svg?style=flat-square)](https://packagist.org/packages/savannabits/filament-flatpickr)

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Support us

[<img src="https://github-ads.s3.eu-central-1.amazonaws.com/filament-flatpickr.jpg?t=1" width="419px" />](https://spatie.be/github-ad-click/filament-flatpickr)

We invest a lot of resources into creating [best in class open source packages](https://spatie.be/open-source). You can support us by [buying one of our paid products](https://spatie.be/open-source/support-us).

We highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using. You'll find our address on [our contact page](https://spatie.be/about-us). We publish all received postcards on [our virtual postcard wall](https://spatie.be/open-source/postcards).

## Installation

You can install the package via composer:

```bash
composer require savannabits/filament-flatpickr
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="filament-flatpickr-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="filament-flatpickr-config"
```

This is the contents of the published config file:

```php
return [
];
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="filament-flatpickr-views"
```

## Usage

```php
$flatpickr = new Savannabits\Flatpickr();
echo $flatpickr->echoPhrase('Hello, Savannabits!');
```

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
