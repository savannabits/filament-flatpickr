<?php

namespace Savannabits\Flatpickr;

use Savannabits\Flatpickr\Commands\FlatpickrCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FlatpickrServiceProvider extends PackageServiceProvider
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
            ->hasMigration('create_filament-flatpickr_table')
            ->hasCommand(FlatpickrCommand::class);
    }
}
