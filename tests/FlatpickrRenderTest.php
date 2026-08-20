<?php

use Coolsam\Flatpickr\Forms\Components\Flatpickr;
use Coolsam\Flatpickr\Tests\Support\RenderTestForm;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ViewErrorBag;

beforeEach(function (): void {
    // Rendering outside a request means nothing has shared an error bag yet.
    View::share('errors', new ViewErrorBag);
});

afterEach(function (): void {
    RenderTestForm::$configureUsing = null;
});

function renderFlatpickr(?Closure $configure = null): string
{
    RenderTestForm::$configureUsing = $configure;

    $livewire = new RenderTestForm;
    $schema = $livewire->form(Schema::make($livewire));
    $schema->getComponents(withActions: false, withHidden: true);

    /** @var Flatpickr $field */
    $field = collect($schema->getFlatComponents(withActions: false, withHidden: true))
        ->first(fn ($component) => $component instanceof Flatpickr);

    return $field->toHtml();
}

it('renders a calendar prefix icon by default', function (): void {
    $html = renderFlatpickr();

    expect(Flatpickr::make('published_at')->getPrefixIcon())->toBe('heroicon-o-calendar-days')
        ->and($html)->toContain('fi-input-wrp-prefix')
        // The Alpine component finds the affixes through this class and binds
        // them as picker triggers.
        ->and($html)->toContain('fi-fo-flatpickr-wrp');
});

it('lets the prefix icon be removed', function (): void {
    $html = renderFlatpickr(fn (Flatpickr $field) => $field->prefixIcon(null));

    expect($html)->not->toContain('fi-input-wrp-prefix-has-content')
        ->and(Flatpickr::make('published_at')->prefixIcon(null)->getPrefixIcon())->toBeNull();
});

it('renders removable tags for multiple pickers', function (): void {
    $html = renderFlatpickr(fn (Flatpickr $field) => $field->multiplePicker());

    expect($html)->toContain('fi-fo-flatpickr-tags-ctn')
        ->and($html)->toContain('removeDate(index)')
        ->and($html)->toContain('fi-badge-delete-btn');
});

it('keeps the tags in the same row as the input', function (): void {
    $html = renderFlatpickr(fn (Flatpickr $field) => $field->multiplePicker());

    $inputCtn = strpos($html, 'fi-fo-flatpickr-input-ctn');
    $tagsCtn = strpos($html, 'fi-fo-flatpickr-tags-ctn');
    $input = strpos($html, 'x-ref="input"');

    // Tags sit inside the input container, ahead of the input itself.
    expect($inputCtn)->toBeLessThan($tagsCtn)
        ->and($tagsCtn)->toBeLessThan($input);
});

it('omits the tag remove buttons when the field is disabled', function (): void {
    $html = renderFlatpickr(fn (Flatpickr $field) => $field->multiplePicker()->disabled());

    expect($html)->toContain('fi-fo-flatpickr-tags-ctn')
        ->and($html)->not->toContain('fi-badge-delete-btn');
});

it('does not render tags for single pickers by default', function (): void {
    $html = renderFlatpickr();

    expect($html)->not->toContain('fi-fo-flatpickr-tags-ctn');
});

it('can force tags on for a single picker', function (): void {
    $html = renderFlatpickr(fn (Flatpickr $field) => $field->tags());

    expect($html)->toContain('fi-fo-flatpickr-tags-ctn');
});

it('keeps the input wired to the field state', function (): void {
    $html = renderFlatpickr();

    expect($html)->toContain('fi-fo-flatpickr-input-ctn')
        ->and($html)->toContain('x-ref="input"')
        ->and($html)->toContain('data.published_at');
});

it('reports tag defaults from the picker mode', function (): void {
    expect(Flatpickr::make('a')->hasTags())->toBeFalse()
        ->and(Flatpickr::make('a')->multiplePicker()->hasTags())->toBeTrue()
        ->and(Flatpickr::make('a')->multiplePicker()->tags(false)->hasTags())->toBeFalse()
        ->and(Flatpickr::make('a')->tags()->hasTags())->toBeTrue();
});

it('tells the alpine component whether tags are shown', function (): void {
    expect(Flatpickr::make('a')->getFlatpickrAttributes())->toHaveKey('showTags', false)
        ->and(Flatpickr::make('a')->multiplePicker()->getFlatpickrAttributes())->toHaveKey('showTags', true);
});
