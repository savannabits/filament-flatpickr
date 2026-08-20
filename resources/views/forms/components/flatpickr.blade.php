@php
    use Filament\Support\Enums\IconSize;
    use Filament\Support\Facades\FilamentView;
    use Filament\Support\Icons\Heroicon;
    use Filament\Support\View\SupportIconAlias;

    use function Filament\Support\generate_icon_html;

    $datalistOptions = $getDatalistOptions();
    $extraAlpineAttributes = $getExtraAlpineAttributes();
    $hasTime = $hasTime();
    $id = $getId();
    $isDisabled = $isDisabled();
    $isReadOnly = $isReadOnly();
    $hasDate = $hasDate();
    $isNative = $isNative();
    $isPrefixInline = $isPrefixInline();
    $isSuffixInline = $isSuffixInline();
    $maxDate = $getMaxDate();
    $minDate = $getMinDate();
    $disabledDates = $getDisableDates();
    $prefixActions = $getPrefixActions();
    $prefixIcon = $getPrefixIcon();
    $prefixLabel = $getPrefixLabel();
    $suffixActions = $getSuffixActions();
    $suffixIcon = $getSuffixIcon();
    $suffixLabel = $getSuffixLabel();
    $statePath = $getStatePath();
    $attrs = $getFlatpickrAttributes();
    $livewireKey = method_exists($field, 'getLivewireKey') ? $field->getLivewireKey() : $id;

    $isInteractive = ! ($isDisabled || $isReadOnly);
    $hasTags = $hasTags();

    // The Alpine component finds this wrapper and binds the affixes as picker
    // triggers; the class is what marks them as clickable.
    $wrapperAttributes = \Filament\Support\prepare_inherited_attributes($getExtraAttributeBag())
        ->class(['fi-fo-flatpickr-wrp' => ! $isNative]);

    $deleteIconHtml = generate_icon_html(
        Heroicon::XMark,
        alias: SupportIconAlias::BADGE_DELETE_BUTTON,
        size: IconSize::ExtraSmall,
    )?->toHtml();

    $removeDateLabel = __('flatpickr::flatpickr.actions.remove_date.label');
@endphp

<x-dynamic-component
        :component="$getFieldWrapperView()"
        :field="$field"
        :inline-label-vertical-alignment="\Filament\Support\Enums\VerticalAlignment::Center"
