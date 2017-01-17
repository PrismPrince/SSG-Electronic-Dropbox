
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

Vue.component('alert-danger', require('./components/alert-danger.vue'));
Vue.component('panel-post', require('./components/panel-post.vue'));
Vue.component('panel-poll', require('./components/panel-poll.vue'));
Vue.component('bar-answer', require('./components/bar-answer.vue'));
Vue.component('panel-suggestion', require('./components/panel-suggestion.vue'));

const app = new Vue({
  el: '#app'
})