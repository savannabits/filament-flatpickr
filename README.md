<p align="center">
    <a href="https://github.com/savannabits/filament-flatpickr/actions?query=workflow%3Arun-tests+branch%3A3.x"><img alt="Tests" src="https://img.shields.io/github/actions/workflow/status/savannabits/filament-modules/run-tests.yml?branch=3.x&label=tests&style=for-the-badge&logo=github"></a>
    <a href="https://github.com/savannabits/filament-flatpickr/actions?query=workflow%fix-php-code-style-issues+branch%3A3.x"><img alt="Styling" src="https://img.shields.io/github/actions/workflow/status/savannabits/filament-modules/fix-php-code-style-issues.yml?branch=3.x&label=code%20style&style=for-the-badge&logo=github"></a>
    <a href="https://laravel.com"><img alt="Laravel v9.x" src="https://img.shields.io/badge/Laravel-v9.x-FF2D20?style=for-the-badge&logo=laravel"></a>
    <a href="https://filamentphp.com"><img alt="Filament v3.x" src="https://img.shields.io/badge/FilamentPHP-v3.x-FB70A9?style=for-the-badge&logo=filament"></a>
    <a href="https://php.net"><img alt="PHP 8.1" src="https://img.shields.io/badge/PHP-8.1-777BB4?style=for-the-badge&logo=php"></a>
    <a href="https://packagist.org/packages/savannabits/filament-flatpickr"><img alt="Packagist" src="https://img.shields.io/packagist/dt/savannabits/filament-flatpickr.svg?style=for-the-badge&logo=count"></a>
</p>

Use **[Flatpickr](https://flatpickr.js.org/)** as your datepicker in the Filament Forms and Panels.

> [!IMPORTANT]
> **HELP NEEDED**  
> I need help in maintaining this project, given that I am currently unable to give it sufficient time. If you are willing and able to assist in maintaining the package, please reach out.

**NB: These docs are for v3.x, which only supports Filament 3.x. For Filament v2 users, [use this guide instead](https://github.com/savannabits/filament-flatpickr/tree/main)**

## Installation

Install the package via composer:

```bash
composer require coolsam/flatpickr
```
Next, Run the `filament:assets` command to ensure the package's assets are published:

```bash
php artisan filament:assets
```

You may optionally publish the package's config file with the following command:

```bash
php artisan vendor:publish --tag="coolsam-flatpickr-config"
```

## Usage
You can do a lot with just one Component: `Flatpickr`
You can use the Flatpickr component from this package as:
* DatePicker
* TimePicker
* DateTimePicker
* Range Picker
* Week Picker,
* Multiple-Date Picker
* Month Picker

Most of the fluent config methods are similar to [Flatpickr's official](https://flatpickr.js.org/options/) options in naming.
The rest of the configuration is similar to a normal Filament `TextInput`.

Here are some examples of the methods. Refer to Flatpickr's Official Documentation for details on each of the configurations.

```php
use Coolsam\FilamentFlatpickr\Forms\Components\Flatpickr;

// Basic, Date Field
Flatpickr::make('test_field') // Minimal Config as a datepicker
Flatpickr::make('test_field')
    ->allowInput() // Allow a user to manually input the date in the textbox (make the textbox editable)
    ->altInput(true) // Enable the use of Alternative Input (See Flatpickr docs)
    ->altFormat('F j, Y') // Alternative input format
    ->enableTime() // Turn this into a DateTimePicker
    ->disabledDates(['2023-07-25','2023-07-26']) // Disable specific dates from being selected.
    ->minDate(today()->startOfYear()) // Set the minimum allowed date
    ->maxDate(today()) // Set the maximum allowed date.
    ->minTime(now()->format('H:i:s')) // Set the minimum allowed time
    ->maxTime(now()->addHours(12)->format('H:i:s')) // Set the maximum allowed time
    ->hourIncrement(1) // Intervals of incrementing hours in a time picker
    ->minuteIncrement(10) // Intervals of minute increment in a time picker
    ->enableSeconds(false) // Enable seconds in a time picker
    ->defaultSeconds(0) //Initial value of the seconds element, when no date is selected 
    ->defaultMinute(00) // Initial value of the minutes element, when no date is selected
    ->allowInvalidPreload() // Initially check if the selected date is valid
    ->altInputClass('sample-class') // Add a css class for the alt input format
    ->animate() // Animate transitions in the datepicker.
    ->dateFormat('Y-m-d') // Set the main date format
    ->ariaDateFormat('Y-m-d') // Aria
    ->clickOpens(true) // Open the datepicker when the input is clicked.
    ->closeOnSelect(true) // Close the datepicker once the date is selected.
    ->conjunction(',') // Applicable only for the MultiDatePicker: Separate inputs using this conjunction. The package will use this conjunction to explode the inputs to an array.
    ->inline(true) // Display the datepicker inline with the input, instead of using a popover.
    ->disableMobile(true) // Disable mobile-version of the datepicker on mobile devices.
    ->theme(\Coolsam\FilamentFlatpickr\Enums\FlatpickrTheme::AIRBNB) // Set the datepicker theme (applies for all the date-pickers in the current page). For type sanity, Checkout the FlatpickrTheme enum class for a list of allowed themes.
    ->mode(\Coolsam\FilamentFlatpickr\Enums\FlatpickrMode::RANGE) // Set the mode as single, range or multiple. Alternatively, you can just use ->range() or ->multiple()
    ->monthSelectorType(\Coolsam\FilamentFlatpickr\Enums\FlatpickrMonthSelectorType::DROPDOWN)
    ->shorthandCurrentMonth(true)
    ->nextArrow('>')
    ->prevArrow('<')
    ->noCalendar(true)
    ->position(\Coolsam\FilamentFlatpickr\Enums\FlatpickrPosition::AUTO_CENTER)
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
