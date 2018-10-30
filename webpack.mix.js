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
mix.js('resources/assets/creyo/app.js', 'public/creyo').extract(['vue', 'vuex','lodash','jquery', 'axios', 'axios-progress-bar', 'buefy', 'vue-router', 'vue-mce', 'vue-select-image', 'vue-feather-icon', 'sortablejs', 'vuedraggable'])
    .sass('resources/assets/creyo/css/bulma.sass', 'public/creyo/css')
    .sass('resources/assets/creyo/css/core.scss', 'public/creyo/css')
    .copyDirectory('resources/assets/creyo/js', 'public/creyo/js');

mix.webpackConfig({
    resolve: {
        extensions: ['.js', '.vue', '.json'],
        alias: {
            '@': __dirname + '/resources/assets/creyo/'
        },
    },
    module: {
        loaders: [
            {
                test: require.resolve('tinymce/tinymce'),
                loaders: [
                    'imports?this=>window',
                    'exports?window.tinymce'
                ]
            },
            {
                test: /tinymce\/(themes|plugins)\//,
                loaders: [
                    'imports?this=>window'
                ]
            }
        ]
    }
});
