window._ = require('lodash')

window.$ = window.jQuery = require('jquery')
require('cropper')
require('bootstrap-sass')
require('bootstrap-datetimepicker-sass/src/js/bootstrap-datetimepicker')

window.Vue = require('vue')
require('vue-resource')

Vue.http.interceptors.push((request, next) => {
    request.headers.set('X-CSRF-TOKEN', Laravel.csrfToken)
    next()
})

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from "laravel-echo"

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: 'your-pusher-key'
// });

window.moment = require('moment');
moment().format()