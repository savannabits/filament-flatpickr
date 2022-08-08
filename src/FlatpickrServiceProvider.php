<?php

namespace Savannabits\Flatpickr;

use Filament\FilamentServiceProvider;
use Filament\PluginServiceProvider;
use Illuminate\Foundation\Vite;
use Spatie\LaravelPackageTools\Package;
use Savannabits\Flatpickr\Commands\FlatpickrCommand;

class FlatpickrServiceProvider extends PluginServiceProvider
{
    protected array $styles = [
       'flatpickr-css'  => __DIR__.'/../public/dist/flatpickr.min.css',
        'monthselect-style' =>__DIR__.'/../public/dist/plugins/monthSelect/style.css',
    ];
    protected array $beforeCoreScripts = [
        'flatpickr-js' =>      __DIR__.'/../public/dist/flatpickr.min.js',
    ];
    protected array $scripts = [
        'range-plugin' => __DIR__.'/../public/dist/plugins/rangePlugin.js',
        'month-select' => __DIR__.'/../public/dist/plugins/monthSelect/index.js'
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
