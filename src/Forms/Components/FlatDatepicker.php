<?php

namespace Coolsam\FilamentFlatpickr\Forms\Components;

use Carbon\Carbon;
use Carbon\CarbonInterface;
use Carbon\Exceptions\InvalidFormatException;
use Coolsam\FilamentFlatpickr\FilamentFlatpickr;
use Filament\Forms\Components\Field;

class FlatDatepicker extends Field
{
    protected string $view = 'filament-flatpickr::forms.components.flat-datepicker';

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

    public function weekSelect(bool $weekSelect = true): static
    {
        $this->weekSelect = $weekSelect;

        return $this;
    }

    public function isWeekSelect(): bool
    {
        return $this->weekSelect;
    }

    public function config(array|\Closure $config): static
    {
        $this->config = $config;

        return $this;
    }

    public function getConfig(): array
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

    protected function setUp(): void
    {
        parent::setUp();
        $theme = config('filament-flatpickr.default_theme', 'default');
        $this->theme($theme);
        /*$this->afterStateHydrated(static function (FlatDatepicker $component, $state): void {
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
            $component->state($state);
        });*/

        $this->dehydrateStateUsing(static function (FlatDatepicker $component, $state) {
            return app(FilamentFlatpickr::class)::dehydratePickerState($component, $state);
        });

        $this->rule(
            'date',
            static fn (FlatDatepicker $component): bool => (! $component->isRangePicker() && ! $component->isMultiplePicker() && ! $component->isWeekSelect()),
        );
    }

    /**
     * @param  bool  $monthSelect
     */
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

    /**
     * @description Possible values: 'default','dark','material_blue','material_green','material_red','material_orange','airbnb','confetti'
     *
     * @see https://flatpickr.js.org/themes/
     */
    public function theme(string $theme): static
    {
        $this->theme = $theme;

        return $this;
    }

    public function getTheme(): ?string
    {
        return $this->theme;
    }
}
