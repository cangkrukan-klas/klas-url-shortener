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

mix.sass('node_modules/bootstrap/scss/bootstrap.scss', 'public/css');
mix.sass('resources/assets/sass/app.scss', 'public/css');
mix.copy('node_modules/@fortawesome/fontawesome-free/css/fontawesome.min.css', 'public/css');
mix.copy('node_modules/@fortawesome/fontawesome-free/css/brands.min.css', 'public/css');
mix.copy('node_modules/@fortawesome/fontawesome-free/css/solid.min.css', 'public/css');
mix.copy('node_modules/jquery-slim/dist/jquery.slim.min.js', 'public/js');
mix.copy('node_modules/bootstrap/dist/js/bootstrap.min.js', 'public/js');
mix.js('resources/assets/js/app.js', 'public/js');
mix.copy('node_modules/@fortawesome/fontawesome-free/js/fontawesome.min.js', 'public/js');
mix.copy('node_modules/@fortawesome/fontawesome-free/js/brands.min.js', 'public/js');
mix.copy('node_modules/@fortawesome/fontawesome-free/js/solid.min.js', 'public/js');
mix.copyDirectory('node_modules/@fortawesome/fontawesome-free/webfonts', 'public/webfonts');