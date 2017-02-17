const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(mix => {
    mix.sass('app.scss')
         .webpack('app.js');

    mix.copy('node_modules/admin-lte/bootstrap/js/bootstrap.min.js', 'resources/assets/js/vendor')
       .copy('node_modules/admin-lte/plugins/jQuery/**', 'resources/assets/js/vendor')
       .copy('node_modules/admin-lte/dist/js/app.min.js', 'resources/assets/js/vendor/admin-lte.min.js');

    mix.copy('node_modules/admin-lte/bootstrap/css/bootstrap.min.css', 'resources/assets/css/vendor')
       .copy('node_modules/admin-lte/dist/css/AdminLTE.min.css', 'resources/assets/css/vendor')
       .copy('node_modules/admin-lte/dist/css/skins/_all-skins.min.css', 'resources/assets/css/vendor');

    mix.copy('node_modules/admin-lte/dist/img/**', 'public/img');

    mix.styles([
        'vendor/bootstrap.min.css'
    ]);

   mix.styles([
        'vendor/AdminLTE.min.css',
        'vendor/_all-skins.min.css'
        ], 'public/css/AdminLTE.min.css');

    mix.scripts([
        'vendor/jquery-2.2.3.min.js',
        'vendor/bootstrap.min.js'
    ]);

    mix.scripts([
        'vendor/admin-lte.min.js',
        ], 'public/js/admin-lte.min.js');

});
