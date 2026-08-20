<?php

namespace Coolsam\Flatpickr\Tests\Support;

use Closure;
use Coolsam\Flatpickr\Forms\Components\Flatpickr;
use Filament\Forms\FormsComponent;
use Filament\Schemas\Schema;

final class RenderTestForm extends FormsComponent
{
    /** @var array<string, mixed> */
    public array $data = [];

    public static ?Closure $configureUsing = null;

    public function form(Schema $schema): Schema
    {
        $field = Flatpickr::make('published_at');

        if (self::$configureUsing) {
            (self::$configureUsing)($field);
        }

        return $schema
            ->components([$field])
            ->statePath('data');
    }
}
