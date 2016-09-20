var elixir = require('laravel-elixir');

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

 elixir(function(mix) {
 	
 	mix.sass('app.scss');

 });

 elixir(function(mix) {

 	mix.styles([
 		"../../../node_modules/bootstrap/dist/css/bootstrap.css",
 		"../../../node_modules/bootstrap/dist/css/bootstrap-theme.css",
 		"../../../node_modules/font-awesome/css/font-awesome.css",
 	], 'public/assets/css');

 	mix.scripts([
 		"../../../node_modules/jquery/dist/jquery.js",
 		"../../../node_modules/bootstrap/dist/js/bootstrap.js",
    ], 'public/assets/js');

    mix.copy('node_modules/bootstrap-sass/assets/fonts/bootstrap/','public/assets/fonts');
    mix.copy('node_modules/font-awesome/fonts/','public/assets/fonts'); 

 });