<?php

namespace Coolsam\FilamentFlatpickr\Commands;

use Illuminate\Console\Command;

class FilamentFlatpickrCommand extends Command
{
    public $signature = 'filament-flatpickr';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
