<?php

namespace Savannabits\Flatpickr;

use Carbon\Carbon;
use Carbon\CarbonInterface;
use Filament\Forms\Components\Field;
use Savannabits\Flatpickr\Enums\FlatpickrMode;
use Savannabits\Flatpickr\Enums\FlatpickrMonthSelectorType;
use Savannabits\Flatpickr\Enums\FlatpickrPosition;
use Savannabits\Flatpickr\Enums\FlatpickrTheme;

class Flatpickr extends Field
{
    const PACKAGE_NAME = 'filament-flatpickr';

    protected string $view = 'filament-flatpickr::flatpickr';

    protected bool $monthSelect = false;

    protected bool $time = false;

    protected bool $weekSelect = false;

    protected bool $rangePicker = false;

    protected FlatpickrMode $mode = FlatpickrMode::SINGLE;

    protected bool $multiplePicker = false;

    protected bool $altInput = false;

    protected array $config = [];

    protected ?string $altFormat = 'F j, Y';

    protected bool $enableTime = false;

    protected ?string $dateFormat = 'Y-m-d';

    protected FlatpickrTheme $theme = FlatpickrTheme::DEFAULT;

    protected ?string $altInputClass = '';

    protected bool $allowInput = false;

    protected bool $allowInvalidPreload = false;

    protected ?string $ariaDateFormat = 'F j, Y';

    protected ?string $conjunction = ',';

    protected bool $clickOpens = true;

    protected int $defaultHour = 12;

    protected int $defaultMinute = 0;

    protected int $defaultSeconds = 0;

    protected array $disabledDates = [];

    protected ?array $enabledDates = null;

    protected bool $disableMobile = false;

    protected bool $enableSeconds = false;

    protected int $hourIncrement = 1;

    protected int $minuteIncrement = 5;

    protected bool $inline = false;

    protected Carbon|string|null $maxDate = null;

    protected Carbon|string|null $minDate = null;

    protected ?string $maxTime = null;

    protected ?string $minTime = null;

    protected ?string $nextArrow = '>';

    protected ?string $prevArrow = '<';

    protected bool $noCalendar = false;

    protected bool $shorthandCurrentMonth = false;

    protected bool $static = false;

    protected bool $use24hr = false;

    protected bool $weekNumbers = false;

    protected bool $wrap = false;

    protected int $showMonths = 1;

    protected FlatpickrPosition $position = FlatpickrPosition::AUTO;

    protected FlatpickrMonthSelectorType $monthSelectorType = FlatpickrMonthSelectorType::DROPDOWN;

    protected bool $animate = true;

    protected bool $closeOnSelect = true;

    public function getConfig(): array
    {
        if ($this->isRangePicker()) {
            $this->mode(FlatpickrMode::RANGE);
        } elseif ($this->isMultiplePicker()) {
            $this->mode(FlatpickrMode::MULTIPLE);
        }
        if ($this->isEnableTime()) {
            if (! \Str::of($this->getDateFormat())->contains('H', ignoreCase: true)) {
                $this->dateFormat('Y-m-d H:i:s');
            }
            if (! \Str::of($this->getAltFormat())->contains('H', ignoreCase: true)) {
                $this->altFormat('F j Y H:i K');
            }
        }
        if ($this->isTime()) {
            $this->mode(FlatpickrMode::TIME);
            $this->noCalendar();
            $this->enableTime();
            if (\Str::of($this->getDateFormat())->contains('Y')) {
                $this->dateFormat($this->isUse24hr() ? 'H:i' : 'h:i K');
            }
        } elseif ($this->isMonthSelect()) {
            $this->mode(FlatpickrMode::SINGLE);
            $this->enableTime(false);
            $this->time(false);
            $this->range(false);
            $this->dateFormat('Y-m');
            $this->altFormat('F J');
            $this->altInput();
        } elseif ($this->isWeekSelect()) {
            $this->mode(FlatpickrMode::SINGLE);
            $this->enableTime(false);
            $this->time(false);
            $this->range(false);
            $this->dateFormat('W');
            $this->altFormat('\Week W');
            $this->altInput();
        }
        $config = [
            'monthSelect' => $this->monthSelect,
            'weekSelect' => $this->weekSelect,
            'mode' => $this->mode->value,
            'altInput' => $this->altInput,
            'altFormat' => $this->altFormat,
            'enableTime' => $this->enableTime,
            'dateFormat' => $this->dateFormat,
            'theme' => $this->theme->value,
            'altInputClass' => $this->altInputClass,
            'allowInput' => $this->allowInput,
            'allowInvalidPreload' => $this->allowInvalidPreload,
            'ariaDateFormat' => $this->ariaDateFormat,
            'conjunction' => $this->conjunction,
            'clickOpens' => $this->clickOpens,
            'defaultHour' => $this->defaultHour,
            'defaultMinute' => $this->defaultMinute,
            'defaultSeconds' => $this->defaultSeconds,
            'disable' => $this->disabledDates,
            'disableMobile' => $this->disableMobile,
            'enableSeconds' => $this->enableSeconds,
            'hourIncrement' => $this->hourIncrement,
            'minuteIncrement' => $this->minuteIncrement,
            'inline' => $this->inline,
            'minDate' => $this->minDate,
            'maxDate' => $this->maxDate,
            'minTime' => $this->minTime,
            'maxTime' => $this->maxTime,
            'nextArrow' => $this->nextArrow,
            'prevArrow' => $this->prevArrow,
            'noCalendar' => $this->noCalendar,
            'shorthandCurrentMonth' => $this->shorthandCurrentMonth,
            'time_24hr' => $this->use24hr,
            'weekNumbers' => $this->weekNumbers,
            'wrap' => $this->wrap,
            'showMonths' => $this->showMonths,
            'position' => $this->position->value,
            'monthSelectorType' => $this->monthSelectorType->value,
            'animate' => $this->animate,
            'closeOnSelect' => $this->closeOnSelect,
        ];
        if ($this->getEnabledDates()) {
            $config['enabled'] = $this->getEnabledDates();
        }

        return $config;
    }

