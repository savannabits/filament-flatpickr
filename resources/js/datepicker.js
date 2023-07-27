document.addEventListener('alpine:init', () => {
    Alpine.data('datepicker', (args) => ({
        state: args.state,
        mode: 'light',
        attribs: args.attribs ?? {},
        packageConfig: args.packageConfig ?? {},
        fp: null,
        get darkStatus() {
            return window.matchMedia('(prefers-color-scheme: dark)').matches;
        },
        init: function () {
            this.mode = localStorage.getItem('theme') || (this.darkStatus ? 'dark' : 'light')
            const config = {
                mode: this.attribs.mode,
                time_24hr: true,
                altFormat: 'F j, Y',
                disableMobile: true,
                initialDate: this.state,
                allowInvalidPreload: false,
                static: false,
                defaultDate: this.state,
                ...this.packageConfig,
                plugins: [new confirmDatePlugin({
                    confirmText: "OK",
                    showAlways: false,
                    theme: this.mode
                })],
            };
            if (this.attribs.monthSelect) {
                config.plugins.push(new monthSelectPlugin({
                    shorthand: false, //defaults to false
                    dateFormat: "F Y", //defaults to "F Y"
                    altInput: true,
                    altFormat: "F, Y", //defaults to "F Y"
                    theme: this.mode // defaults to "light"
                }))
            } else if(this.attribs.weekSelect) {
                config.plugins.push(new weekSelect({}))
            }
            this.fp = flatpickr(this.$refs.picker, config);
            this.fp.parseDate(this.state, this.packageConfig.dateFormat)
        },
    }))
})
