/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
Vue.component('all-shakes', require('./components/presentational/AllShakes.vue').default);
Vue.component('search-filters', require('./components/container/SearchFilters.vue').default);
Vue.component('shake', require('./components/container/Shake.vue').default);
Vue.component('create-shake', require('./components/container/CreateShake.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

//https://www.npmjs.com/package/vue2-alertifyjs
import 'alertifyjs/build/alertify.min.js'
import 'alertifyjs/build/css/alertify.min.css'
import 'alertifyjs/build/css/themes/default.min.css'
import Alertifyjs from 'vue2-alertifyjs'
import Popover  from 'vue-js-popover'

const opts = {
  notifier:{
      delay:5,
      position:'top-right',
      closeButton: false
  }
};

Vue.use(Alertifyjs,opts)
Vue.use(Popover)

const app = new Vue({
    el: '#app',
});