>
    <link rel="stylesheet" id="pickr-theme" type="text/css" href="{{$getThemeAsset()}}">
    <x-filament::input.wrapper
            :disabled="$isDisabled"
            :inline-prefix="$isPrefixInline"
            :inline-suffix="$isSuffixInline"
            :prefix="$prefixLabel"
            :prefix-actions="$prefixActions"
            :prefix-icon="$prefixIcon"
            :prefix-icon-color="$getPrefixIconColor()"
            :suffix="$suffixLabel"
            :suffix-actions="$suffixActions"
            :suffix-icon="$suffixIcon"
            :suffix-icon-color="$getSuffixIconColor()"
            :valid="! $errors->has($statePath)"
            :attributes="$wrapperAttributes"
    >
        @if ($isNative)
            <x-filament::input
                    :attributes="
                    \Filament\Support\prepare_inherited_attributes($getExtraInputAttributeBag())
                        ->merge($extraAlpineAttributes, escape: false)
                        ->merge([
                            'autofocus' => $isAutofocused(),
                            'disabled' => $isDisabled,
                            'id' => $id,
                            'inlinePrefix' => $isPrefixInline && (count($prefixActions) || $prefixIcon || filled($prefixLabel)),
                            'inlineSuffix' => $isSuffixInline && (count($suffixActions) || $suffixIcon || filled($suffixLabel)),
                            'list' => $datalistOptions ? $id . '-list' : null,
                            'max' => $hasTime ? $maxDate : ($maxDate ? \Carbon\Carbon::parse($maxDate)->toDateString() : null),
                            'min' => $hasTime ? $minDate : ($minDate ? \Carbon\Carbon::parse($minDate)->toDateString() : null),
                            'placeholder' => $getPlaceholder(),
                            'readonly' => $isReadOnly,
                            'required' => $isRequired() && (! $isConcealed()),
                            'step' => $getStep(),
                            'type' => $getType(),
                            $applyStateBindingModifiers('wire:model') => $statePath,
                            'x-data' => count($extraAlpineAttributes) ? '{}' : null,
                        ], escape: false)
                "
            />
        @else
            <div
                    wire:ignore
                    wire:key="{{ $livewireKey }}.{{
                        substr(md5(serialize([
                            $disabledDates,
                            $isDisabled,
                            $isReadOnly,
                            $maxDate,
                            $minDate,
                            $hasTime,
                            $hasDate,
                            $attrs,
                        ])), 0, 64)
                    }}"
                    @if (FilamentView::hasSpaMode())
                        {{-- format-ignore-start --}}x-load="visible || event (ax-modal-opened) || event (modal-opened)"
                    {{-- format-ignore-end --}}
                    @else
                        x-load="visible || event (modal-opened) || event (opened-form-component-action-modal)"
                    @endif
                    x-load-css="[
                    @js(\Filament\Support\Facades\FilamentAsset::getStyleHref('flatpickr-styles', \Coolsam\Flatpickr\FilamentFlatpickr::getPackageName()))
                    ]"
                    x-load-src="{{ \Filament\Support\Facades\FilamentAsset::getAlpineComponentSrc('flatpickr', \Coolsam\Flatpickr\FilamentFlatpickr::getPackageName()) }}"
                    x-data="flatpickrComponent($wire.{{ $applyStateBindingModifiers("\$entangle('{$statePath}')") }}, @js($attrs))"
                    {{
                        $attributes
                            ->merge($getExtraAttributes(), escape: false)
                            ->merge($getExtraAlpineAttributes(), escape: false)
                            ->class(['fi-fo-date-time-picker', 'fi-fo-flatpickr'])
                    }}
            >
                <input x-ref="minDate" type="hidden" value="{{ $minDate }}" />

                <input x-ref="maxDate" type="hidden" value="{{ $maxDate }}" />

                <input
                        x-ref="disabledDates"
                        type="hidden"
                        value="{{ json_encode($disabledDates) }}"
                />

                <div class="fi-fo-flatpickr-input-ctn">
                    @if ($hasTags)
                        <template x-if="tags.length">
                            <div class="fi-fo-flatpickr-tags-ctn">
                                <template x-for="(tag, index) in tags" x-bind:key="`${tag}-${index}`">
                                    <span class="fi-badge fi-size-md">
                                        <span class="fi-badge-label-ctn">
                                            <span class="fi-badge-label" x-text="tag"></span>
                                        </span>

                                        @if ($isInteractive)
                                            <button
                                                    type="button"
                                                    x-on:click.stop="removeDate(index)"
                                                    x-bind:aria-label="'{{ $removeDateLabel }}: ' + tag"
                                                    class="fi-badge-delete-btn"
                                            >
                                                {!! $deleteIconHtml !!}
                                            </button>
                                        @endif
                                    </span>
                                </template>
                            </div>
                        </template>
                    @endif

                    <x-filament::input
                            :attributes="
                        \Filament\Support\prepare_inherited_attributes($getExtraInputAttributeBag())
                            ->merge($extraAlpineAttributes, escape: false)
                            ->merge([
                                'autofocus' => $isAutofocused(),
                                'disabled' => $isDisabled,
                                'id' => $id,
                                'x-ref' => 'input',
                                'x-model' => 'state',
                                'inlinePrefix' => $isPrefixInline && (count($prefixActions) || $prefixIcon || filled($prefixLabel)),
                                'inlineSuffix' => $isSuffixInline && (count($suffixActions) || $suffixIcon || filled($suffixLabel)),
                                'max' => $hasTime ? $maxDate : ($maxDate ? \Carbon\Carbon::parse($maxDate)->toDateString() : null),
                                'min' => $hasTime ? $minDate : ($minDate ? \Carbon\Carbon::parse($minDate)->toDateString() : null),
                                'placeholder' => $getPlaceholder(),
                                'readonly' => $isReadOnly,
                                'required' => $isRequired() && (! $isConcealed()),
                                $applyStateBindingModifiers('wire:model') => $statePath,
                                'x-data' => count($extraAlpineAttributes) ? '{}' : null,
                            ], escape: false)
                    "
                    />
                </div>
            </div>
        @endif
    </x-filament::input.wrapper>

    @if ($datalistOptions)
        <datalist id="{{ $id }}-list">
            @foreach ($datalistOptions as $option)
                <option value="{{ $option }}" />
            @endforeach
        </datalist>
    @endif
</x-dynamic-component>
