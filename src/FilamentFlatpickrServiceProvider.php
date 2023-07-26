<?php

namespace Coolsam\FilamentFlatpickr;

use Filament\Support\Assets\AlpineComponent;
use Filament\Support\Assets\Css;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Coolsam\FilamentFlatpickr\Commands\FilamentFlatpickrCommand;

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
        if (true || app()->runningInConsole()) {
            FilamentAsset::register([
                Js::make('flatpickr-core',                      __DIR__.'/../resources/assets/flatpickr/dist/flatpickr.min.js'),
                Js::make('flatpickr-range-plugin',              __DIR__.'/../resources/assets/flatpickr/dist/plugins/rangePlugin.js'),
                Js::make('flatpickr-confirm-date',              __DIR__.'/../resources/assets/flatpickr/dist/plugins/confirmDate/confirmDate.js'),
                Css::make('flatpickr-css',                      __DIR__.'/../resources/assets/flatpickr/dist/flatpickr.min.css'),
                Css::make('month-select-style',                 __DIR__.'/../resources/assets/flatpickr/dist/plugins/monthSelect/style.css'),
                Css::make('flatpickr-confirm-date-style',       __DIR__.'/../resources/assets/flatpickr/dist/plugins/confirmDate/confirmDate.css'),
                AlpineComponent::make('flat-datepicker',        __DIR__.'/../resources/js/dist/components/datepicker.js')
            ], package:FilamentFlatpickr::getPackageName());
        }
    }
}