    public function isTime(): bool
    {
        return $this->time;
    }

    public function time(bool $time = true): static
    {
        $this->time = $time;

        return $this;
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->dehydrateStateUsing(static function (Flatpickr $component, $state) {
            return self::dehydratePickerState($component, $state);
        });

        /*$this->rule(
            'date',
            static fn(Flatpickr $component): bool => (!$component->isRangePicker() && !$component->isMultiplePicker() && !$component->isWeekSelect()),
        );*/
    }

    public static function dehydratePickerState($component, $state)
    {
        if (blank($state)) {
            return null;
        }
        if (! $state instanceof CarbonInterface) {
            if ($component->isRangePicker() || $component->getMode() === FlatpickrMode::RANGE) {
                $range = \Str::of($state)->explode(' to ');
                $state = collect($range)->map(fn ($date) => Carbon::parse($date)
                    ->setTimezone(config('app.timezone'))->format($component->getDateFormat()))
                    ->toArray();
            } elseif ($component->isMultiplePicker()) {
                $range = \Str::of($state)->explode($component->getConjunction());
                $state = collect($range)->map(fn ($date) => Carbon::parse($date)
                    ->setTimezone(config('app.timezone'))->format($component->getDateFormat()))
                    ->toArray();
            }
        }

        return $state;
    }

    public function mode(FlatpickrMode $mode): static
    {
        $this->mode = $mode;

        return $this;
    }

    public function getMode(): string
    {
        return $this->mode->value;
    }

    public function altInputClass(?string $altInputClass = ''): static
    {
        $this->altInputClass = $altInputClass;

        return $this;
    }

    public function getAltInputClass(): ?string
    {
        return $this->altInputClass;
    }

    public function allowInput(bool $allowInput = true): static
    {
        $this->allowInput = $allowInput;

        return $this;
    }

    public function isAllowInput(): bool
    {
        return $this->allowInput;
    }

    public function isAllowInvalidPreload(): bool
    {
        return $this->allowInvalidPreload;
    }

    public function allowInvalidPreload(bool $allowInvalidPreload = true): static
    {
        $this->allowInvalidPreload = $allowInvalidPreload;

        return $this;
    }

    public function getAriaDateFormat(): ?string
    {
        return $this->ariaDateFormat;
    }

    public function ariaDateFormat(?string $ariaDateFormat): static
    {
        $this->ariaDateFormat = $ariaDateFormat;

        return $this;
    }

    public function getConjunction(): ?string
    {
        return $this->conjunction;
    }

    public function conjunction(?string $conjunction): static
    {
        $this->conjunction = $conjunction;

        return $this;
    }

    public function isClickOpens(): bool
    {
        return $this->clickOpens;
    }

