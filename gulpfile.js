const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application as well as publishing vendor resources.
 |
 */

elixir((mix) => {
  mix.sass('app.scss')
    .webpack('bootstrap.js')
    .webpack('login.js')
    .webpack('register.js')
    .webpack('account/account.js')
    .webpack('account/account-password.js')
    .webpack('account/account-email.js')
    .webpack('account/account-name.js')
    .webpack('home.js')
    .webpack('search.js')
    .webpack('profile.js')
    .webpack('post.js')
    .webpack('poll.js')
    .webpack('suggestion.js')
    .webpack('app.js')
    .copy('node_modules/bootstrap-sass/assets/fonts/', 'public/fonts/')
    .copy('node_modules/cropper/dist/cropper.min.js', 'public/js/cropper.min.js')
    .copy('node_modules/cropper/dist/cropper.min.css', 'public/css/cropper.min.css')
    .copy('resources/assets/img/', 'public/images/')
});
