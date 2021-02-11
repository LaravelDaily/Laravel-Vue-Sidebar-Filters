require('./bootstrap');

window.Vue = require('vue');

import store from './store';

Vue.component('front-page', require('./components/Front.vue').default);

const app = new Vue({
    el: '#app',
    store
});