    public function clickOpens(bool $clickOpens = true): static
    {
        $this->clickOpens = $clickOpens;

        return $this;
    }

    public function getDefaultHour(): int
    {
        return $this->defaultHour;
    }

    public function defaultHour(int $defaultHour): void
    {
        $this->defaultHour = $defaultHour;
    }

    public function getDefaultMinute(): int
    {
        return $this->defaultMinute;
    }

    public function defaultMinute(int $defaultMinute): static
    {
        $this->defaultMinute = $defaultMinute;

        return $this;
    }

    public function getDefaultSeconds(): int
    {
        return $this->defaultSeconds;
    }

    public function defaultSeconds(int $defaultSeconds): static
    {
        $this->defaultSeconds = $defaultSeconds;

        return $this;
    }

    public function getDisabledDates(): array
    {
        return $this->disabledDates;
    }

    public function disabledDates(array $disabledDates = []): static
    {
        $this->disabledDates = $disabledDates;

        return $this;
    }

    public function getEnabledDates(): ?array
    {
        return $this->enabledDates;
    }

    public function enabledDates(array $enabledDates = []): static
    {
        $this->enabledDates = $enabledDates;

        return $this;
    }

    public function isDisableMobile(): bool
    {
        return $this->disableMobile;
    }

    public function disableMobile(bool $disableMobile = true): static
    {
        $this->disableMobile = $disableMobile;

        return $this;
    }

    public function isEnableSeconds(): bool
    {
        return $this->enableSeconds;
    }

    public function enableSeconds(bool $enableSeconds = true): static
    {
        $this->enableSeconds = $enableSeconds;

        return $this;
    }

    public function getHourIncrement(): int
    {
        return $this->hourIncrement;
    }

    public function hourIncrement(int $hourIncrement = 1): static
    {
        $this->hourIncrement = $hourIncrement;

        return $this;
    }

    public function getMinuteIncrement(): int
    {
        return $this->minuteIncrement;
    }

    public function minuteIncrement(int $minuteIncrement = 5): static
    {
        $this->minuteIncrement = $minuteIncrement;

        return $this;
    }

    public function isInline(): bool
    {
        return $this->inline;
    }

    public function inline(bool $inline = true): static
    {
        $this->inline = $inline;

        return $this;
    }

    public function getMaxDate(): Carbon|string|null
    {
        return $this->maxDate;
    }

    public function maxDate(Carbon|string|null $maxDate = 'now'): static
    {
        $this->maxDate = $maxDate ? Carbon::parse($maxDate) : $maxDate;

        return $this;
    }

    public function getMinDate(): Carbon|string|null
    {
        return $this->minDate;
    }

    public function minDate(Carbon|string|null $minDate): static
    {
        $this->minDate = $minDate ? Carbon::parse($minDate) : $minDate;

        return $this;
    }

    public function getMaxTime(): ?string
    {
        return $this->maxTime;
    }

    public function maxTime(?string $maxTime): static
    {
        $this->maxTime = $maxTime;

        return $this;
    }

    public function getMinTime(): ?string
    {
        return $this->minTime;
    }

    public function minTime(?string $minTime): static
    {
        $this->minTime = $minTime;

        return $this;
    }

    public function getNextArrow(): ?string
    {
        return $this->nextArrow;
    }

    public function nextArrow(?string $nextArrow = '>'): static
    {
        $this->nextArrow = $nextArrow;

        return $this;
    }

    public function isNoCalendar(): bool
    {
        return $this->noCalendar;
    }

    public function noCalendar(bool $noCalendar = true): static
    {
        $this->noCalendar = $noCalendar;

        return $this;
    }

    public function isShorthandCurrentMonth(): bool
    {
        return $this->shorthandCurrentMonth;
    }

    public function shorthandCurrentMonth(bool $shorthandCurrentMonth = true): static
    {
        $this->shorthandCurrentMonth = $shorthandCurrentMonth;

        return $this;
    }

    public function isStatic(): bool
    {
        return $this->static;
    }

    public function static(bool $static = true): static
    {
        $this->static = $static;

        return $this;
    }

    public function isUse24hr(): bool
    {
        return $this->use24hr;
    }

    public function use24hr(bool $use24hr = true): static
    {
        $this->use24hr = $use24hr;

        return $this;
    }

    public function isWeekNumbers(): bool
    {
        return $this->weekNumbers;
    }

