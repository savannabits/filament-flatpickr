<p align="center">
    <a href="https://github.com/savannabits/filament-flatpickr/actions?query=workflow%3Arun-tests+branch%3Amain"><img alt="Tests" src="https://img.shields.io/github/actions/workflow/status/savannabits/filament-modules/run-tests.yml?branch=main&label=tests&style=for-the-badge&logo=github"></a>
    <a href="https://github.com/savannabits/filament-flatpickr/actions?query=workflow%fix-php-code-style-issues+branch%3Amain"><img alt="Styling" src="https://img.shields.io/github/actions/workflow/status/savannabits/filament-modules/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=for-the-badge&logo=github"></a>
    <a href="https://laravel.com"><img alt="Laravel v9.x" src="https://img.shields.io/badge/Laravel-v9.x-FF2D20?style=for-the-badge&logo=laravel"></a>
    <a href="https://filamentphp.com"><img alt="Filament v2.x" src="https://img.shields.io/badge/FilamentPHP-v2.x-FB70A9?style=for-the-badge&logo=filament"></a>
    <a href="https://php.net"><img alt="PHP 8.1" src="https://img.shields.io/badge/PHP-8.1-777BB4?style=for-the-badge&logo=php"></a>
    <a href="https://packagist.org/packages/savannabits/filament-flatpickr"><img alt="Packagist" src="https://img.shields.io/packagist/dt/savannabits/filament-flatpickr.svg?style=for-the-badge&logo=count"></a>
</p>

Use **[Flatpickr](https://flatpickr.js.org/)** as your Filament Forms and Panels date picker.

**NB: These docs are for v2.x, which only supports Filament 2.x. For [v3.x Use this Guide](https://github.com/savannabits/filament-flatpickr)**

## Installation

Install the package via composer:

```bash
composer require savannabits/filament-flatpickr
```

Next, publish the package's assets with the following command:

```bash
php artisan vendor:publish --tag="filament-flatpickr-assets" --force
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
You can use the Flatpickr component from this package as a **datepicker, timepicker, datetimepicker, date range picker, week picker, multiple date picker and month picker** based on your configuration.
Most of the fluent config methods are similar to [Flatpickr's official](https://flatpickr.js.org/options/) options in naming.
The rest of the methods are just like the other filament inputs.

Here are some examples of the methods. Refer to Flatpickr's Official Documentation for details on each of the configurations.

```php
use Savannabits\Flatpickr\Flatpickr;

// Basic, Date Field
Flatpickr::make('test_field') // Minimal Config as a datepicker
Flatpickr::make('test_field')
    ->allowInput(true)
    ->altInput(true)
    ->altFormat('F j, Y')
    ->enableTime()
    ->disabledDates(['2023-07-25','2023-07-26'])
    ->minDate(today()->startOfYear())
    ->maxDate(today())
    ->minTime(now()->format('H:i:s'))
    ->maxTime(now()->addHours(12)->format('H:i:s'))
    ->hourIncrement(1)
    ->minuteIncrement(10)
    ->enableSeconds(false)
    ->defaultSeconds(0) //Initial value of the seconds element, when no date is selected 
    ->defaultMinute(00)
    ->allowInvalidPreload()
    ->altInputClass('sample-class')
    ->animate()
    ->dateFormat('Y-m-d')
    ->ariaDateFormat('Y-m-d')
    ->clickOpens(true)
    ->closeOnSelect(true)
    ->conjunction(',')
    ->inline(true)
    ->disableMobile(true)
    ->theme(\Savannabits\Flatpickr\Enums\FlatpickrTheme::AIRBNB)
    ->mode(\Savannabits\Flatpickr\Enums\FlatpickrMode::RANGE)
    ->monthSelectorType(\Savannabits\Flatpickr\Enums\FlatpickrMonthSelectorType::DROPDOWN)
    ->shorthandCurrentMonth(true)
    ->nextArrow('>')
    ->prevArrow('<')
    ->noCalendar(true)
    ->position(\Savannabits\Flatpickr\Enums\FlatpickrPosition::AUTO_CENTER)
    ->showMonths(1)
    ->weekNumbers(true)
    ->use24hr(true)
    ->wrap(true)
;
Flatpickr::make('published_at')->enableTime() // Use as a DateTimePicker
Flatpickr::make('week')->weekSelect() // Use as a Week Picker
Flatpickr::make('report_month')->monthSelect() // Use as a Month Picker
Flatpickr::make('start_time')->time() // Use as a TimePicker
Flatpickr::make('filter_range')->range() // Use as a Date Range Picker
Flatpickr::make('list_of_dates')->multiple() // Use as a Multiple Date Picker
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
