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
   .sass('resources/assets/sass/app.scss', 'public/css');

mix.styles([
    'node_modules/admin-lte/bower_components/bootstrap/dist/css/bootstrap.css',
    'node_modules/admin-lte/bower_components/font-awesome/css/font-awesome.css',
    'node_modules/admin-lte/bower_components/Ionicons/css/ionicons.css',
    'node_modules/admin-lte/dist/css/AdminLTE.css',
    'node_modules/admin-lte/dist/css/skins/_all-skins.css',
    'node_modules/admin-lte/dist/css/alt/AdminLTE-bootstrap-social.css',
    'node_modules/admin-lte/dist/css/alt/AdminLTE-fullcalendar.css',
    'node_modules/admin-lte/dist/css/alt/AdminLTE-select2.css',
    'node_modules/admin-lte/dist/css/alt/AdminLTE-without-plugins.css',
    'node_modules/datatables.net-bs/css/dataTables.bootstrap.css'
], 'public/css/admin-lte.css');

mix.scripts([
    'node_modules/admin-lte/bower_components/jquery/dist/jquery.js',
    'node_modules/admin-lte/bower_components/bootstrap/dist/js/bootstrap.js',
    'node_modules/admin-lte/dist/js/adminlte.js'
], 'public/js/admin-lte.js');