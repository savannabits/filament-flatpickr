<?php

namespace Coolsam\FilamentFlatpickr\Forms\Components;

use Carbon\Carbon;
use Carbon\CarbonInterface;
use Carbon\Exceptions\InvalidFormatException;
use Coolsam\FilamentFlatpickr\FilamentFlatpickr;
use Filament\Forms\Components\Field;

class FlatDateTimepicker extends Field
{
    protected string $view = 'filament-flatpickr::forms.components.flat-datetimepicker';

    protected bool $rangePicker = false;

    protected bool $multiplePicker = false;

    protected bool $altInput = false;

    protected array $config = [];

    protected ?string $altFormat = 'F j, Y, H:i:s';

    protected bool $enableTime = true;

    protected ?string $dateFormat = 'Y-m-d H:i:s';

    protected ?string $theme;

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

        $this->dehydrateStateUsing(static function ($component, $state) {
            return app(FilamentFlatpickr::class)::dehydratePickerState($component, $state);
        });
    }

    public function altInput(bool $altInput = false): static
    {
        $this->altInput = $altInput;

        return $this;
    }

    public function isAltInput(): bool
    {
        return $this->altInput;
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
