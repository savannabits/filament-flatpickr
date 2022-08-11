<?php

namespace Savannabits\Flatpickr;

use Filament\PluginServiceProvider;
use Spatie\LaravelPackageTools\Package;

class FlatpickrServiceProvider extends PluginServiceProvider
{
    protected array $styles = [
        'flatpickr-css' => __DIR__.'/../public/dist/flatpickr.min.css',
        'month-select-style' => __DIR__.'/../public/dist/plugins/monthSelect/style.css',
        'confirm-date-style' => __DIR__.'/../public/dist/plugins/confirmDate/confirmDate.css',
    ];

    protected array $beforeCoreScripts = [
        'flatpickr-core' => __DIR__.'/../public/dist/flatpickr.min.js',
        'flatpickr-range-plugin' => __DIR__.'/../public/dist/plugins/rangePlugin.js',
        'flatpickr-month-select' => __DIR__.'/../public/dist/plugins/monthSelect/index.js',
        'flatpickr-week-select' => __DIR__.'/../public/dist/plugins/weekSelect/weekSelect.js',
        'flatpickr-confirm-date' => __DIR__.'/../public/dist/plugins/confirmDate/confirmDate.js',
        'filament-flatpickr' => __DIR__.'/../resources/dist/datepicker.js',
    ];

    protected array $scripts = [
    ];

    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('filament-flatpickr')
            ->hasConfigFile()
            ->hasViews();
    }

    protected function getScriptData(): array
    {
        return [];
    }
}
