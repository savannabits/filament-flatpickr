<?php

namespace Savannabits\Flatpickr\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Savannabits\Flatpickr\Flatpickr
 */
class Flatpickr extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Savannabits\Flatpickr\Flatpickr::class;
    }
}
