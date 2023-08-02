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
            ->name('coolsam-flatpickr')
            ->hasConfigFile()
            ->hasViews()
            ->hasCommand(FilamentFlatpickrCommand::class);
    }

    public function packageBooted()
    {
        FilamentAsset::register([
            Js::make('flatpickr-range-plugin', __DIR__ . '/../resources/assets/flatpickr/dist/plugins/rangePlugin.js'),
            Js::make('flatpickr-confirm-date', __DIR__ . '/../resources/assets/flatpickr/dist/plugins/confirmDate/confirmDate.js'),
            Js::make('flatpickr-month-select-plugin', __DIR__ . '/../resources/assets/flatpickr/dist/plugins/monthSelect/index.js')->loadedOnRequest(),
            Js::make('flatpickr-week-select-plugin', __DIR__ . '/../resources/assets/flatpickr/dist/plugins/weekSelect/weekSelect.js')->loadedOnRequest(),
            Css::make('flatpickr-css', __DIR__ . '/../resources/assets/flatpickr/dist/flatpickr.css')->loadedOnRequest(),
            Css::make('month-select-style', __DIR__ . '/../resources/assets/flatpickr/dist/plugins/monthSelect/style.css')->loadedOnRequest(),
            Css::make('flatpickr-confirm-date-style', __DIR__ . '/../resources/assets/flatpickr/dist/plugins/confirmDate/confirmDate.css')->loadedOnRequest(),
            Css::make('flatpickr-airbnb-theme', __DIR__ . '/../resources/assets/flatpickr/dist/themes/airbnb.css')->loadedOnRequest(),
            Css::make('flatpickr-confetti-theme', __DIR__ . '/../resources/assets/flatpickr/dist/themes/confetti.css')->loadedOnRequest(),
            Css::make('flatpickr-dark-theme', __DIR__ . '/../resources/assets/flatpickr/dist/themes/dark.css')->loadedOnRequest(),
            Css::make('flatpickr-light-theme', __DIR__ . '/../resources/assets/flatpickr/dist/themes/light.css')->loadedOnRequest(),
            Css::make('flatpickr-default-theme', __DIR__ . '/../resources/assets/flatpickr/dist/themes/light.css')->loadedOnRequest(),
            Css::make('flatpickr-material_blue-theme', __DIR__ . '/../resources/assets/flatpickr/dist/themes/material_blue.css')->loadedOnRequest(),
            Css::make('flatpickr-material_green-theme', __DIR__ . '/../resources/assets/flatpickr/dist/themes/material_green.css')->loadedOnRequest(),
            Css::make('flatpickr-material_red-theme', __DIR__ . '/../resources/assets/flatpickr/dist/themes/material_red.css')->loadedOnRequest(),
            Css::make('flatpickr-material_orange-theme', __DIR__ . '/../resources/assets/flatpickr/dist/themes/material_orange.css')->loadedOnRequest(),
            AlpineComponent::make('flatpickr-component', __DIR__ . '/../resources/js/dist/components/flatpickr-component.js')->loadedOnRequest(),
        ], package: FilamentFlatpickr::getPackageName());
    }
}
