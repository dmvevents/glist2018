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


mix.styles([
  'resources/vendor/bootstrap/css/bootstrap.min.css',
  'resources/vendor/datatables/dataTables.bootstrap4.css',
  'resources/css/sb-admin.css'
], 'public/css/dashboard.css');

mix.scripts([
  'resources/vendor/jquery/jquery.min.js',
  'resources/vendor/bootstrap/js/bootstrap.bundle.min.js',
  'resources/vendor/jquery-easing/jquery.easing.min.js',
  'resources/vendor/chart.js/Chart.min.js',
  'resources/vendor/datatables/jquery.dataTables.js',
  'resources/vendor/datatables/dataTables.bootstrap4.js',
  'resources/js/sb-admin.min.js',
  'resources/js/demo/datatables-demo.js',
  'resources/js/demo/chart-area-demo.js'
], 'public/js/all.js');

//-- Admin Panel -->
mix.styles([
'resources/vendor/bootstrap/css/bootstrap.min.css',
'resources/vendor/font-awesome/css/font-awesome.min.css',
'resources/vendor/Ionicons/css/ionicons.min.css',
'resources/css/AdminLTE.min.css',
'resources/css/skins/skin-blue.min.css'
], 'public/css/admin.css');

//-- Admin Panel -->
mix.scripts([
'resources/jquery/dist/jquery.min.js',
'resources/vendor/bootstrap/js/bootstrap.min.js',
'resources/js/adminlte.min.js'
], 'public/js/admin.js');

mix.sass('resources/sass/app.scss', 'public/css');
