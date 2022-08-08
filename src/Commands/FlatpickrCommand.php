<?php

namespace Savannabits\Flatpickr\Commands;

use Illuminate\Console\Command;

class FlatpickrCommand extends Command
{
    public $signature = 'filament-flatpickr';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
