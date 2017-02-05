
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

// require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// alert box components
Vue.component('alert-danger', require('./components/alert-danger.vue'));
Vue.component('alert-success', require('./components/alert-success.vue'));
Vue.component('alert-info', require('./components/alert-info.vue'));

// post components
Vue.component('accordion-post', require('./components/post/accordion-post.vue'));
Vue.component('panel-post', require('./components/post/panel-post.vue'));

// poll components
Vue.component('accordion-poll', require('./components/poll/accordion-poll.vue'));
Vue.component('panel-poll', require('./components/poll/panel-poll.vue'));
Vue.component('bar-answer', require('./components/poll/bar-answer.vue'));

// suggestion components
Vue.component('accordion-suggestion', require('./components/suggestion/accordion-suggestion.vue'));
Vue.component('panel-suggestion', require('./components/suggestion/panel-suggestion.vue'));

Vue.component('panel-search', require('./components/panel-search.vue'));

const app = new Vue({
  el: '#app'
})