<?php

namespace Savannabits\Flatpickr;

use Filament\Forms\Components\Field;

class Flatpickr extends Field
{
    protected string $view = 'filament-flatpickr::flatpickr';

    protected bool $monthPicker = false;

    protected bool $altInput = true;

    protected ?string $altFormat = 'F j, Y';

    protected bool $enableTime = false;

    protected ?string $dateFormat = 'Y-m-d';

    protected ?string $theme;

    protected function setUp(): void
    {
        parent::setUp();
        $theme = config('filament-flatpickr.default_theme', 'default');
        $this->theme($theme);
        $this->reactive();
    }

    /**
     * @param  bool  $monthPicker
     * @return Flatpickr
     */
    public function monthPicker(?bool $monthPicker = true): Flatpickr
    {
        $this->monthPicker = $monthPicker;

        return $this;
    }

    /**
     * @return bool
     */
    public function isMonthPicker(): bool
    {
        return $this->monthPicker;
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
