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
    .js('resources/js/main.js', 'public/js/web')
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/style.scss', 'public/css/web')
    .sass('resources/sass/news-home.scss', 'public/css/web')
    .sass('resources/sass/news-detail.scss', 'public/css/web')
    .sass('resources/sass/contact-detail.scss', 'public/css/web')
    .sass('resources/sass/about.scss', 'public/css/web')
    .sass('resources/sass/design.scss', 'public/css/web')
    .sourceMaps();
