const mix = require('laravel-mix');
require('laravel-mix-imagemin');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/theme.js', 'public/js')
    .js('resources/js/sb-admin-2.min.js', 'public/js')
    .postCss('resources/css/theme.css', 'public/css')
    .postCss('resources/css/sb-admin-2.min.css', 'public/css')
    .sass('resources/sass/appcss.scss', 'public/css')
    .imagemin(
        'img/**',
        {
            context: 'resources',
        },
        {
            optipng: {
                optimizationLevel: 5
            },
            jpegtran: null,
        }
    )
    .sourceMaps();
