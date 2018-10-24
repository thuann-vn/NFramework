let mix = require('laravel-mix');

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

mix.js('resources/assets/js/app.js', 'public/js')
    .sass('resources/assets/sass/app.scss', 'public/css')
    .copyDirectory('resources/assets/images', 'public/images');

//Creyo app
mix.js('resources/assets/creyo/app.js', 'public/creyo')
    .sass('resources/assets/creyo/css/bulma.sass', 'public/creyo/css')
    .sass('resources/assets/creyo/css/core.scss', 'public/creyo/css')
    .copyDirectory('resources/assets/creyo/js', 'public/creyo/js');