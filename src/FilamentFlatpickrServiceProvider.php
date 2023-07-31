<?php

namespace Coolsam\FilamentFlatpickr;

use Coolsam\FilamentFlatpickr\Commands\FilamentFlatpickrCommand;
use Filament\Support\Assets\AlpineComponent;
use Filament\Support\Assets\Css;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentFlatpickrServiceProvider extends PackageServiceProvider
{
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
            ->hasViews()
            ->hasCommand(FilamentFlatpickrCommand::class);
    }

    public function packageBooted()
    {
        FilamentAsset::register([
            /*Js::make('flatpickr-core', __DIR__ . '/../resources/assets/flatpickr/dist/flatpickr.js'),
            Js::make('flatpickr-range-plugin', __DIR__ . '/../resources/assets/flatpickr/dist/plugins/rangePlugin.js'),
            Js::make('flatpickr-confirm-date', __DIR__ . '/../resources/assets/flatpickr/dist/plugins/confirmDate/confirmDate.js'),
            Js::make('flatpickr-month-select-plugin', __DIR__ . '/../resources/assets/flatpickr/dist/plugins/monthSelect/index.js'),
            Js::make('flatpickr-week-select-plugin', __DIR__ . '/../resources/assets/flatpickr/dist/plugins/weekSelect/weekSelect.js'),
            Css::make('flatpickr-css', __DIR__ . '/../resources/assets/flatpickr/dist/flatpickr.css'),
            Css::make('month-select-style', __DIR__ . '/../resources/assets/flatpickr/dist/plugins/monthSelect/style.css'),
            Css::make('flatpickr-confirm-date-style', __DIR__ . '/../resources/assets/flatpickr/dist/plugins/confirmDate/confirmDate.css'),
            Css::make('flatpickr-airbnb-theme', __DIR__ . '/../resources/assets/flatpickr/dist/themes/airbnb.css'),
            Css::make('flatpickr-confetti-theme', __DIR__ . '/../resources/assets/flatpickr/dist/themes/confetti.css'),
            Css::make('flatpickr-dark-theme', __DIR__ . '/../resources/assets/flatpickr/dist/themes/dark.css'),
            Css::make('flatpickr-light-theme', __DIR__ . '/../resources/assets/flatpickr/dist/themes/light.css'),
            Css::make('flatpickr-material_blue-theme', __DIR__ . '/../resources/assets/flatpickr/dist/themes/material_blue.css'),
            Css::make('flatpickr-material_green-theme', __DIR__ . '/../resources/assets/flatpickr/dist/themes/material_green.css'),
            Css::make('flatpickr-material_orange-theme', __DIR__ . '/../resources/assets/flatpickr/dist/themes/material_orange.css'),
            Css::make('flatpickr-material_red-theme', __DIR__ . '/../resources/assets/flatpickr/dist/themes/material_red.css'),*/

            AlpineComponent::make('flat-datepicker', __DIR__ . '/../resources/js/dist/components/datepicker.js'),
        ], package: FilamentFlatpickr::getPackageName());
    }
}
