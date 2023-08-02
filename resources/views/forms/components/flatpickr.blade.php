@php
    $extraAlpineAttributes = $getExtraAlpineAttributes();
    $id = $getId();
    $isConcealed = $isConcealed();
    $isDisabled = $isDisabled();
    $isPrefixInline = $isPrefixInline();
    $isSuffixInline = $isSuffixInline();
    $prefixActions = $getPrefixActions();
    $prefixIcon = $getPrefixIcon();
    $prefixLabel = $getPrefixLabel();
    $suffixActions = $getSuffixActions();
    $suffixIcon = $getSuffixIcon();
    $suffixLabel = $getSuffixLabel();
    $statePath = $getStatePath();
    $config =array_merge($getConfig(), $getCustomConfig());
    $attribs = [
        "disabled" => $isDisabled,
        "theme" => $getTheme() =='default' ? 'default' : $getTheme(),
        "themeAsset" => $getThemeAsset(),
        "lightThemeAsset" => $getLightThemeAsset(),
        "darkThemeAsset" => $getDarkThemeAsset(),
        'monthSelect'   => $isMonthSelect(),
        'weekSelect'    => $isWeekSelect(),
        'mode'          => $getMode(),
        'rangePicker'   => $isRangePicker(),
    ];
@endphp
<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
>
    <link rel="stylesheet" id="pickr-theme" type="text/css" href="{{$getThemeAsset()}}">
    <div
        x-data="flatpickrDatepicker({
{{--                state: $wire.{{ $applyStateBindingModifiers("entangle('{$getStatePath()}')") }},--}}
                packageConfig: @js($config),
                attribs: @js($attribs)
            })"
        x-ignore
        ax-load
        x-load-css="[
            @js(\Filament\Support\Facades\FilamentAsset::getStyleHref('flatpickr-css', \Coolsam\FilamentFlatpickr\FilamentFlatpickr::getPackageName())),
            @js(\Filament\Support\Facades\FilamentAsset::getStyleHref('month-select-style', \Coolsam\FilamentFlatpickr\FilamentFlatpickr::getPackageName())),
            @js(\Filament\Support\Facades\FilamentAsset::getStyleHref('flatpickr-confirm-date-style', \Coolsam\FilamentFlatpickr\FilamentFlatpickr::getPackageName())),
            {{--@js(\Filament\Support\Facades\FilamentAsset::getStyleHref('flatpickr-'.$attribs['theme'].'-theme', \Coolsam\FilamentFlatpickr\FilamentFlatpickr::getPackageName()))--}}
        ]"
        ax-load-src="{{\Filament\Support\Facades\FilamentAsset::getAlpineComponentSrc('flatpickr-component',package: \Coolsam\FilamentFlatpickr\FilamentFlatpickr::getPackageName())}}"
    >
        <x-filament::input.wrapper
            :disabled="$isDisabled"
            :inline-prefix="$isPrefixInline"
            :inline-suffix="$isSuffixInline"
            :prefix="$prefixLabel"
            :prefix-actions="$prefixActions"
            :prefix-icon="$prefixIcon"
            :suffix="$suffixLabel"
            :suffix-actions="$suffixActions"
            :suffix-icon="$suffixIcon"
            :valid="! $errors->has($statePath)"
            class="fi-fo-text-input"
            :attributes="
            \Filament\Support\prepare_inherited_attributes($getExtraAttributeBag())
                ->class(['overflow-hidden'])
        "
        >
            <x-filament::input
                :attributes="
                \Filament\Support\prepare_inherited_attributes($getExtraInputAttributeBag())
                    ->merge($extraAlpineAttributes, escape: false)
                    ->merge([
                        'autocapitalize' => $getAutocapitalize(),
                        'autocomplete' => $getAutocomplete(),
                        'autofocus' => $isAutofocused(),
                        'disabled' => $isDisabled,
                        'id' => $id,
                        'x-ref' => 'picker',
                        'inlinePrefix' => $isPrefixInline && (count($prefixActions) || $prefixIcon || filled($prefixLabel)),
                        'inlineSuffix' => $isSuffixInline && (count($suffixActions) || $suffixIcon || filled($suffixLabel)),
                        'placeholder' => $getPlaceholder(),
                        'readonly' => $isReadOnly(),
                        'required' => $isRequired() && (! $isConcealed),
                        'type' => 'text',
                    ], escape: false)
            "
            />
        </x-filament::input.wrapper>
    </div>
</x-dynamic-component>
