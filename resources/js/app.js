
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
window.VueNumeric = require('vue-numeric');
window.Vue.use(window.VueNumeric.default);
window.Event = new Vue();

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

//Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('home-component', require('./components/HomeComponent.vue'));
Vue.component('login-component', require('./components/LoginComponent.vue'));
Vue.component('record-component', require('./components/RecordComponent.vue'));
Vue.component('request-component', require('./components/RequestComponent.vue'));
Vue.component('profile-component', require('./components/ProfileComponent.vue'));
Vue.component('alert', require('./components/AlertComponent.vue'));

import store from './store'

new Vue({
    // provide the store using the "store" option.
    // this will inject the store instance to all child components.
    store,
    el: "#app",
});