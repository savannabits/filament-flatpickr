<?php

namespace Savannabits\Flatpickr;

use Carbon\Carbon;
use Carbon\CarbonInterface;
use Carbon\Exceptions\InvalidFormatException;
use Filament\Forms\Components\Field;

class Flatpickr extends Field
{
    protected string $view = 'filament-flatpickr::flatpickr';

    protected bool $monthSelect = false;

    protected bool $weekSelect = false;

    protected bool $rangePicker = false;

    protected bool $multiplePicker = false;

    protected bool $altInput = true;

    protected array $config = [];

    protected ?string $altFormat = 'F j, Y';

    protected bool $enableTime = false;

    protected ?string $dateFormat = 'Y-m-d';

    protected ?string $theme;

    /**
     * @param  bool  $weekSelect
     * @return Flatpickr
     */
    public function weekSelect(bool $weekSelect = true): Flatpickr
    {
        $this->weekSelect = $weekSelect;

        return $this;
    }

    /**
     * @return bool
     */
    public function isWeekSelect(): bool
    {
        return $this->weekSelect;
    }

    /**
     * @param  array  $config
     * @return Flatpickr
     */
    public function config(array|\Closure $config): Flatpickr
    {
        $this->config = $config;

        return $this;
    }

    /**
     * @return array
     */
    public function getConfig(): array
    {
        return $this->config;
    }

    /**
     * @param  bool  $rangePicker
     * @return Flatpickr
     */
    public function rangePicker(bool $rangePicker = true): Flatpickr
    {
        $this->rangePicker = $rangePicker;

        return $this;
    }

    /**
     * @return bool
     */
    public function isRangePicker(): bool
    {
        return $this->rangePicker;
    }

    /**
     * @param  bool  $multiplePicker
     * @return Flatpickr
     */
    public function multiplePicker(bool $multiplePicker = true): Flatpickr
    {
        $this->multiplePicker = $multiplePicker;

        return $this;
    }

    /**
     * @return bool
     */
    public function isMultiplePicker(): bool
    {
        return $this->multiplePicker;
    }

    protected function setUp(): void
    {
        parent::setUp();
        $theme = config('filament-flatpickr.default_theme', 'default');
        $this->theme($theme);
        $this->reactive();
        $this->afterStateHydrated(static function (Flatpickr $component, $state): void {
            if (blank($state)) {
                return;
            }

            if (! $state instanceof CarbonInterface) {
                try {
                    $state = \Illuminate\Support\Carbon::createFromFormat($component->getDateFormat(), $state);
                } catch (InvalidFormatException $exception) {
                    $state = Carbon::parse($state);
                }
            }

//            $state->setTimezone($component->getTimezone());

            $component->state($state);
        });

        $this->dehydrateStateUsing(static function (Flatpickr $component, $state) {
            if (blank($state)) {
                return null;
            }

            if (! $state instanceof CarbonInterface) {
                $state = Carbon::parse($state);
            }

//            $state->shiftTimezone($component->getTimezone());
            $state->setTimezone(config('app.timezone'));

            return $state->format($component->getDateFormat());
        });

        $this->rule(
            'date',
            static fn (Flatpickr $component): bool => (! $component->isRangePicker() && ! $component->isMultiplePicker() && ! $component->isWeekSelect()),
        );
    }

    /**
     * @param  bool  $monthSelect
     * @return Flatpickr
     */
    public function monthSelect(?bool $monthSelect = true): Flatpickr
    {
        $this->monthSelect = $monthSelect;

        return $this;
    }

    /**
     * @return bool
     */
    public function isMonthSelect(): bool
    {
        return $this->monthSelect;
    }

    /**
     * @param  bool  $altInput
     * @return Flatpickr
     */
    public function altInput(bool $altInput = true): Flatpickr
    {
        $this->altInput = $altInput;

        return $this;
    }

    /**
     * @return bool
     */
    public function isAltInput(): bool
    {
        return $this->altInput;
    }

    /**
     * @param  bool  $enableTime
     * @return Flatpickr
     */
    public function enableTime(bool $enableTime = true): Flatpickr
    {
        $this->enableTime = $enableTime;
        if ($enableTime) {
            $this->dateFormat('Y-m-d H:i:s');
            $this->altInput(false);
            $this->altFormat('Z');
        }

        return $this;
    }

    /**
     * @return bool
     */
    public function isEnableTime(): bool
    {
        return $this->enableTime;
    }

    /**
     * @param  string  $dateFormat
     * @return Flatpickr
     */
    public function dateFormat(string $dateFormat): Flatpickr
    {
        $this->dateFormat = $dateFormat;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDateFormat(): ?string
    {
        return $this->dateFormat;
    }

    /**
     * @param  string  $altFormat
     * @return Flatpickr
     */
    public function altFormat(string $altFormat): Flatpickr
    {
        $this->altFormat = $altFormat;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getAltFormat(): ?string
    {
        return $this->altFormat;
    }

    /**
     * @param  string  $theme
     * @description Possible values: 'default','dark','material_blue','material_green','material_red','material_orange','airbnb','confetti'
     *
     * @see https://flatpickr.js.org/themes/
     *
     * @return Flatpickr
     */
    public function theme(string $theme): Flatpickr
    {
        $this->theme = $theme;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTheme(): ?string
    {
        return $this->theme;
    }
}
