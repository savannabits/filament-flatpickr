@php
    $config =array_merge($getConfig(), $getCustomConfig());
    $attribs = [
        "disabled" => $isDisabled(),
        "theme" => $getTheme(),
        'monthSelect' => $isMonthSelect(),
        'weekSelect' => $isWeekSelect(),
        'mode' => $getMode()
    ];
@endphp
<x-dynamic-component
    :component="$getFieldWrapperView()"
    :id="$getId()"
    :label="$getLabel()"
    :label-sr-only="$isLabelHidden()"
    :helper-text="$getHelperText()"
    :hint="$getHint()"
    :hint-action="$getHintAction()"
    :hint-color="$getHintColor()"
    :hint-icon="$getHintIcon()"
    :required="$isRequired()"
    :state-path="$getStatePath()"
>
    <div
        wire:ignore
        x-data="datepicker({
            state: @entangle($getStatePath()),
            packageConfig: @js($config),
            attribs: @js($attribs)
        })"
    >
        <template x-if="attribs.theme !== 'default'">
            <link rel="stylesheet" type="text/css" :href="`https://npmcdn.com/flatpickr/dist/themes/${attribs.theme}.css`">
        </template>
        <template x-if="mode ==='dark'">
            <link rel="stylesheet" type="text/css" :href="`https://npmcdn.com/flatpickr/dist/themes/dark.css`">
        </template>
        <!-- Interact with the `state` property in Alpine.js -->
        <div class="flex items-center justify-start relative">
            <x-heroicon-o-calendar
                class="absolute flex items-center justify-center w-6 h-6 pl-2 text-gray-400 pointer-events-none group-focus-within:text-primary-500"/>
            <input
                {{$isDisabled() ? 'disabled': ''}}
                class="block w-full h-10 pl-10 placeholder-gray-400 transition duration-75 border-gray-300 rounded-lg shadow-sm focus:border-primary-600 focus:ring-1 focus:ring-inset focus:ring-primary-600 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400"
                x-ref="picker"
                x-model="state"
                id="picker">
        </div>
    </div>
</x-dynamic-component>
