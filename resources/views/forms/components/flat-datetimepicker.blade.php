@php
    $config =array_merge($getConfig(), [
        "altInput" => $isAltInput(),
        "enableTime" => true,
        "dateFormat" => $getDateFormat(),
    ]);
    $attribs = [
        "disabled" => $isDisabled(),
        "theme" => $getTheme(),
        'mode' => $isMultiplePicker() ? 'multiple': 'single'
    ];
@endphp
<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
>
    <div
        x-ignore
        ax-load
        x-load-css="[
            @js(\Filament\Support\Facades\FilamentAsset::getStyleHref('flatpickr-css', \Coolsam\FilamentFlatpickr\FilamentFlatpickr::getPackageName())),
            @js(\Filament\Support\Facades\FilamentAsset::getStyleHref('month-select-style', \Coolsam\FilamentFlatpickr\FilamentFlatpickr::getPackageName())),
            @js(\Filament\Support\Facades\FilamentAsset::getStyleHref('flatpickr-confirm-date-style', \Coolsam\FilamentFlatpickr\FilamentFlatpickr::getPackageName()))
        ]"
        x-load-js="[
            @js(\Filament\Support\Facades\FilamentAsset::getScriptSrc('flatpickr-core', package: \Coolsam\FilamentFlatpickr\FilamentFlatpickr::getPackageName())),
            @js(\Filament\Support\Facades\FilamentAsset::getScriptSrc('flatpickr-range-plugin', package: \Coolsam\FilamentFlatpickr\FilamentFlatpickr::getPackageName())),
            @js(\Filament\Support\Facades\FilamentAsset::getScriptSrc('flatpickr-confirm-date', package: \Coolsam\FilamentFlatpickr\FilamentFlatpickr::getPackageName()))
        ]"
        ax-load-src="{{ \Filament\Support\Facades\FilamentAsset::getAlpineComponentSrc('flat-datepicker',package: \Coolsam\FilamentFlatpickr\FilamentFlatpickr::getPackageName()) }}"
        x-data="flatpickrDatepicker({
            state: $wire.{{ $applyStateBindingModifiers("entangle('{$getStatePath()}')") }},
            packageConfig: @js($config),
            attribs: @js($attribs)
        })"
    >
        <input
            {{$isDisabled() ? 'disabled': ''}}
            class="block w-full h-10 pl-10 placeholder-gray-400 transition duration-75 border-gray-300 rounded-lg shadow-sm focus:border-primary-600 focus:ring-1 focus:ring-inset focus:ring-primary-600 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400"
            x-ref="picker"
            x-model="state"
            id="picker"
        >
    </div>
</x-dynamic-component>
