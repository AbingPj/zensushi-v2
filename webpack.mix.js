const mix = require('laravel-mix');

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
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/admin.scss', 'public/css/admin.css')
    .copyDirectory(
        "resources/js/bootstrap-notify-master/bootstrap-notify.min.js",
        "public/js"
    )
    .copyDirectory(
        "resources/sass/css/animate.css",
        "public/css"
    ).copyDirectory(
        "node_modules/admin-lte/dist/img",
        "public/images/adminlte"
    );

