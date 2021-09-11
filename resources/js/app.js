require('./bootstrap');

import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import 'video.js/dist/video-js.css';
import 'video.js/dist/video.min.js';
import Vue from 'vue';

window.Vue = require('vue').default;

Vue.use(VueSweetalert2);

// Products
Vue.component('pagination', require('laravel-vue-pagination'));
Vue.component('product-list', require('./components/Product/List.vue').default);
Vue.component('product-create', require('./components/Product/Create.vue').default);
Vue.component('product-edit', require('./components/Product/Edit.vue').default);

// Videos
Vue.component('video-player', require('./components/Video/Index.vue').default);

const app = new Vue({
    el: '#app',
});
