@php
    $config = [
        "altInput" => $isAltInput(),
        "enableTime" => $isEnableTime(),
        "dateFormat" => $getDateFormat(),
    ];
    $attribs = [
        "disabled" => $isDisabled(),
        "theme" => $getTheme(),
        'monthSelect' => $isMonthSelect(),
        'weekSelect' => $isWeekSelect(),
        'mode' => $isRangePicker() ? 'range' : ($isMultiplePicker() ? 'multiple': 'single')
    ];
@endphp
@once
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('datepicker', (model, packageConfig,attribs) => ({
                state: model,
                mode: 'light',
                attribs: attribs,
                fp: null,
                get darkStatus() {
                    return window.matchMedia('(prefers-color-scheme: dark)').matches;
                },
                init() {
                    console.log(this.state)
                    this.mode = localStorage.getItem('theme') || (this.darkStatus ? 'dark' : 'light')
                    const config = {
                        mode: attribs.mode,
                        time_24hr: true,
                        altFormat: 'F j, Y',
                        disableMobile: true,
                        initialDate: this.state,
                        allowInvalidPreload: true,
                        static: false,
                        defaultDate: this.state,
                        ...packageConfig,
                        plugins: [new confirmDatePlugin({
                            confirmText: "OK",
                            showAlways: false,
                            theme: this.mode
                        })],
                    };
                    if (attribs.monthSelect) {
                        config.plugins.push(new monthSelectPlugin({
                            shorthand: false, //defaults to false
                            dateFormat: "Y-m-01", //defaults to "F Y"
                            altInput: true,
                            altFormat: "F, Y", //defaults to "F Y"
                            theme: this.mode // defaults to "light"
                        }))
                    } else if(attribs.weekSelect) {
                        config.plugins.push(new weekSelect({}))
                    }
                    this.fp = flatpickr(this.$refs.picker, config);
                    this.fp.parseDate(this.state,packageConfig.dateFormat)
                }
            }))
        })
    </script>
@endonce
<x-forms::field-wrapper
    :id="$getId()"
    :label="$getLabel()"
    :label-sr-only="$isLabelHidden()"
    :helper-text="$getHelperText()"
    :hint="$getHint()"
    :hint-icon="$getHintIcon()"
    :required="$isRequired()"
    :state-path="$getStatePath()"
>
    <div wire:ignore x-data="datepicker(@entangle($getStatePath()),@js($config), @js($attribs))">
        <template x-if="attribs.theme!=='default'">
            <link x-else rel="stylesheet" type="text/css" :href="`https://npmcdn.com/flatpickr/dist/themes/${attribs.theme}.css`">
        </template>
        <template x-if="mode ==='dark'">
            <link rel="stylesheet" type="text/css" :href="`https://npmcdn.com/flatpickr/dist/themes/dark.css`">
        </template>
        <!-- Interact with the `state` property in Alpine.js -->
        <div class="flex items-center justify-start relative">
            <x-heroicon-o-calendar
                class="absolute flex items-center justify-center w-6 h-6 pl-1 text-gray-400 pointer-events-none group-focus-within:text-primary-500"/>
            <input
                {{$isDisabled() ? 'disabled': ''}}
                class="block w-full h-10 pl-10 placeholder-gray-400 transition duration-75 border-gray-300 rounded-lg shadow-sm focus:border-primary-600 focus:ring-1 focus:ring-inset focus:ring-primary-600 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400"
                x-ref="picker"
                x-model="state"
                id="picker">
        </div>
    </div>
</x-forms::field-wrapper>
