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

// mix.js('resources/js/app.js', 'public/js')
//     .sass('resources/sass/app.scss', 'public/css');

mix.styles([
        'resources/vendor/css/fontawesome-free/css/all.min.css',
        'resources/vendor/css/adminlte.min.css',
        'resources/vendor/css/config.css'
    ], 'public/css/plantilla.css')
    .js('resources/js/app.js', 'public/js')//JQuery, Bootstrap, VueJS
    .scripts([
        'resources/vendor/js/adminlte.min.js',
        'resources/vendor/js/demo.js'
    ], 'public/js/plantilla.js')
    .copy('resources/vendor/css/fontawesome-free/webfonts','public/webfonts')
    .copy('resources/vendor/img','public/img');