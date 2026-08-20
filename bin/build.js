import esbuild from 'esbuild'
import fs from 'fs'
import path from 'path'

const isDev = process.argv.includes('--dev')

async function compile(options) {
    const context = await esbuild.context(options)

    if (isDev) {
        await context.watch()
    } else {
        await context.rebuild()
        await context.dispose()
    }
}

const defaultOptions = {
    define: {
        'process.env.NODE_ENV': isDev ? `'development'` : `'production'`,
    },
    bundle: true,
    mainFields: ['module', 'main'],
    platform: 'neutral',
    sourcemap: isDev ? 'inline' : false,
    sourcesContent: isDev,
    treeShaking: true,
    target: ['es2020'],
    minify: !isDev,
    plugins: [{
        name: 'watchPlugin',
        setup: function (build) {
            build.onStart(() => {
                console.log(`Build started at ${new Date(Date.now()).toLocaleTimeString()}: ${build.initialOptions.outfile}`)
            })

            build.onEnd((result) => {
                if (result.errors.length > 0) {
                    console.log(`Build failed at ${new Date(Date.now()).toLocaleTimeString()}: ${build.initialOptions.outfile}`, result.errors)
                } else {
                    console.log(`Build finished at ${new Date(Date.now()).toLocaleTimeString()}: ${build.initialOptions.outfile}`)
                }

                console.log('Copying assets from node modules to dist folder')
                const sourceDir = './node_modules/flatpickr/dist/themes'
                const destDir = './resources/dist/themes'
                const overrideDir = './resources/css/themes'

                // Ensure the destination directory exists
                fs.mkdirSync(destDir, { recursive: true })

                // Copy all theme files
                fs.readdirSync(sourceDir).forEach((file) => {
                    const sourceFile = path.join(sourceDir, file)
                    const destFile = path.join(destDir, file)

                    fs.copyFileSync(sourceFile, destFile)

                    // The vendor themes are overwritten on every build, so our
                    // fixes for them live in resources/css/themes and get
                    // appended here instead of being edited into the dist file.
                    const overrideFile = path.join(overrideDir, file)

                    if (fs.existsSync(overrideFile)) {
                        fs.appendFileSync(destFile, '\n' + fs.readFileSync(overrideFile, 'utf8'))
                        console.log(`Copied: ${file} (+ overrides)`)
                    } else {
                        console.log(`Copied: ${file}`)
                    }
                })

                console.log('All theme assets have been copied successfully.')
            })
        }
    }],
}

compile({
    ...defaultOptions,
    entryPoints: ['./resources/js/components/flatpickr.js'],
    outfile: './resources/dist/components/flatpickr.js',
})
