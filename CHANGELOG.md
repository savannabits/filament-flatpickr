# Changelog

All notable changes to `filament-flatpickr` will be documented in this file.

## 3.0.0 - 2023-08-02

### What's Changed

- Bump actions/configure-pages from 1 to 3 by @dependabot in https://github.com/savannabits/filament-flatpickr/pull/13
- Bump ramsey/composer-install from 1 to 2 by @dependabot in https://github.com/savannabits/filament-flatpickr/pull/9
- Bump aglipanci/laravel-pint-action from 0.1.0 to 2.2.0 by @dependabot in https://github.com/savannabits/filament-flatpickr/pull/16
- Bump actions/deploy-pages from 1 to 2 by @dependabot in https://github.com/savannabits/filament-flatpickr/pull/15
- Bump dependabot/fetch-metadata from 1.3.6 to 1.4.0 by @dependabot in https://github.com/savannabits/filament-flatpickr/pull/20
- Bump dependabot/fetch-metadata from 1.4.0 to 1.5.1 by @dependabot in https://github.com/savannabits/filament-flatpickr/pull/21
- Bump dependabot/fetch-metadata from 1.5.1 to 1.6.0 by @dependabot in https://github.com/savannabits/filament-flatpickr/pull/25
- Bump aglipanci/laravel-pint-action from 2.2.0 to 2.3.0 by @dependabot in https://github.com/savannabits/filament-flatpickr/pull/30
- Version 3 dev: Full Rewrite for Filament 3 by @coolsam726 in https://github.com/savannabits/filament-flatpickr/pull/31
- Readme UPDATE by @coolsam726 in https://github.com/savannabits/filament-flatpickr/pull/32
- Refactored README by @coolsam726 in https://github.com/savannabits/filament-flatpickr/pull/33

**Full Changelog**: https://github.com/savannabits/filament-flatpickr/compare/v1.1.0...3.0.0

## v2.0.0 - 2023-07-27

### What's Changed

- Bump actions/configure-pages from 1 to 3 by @dependabot in https://github.com/savannabits/filament-flatpickr/pull/13
- Bump ramsey/composer-install from 1 to 2 by @dependabot in https://github.com/savannabits/filament-flatpickr/pull/9
- Bump aglipanci/laravel-pint-action from 0.1.0 to 2.2.0 by @dependabot in https://github.com/savannabits/filament-flatpickr/pull/16
- Bump actions/deploy-pages from 1 to 2 by @dependabot in https://github.com/savannabits/filament-flatpickr/pull/15
- Bump dependabot/fetch-metadata from 1.3.6 to 1.4.0 by @dependabot in https://github.com/savannabits/filament-flatpickr/pull/20
- Bump dependabot/fetch-metadata from 1.4.0 to 1.5.1 by @dependabot in https://github.com/savannabits/filament-flatpickr/pull/21
- Bump dependabot/fetch-metadata from 1.5.1 to 1.6.0 by @dependabot in https://github.com/savannabits/filament-flatpickr/pull/25
- 2.x dev - Full Re-Write of the package, with bug fixes by @coolsam726 in https://github.com/savannabits/filament-flatpickr/pull/27

### Improvements and Fixes:

1. Dark mode is now enabled on the fly for the FilamentPHP admin panel.
2. The package can now be used in standalone forms outside the filament admin panel. Closes #1, #2, #6, #23
3. Almost all of Flatpickr's native configuration is now supported out of the box through a fluent interface. Closes #10, #11, #24
4. Alpine.js component is now loading lazily using async-alpine

### Breaking Changes

1. Assets have to be published by running `php artisan vendor:publish --tag=filament-flatpickr-assets` in order to be registered
2. The `rangePicker` and `multiplePicker` methods have been renamed to `range` and `multiple` respectively.
3. Due to the use of enums, the package now only supports **PHP >= 8.1**

**Full Changelog**: https://github.com/savannabits/filament-flatpickr/compare/v1.1.0...v2.0.0

## v1.1.0 - Support for Laravel 10 - 2023-04-08

### What's Changed

- Bump dependabot/fetch-metadata from 1.3.3 to 1.3.4 by @dependabot in https://github.com/savannabits/filament-flatpickr/pull/7
- Bump dependabot/fetch-metadata from 1.3.4 to 1.3.5 by @dependabot in https://github.com/savannabits/filament-flatpickr/pull/8
- Bump dependabot/fetch-metadata from 1.3.5 to 1.3.6 by @dependabot in https://github.com/savannabits/filament-flatpickr/pull/14
- Updated Dependencies to support Laravel 10 by @coolsam726 in https://github.com/savannabits/filament-flatpickr/pull/19
- Support Laravel 10 by @husam-tariq in https://github.com/savannabits/filament-flatpickr/pull/17

### New Contributors

- @dependabot made their first contribution in https://github.com/savannabits/filament-flatpickr/pull/7
- @husam-tariq made their first contribution in https://github.com/savannabits/filament-flatpickr/pull/17

**Full Changelog**: https://github.com/savannabits/filament-flatpickr/compare/v1.0.3...v1.1.0

## v1.0.3 - 2022-08-25

### What's Changed

- Update flatpickr.blade.php by @coolsam726 in https://github.com/savannabits/filament-flatpickr/pull/5

**Full Changelog**: https://github.com/savannabits/filament-flatpickr/compare/v1.0.2...v1.0.3

## v1.0.2 - 2022-08-11

### What's Changed

- Bug Fix: Datepicker not loading in action modals by @coolsam726 in https://github.com/savannabits/filament-flatpickr/pull/2

### New Contributors

- @coolsam726 made their first contribution in https://github.com/savannabits/filament-flatpickr/pull/2

**Full Changelog**: https://github.com/savannabits/filament-flatpickr/compare/v1.0.1...v1.0.2

## v1.0.1 - 2022-08-08

**Full Changelog**: https://github.com/savannabits/filament-flatpickr/compare/v1.0.0...v1.0.1

## v1.0.0 - 2022-08-08

v1.0.0
First Release. Features:

- Configure easily using fluent (chained) methods
- Supports an optional month Selector
- Supports an optional week selector
- Support for both light and dark modes
- Specify the theme (among the available themes) as a configuration
- Supports Range Selection mode
- Supports multiple date selection mode
- And many more features are coming...

**Full Changelog**: https://github.com/savannabits/filament-flatpickr/commits/v1.0.0