    public function weekNumbers(bool $weekNumbers = true): static
    {
        $this->weekNumbers = $weekNumbers;

        return $this;
    }

    public function isWrap(): bool
    {
        return $this->wrap;
    }

    public function wrap(bool $wrap = true): static
    {
        $this->wrap = $wrap;

        return $this;
    }

    public function getShowMonths(): int
    {
        return $this->showMonths;
    }

    public function showMonths(int $showMonths = 1): static
    {
        $this->showMonths = $showMonths;

        return $this;
    }

    public function getPosition(): string
    {
        return $this->position->value;
    }

    public function position(FlatpickrPosition $position): static
    {
        $this->position = $position;

        return $this;
    }

    public function getMonthSelectorType(): string
    {
        return $this->monthSelectorType->value;
    }

    public function monthSelectorType(FlatpickrMonthSelectorType $monthSelectorType): static
    {
        $this->monthSelectorType = $monthSelectorType;

        return $this;
    }

    public function isAnimate(): bool
    {
        return $this->animate;
    }

    public function animate(bool $animate = true): static
    {
        $this->animate = $animate;

        return $this;
    }

    public function isCloseOnSelect(): bool
    {
        return $this->closeOnSelect;
    }

    public function closeOnSelect(bool $closeOnSelect = true): static
    {
        $this->closeOnSelect = $closeOnSelect;

        return $this;
    }

    public function getPrevArrow(): ?string
    {
        return $this->prevArrow;
    }

    public function prevArrow(?string $prevArrow): static
    {
        $this->prevArrow = $prevArrow;

        return $this;
    }

    public function weekSelect(bool $weekSelect = true): static
    {
        $this->weekSelect = $weekSelect;

        return $this;
    }

    public function isWeekSelect(): bool
    {
        return $this->weekSelect;
    }

    public function customConfig(array|\Closure $config): static
    {
        $this->config = $config;

        return $this;
    }

    public function getCustomConfig(): array
    {
        return $this->config;
    }

    public function range(bool $rangePicker = true): static
    {
        $this->rangePicker = $rangePicker;

        return $this;
    }

    public function isRangePicker(): bool
    {
        return $this->rangePicker;
    }

    public function multiple(bool $multiplePicker = true): static
    {
        $this->multiplePicker = $multiplePicker;

        return $this;
    }

    public function isMultiplePicker(): bool
    {
        return $this->multiplePicker;
    }

    public function monthSelect(?bool $monthSelect = true): static
    {
        $this->monthSelect = $monthSelect;

        return $this;
    }

    public function isMonthSelect(): bool
    {
        return $this->monthSelect;
    }

    public function altInput(bool $altInput = true): static
    {
        $this->altInput = $altInput;

        return $this;
    }

    public function isAltInput(): bool
    {
        return $this->altInput;
    }

    public function enableTime(bool $enableTime = true): static
    {
        $this->enableTime = $enableTime;

        return $this;
    }

    public function isEnableTime(): bool
    {
        return $this->enableTime;
    }

    public function dateFormat(string $dateFormat): static
    {
        $this->dateFormat = $dateFormat;

        return $this;
    }

    public function getDateFormat(): ?string
    {
        return $this->dateFormat;
    }

    public function altFormat(string $altFormat): static
    {
        $this->altFormat = $altFormat;

        return $this;
    }

    public function getAltFormat(): ?string
    {
        return $this->altFormat;
    }

    public function theme(FlatpickrTheme $theme): static
    {
        $this->theme = $theme;

        return $this;
    }

    public function getTheme(): string
    {
        return $this->theme?->value;
    }

    public function getThemeAsset(): string
    {
        if ($this->getTheme() === FlatpickrTheme::DEFAULT->value) {
            $this->theme(FlatpickrTheme::LIGHT);
        }

        return asset('vendor/'.\Savannabits\Flatpickr\Flatpickr::PACKAGE_NAME.'/flatpickr/themes/'.$this->getTheme().'.css');
    }

    public function getDarkThemeAsset(): string
    {
        return asset('vendor/'.\Savannabits\Flatpickr\Flatpickr::PACKAGE_NAME.'/flatpickr/themes/dark.css');
    }

    public function getLightThemeAsset(): string
    {
        return asset('vendor/'.\Savannabits\Flatpickr\Flatpickr::PACKAGE_NAME.'/flatpickr/themes/light.css');
    }
}
