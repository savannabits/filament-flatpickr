<?php

namespace Savannabits\Flatpickr;

use Filament\FilamentManager;
use Filament\PluginServiceProvider;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FlatpickrServiceProvider extends PackageServiceProvider
{
    protected array $styles = [
        'flatpickr-css' => __DIR__ . '/../resources/dist/flatpickr/flatpickr.css',
        'month-select-style' => __DIR__ . '/../resources/dist/flatpickr/plugins/monthSelect/style.css',
        'confirm-date-style' => __DIR__ . '/../resources/dist/flatpickr/plugins/confirmDate/confirmDate.css',
    ];

    protected array $beforeCoreScripts = [
//        'flatpickr-core' => __DIR__ . '/../public/dist/flatpickr.min.js',
//        'flatpickr-range-plugin' => __DIR__ . '/../public/dist/plugins/rangePlugin.js',
//        'flatpickr-month-select' => __DIR__ . '/../public/dist/plugins/monthSelect/index.js',
//        'flatpickr-week-select' => __DIR__ . '/../public/dist/plugins/weekSelect/weekSelect.js',
//        'flatpickr-confirm-date' => __DIR__ . '/../public/dist/plugins/confirmDate/confirmDate.js',
//        'async-alpine' => "https://cdn.jsdelivr.net/npm/async-alpine@1.x.x/dist/async-alpine.script.js"
//        'filament-flatpickr' => __DIR__.'/../resources/dist/datepicker.js',
    ];

    protected array $scripts = [
    ];

    public function packageBooted()
    {
        if ($this->app->has('filament')) {
            /**
             * @var FilamentManager $filament
             */
            $filament = $this->app['filament'];
            $filament->serving(function () use ($filament) {
                $filament->registerStyles($this->styles);
                $filament->registerScripts($this->beforeCoreScripts, true);
            });
        }
    }

    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name(Flatpickr::PACKAGE_NAME)
            ->hasConfigFile()
            ->hasAssets()
            ->hasViews();
    }

    protected function getScriptData(): array
    {
        return [];
    }
}
