const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

elixir.config.js.uglify.options = {
    compress: {
        drop_console: Elixir.inProduction
    },
    preserveComments: function(node, comment) {
        return /^!!/.test( comment.value );
    }
};

elixir((mix) => {
  mix
    .sass('app.scss', 'public/css/app.min.css')
    .sass('welcome.scss', 'public/css/welcome.min.css')
    .webpack('login.js', 'public/js/login.min.js')
    .webpack('reset.js', 'public/js/reset.min.js')
    .webpack('email.js', 'public/js/email.min.js')
    .webpack('register.js', 'public/js/register.min.js')
    .webpack('account/account.js', 'public/js/account.min.js')
    .webpack('account/account-password.js', 'public/js/account-password.min.js')
    .webpack('account/account-email.js', 'public/js/account-email.min.js')
    .webpack('account/account-name.js', 'public/js/account-name.min.js')
    .webpack('admin-users.js', 'public/js/admin-users.min.js')
    .webpack('admin-code.js', 'public/js/admin-code.min.js')
    .webpack('home.js', 'public/js/home.min.js')
    .webpack('search.js', 'public/js/search.min.js')
    .webpack('profile.js', 'public/js/profile.min.js')
    .webpack('post.js', 'public/js/post.min.js')
    .webpack('poll.js', 'public/js/poll.min.js')
    .webpack('suggestion.js', 'public/js/suggestion.min.js')
    .webpack('welcome.js', 'public/js/welcome.min.js')
    .copy('resources/assets/js/onload.js', 'public/js/onload.js')
    .copy('resources/assets/js/init.js', 'public/js/init.js')
    .copy('node_modules/bootstrap-sass/assets/fonts/', 'public/fonts/')
});
