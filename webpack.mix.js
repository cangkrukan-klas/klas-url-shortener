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

mix.js('resources/assets/js/app.js', 'public/js');
mix.copyDirectory('node_modules/materialize-css/dist/js', 'public/js');
// mix.sass('resources/assets/sass/app.scss', 'public/css');
mix.sass("node_modules/materialize-css/sass/materialize.scss", "public/css");
mix.copy("node_modules/normalize.css/normalize.css", "public/css");