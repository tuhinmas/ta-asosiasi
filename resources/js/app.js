/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
// Import /Form, /HasError, /AlertError from /vform first.
import { Form, HasError, AlertError } from 'vform'

// Then register /HasError and /AlertError as component (so we can use them as tag later in our HTML).
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

// Next, set /window.form as /Form so we can instantiate /Form later within our component.
window.Form = Form; 

Vue.component('pagination', require('laravel-vue-pagination')); // Register /pagination as component 
 // Import /swal from /sweetalert2 first.
 import swal from 'sweetalert2';

 // Then, set /window.swal as /swal so we can instantiate /swal later within our component.
 window.swal = swal; 

 import VuejsPaginate from 'vuejs-paginate'
// Vue.component('paginate', Paginate)
Vue.component('paginate', VuejsPaginate)
// import JwPagination from 'jw-vue-pagination';
// Vue.component('jw-pagination', JwPagination);
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('user-management-component', require('./components/UserManagement.vue').default);
Vue.component('data-mining-component', require('./components/mining/DataComponent.vue').default);
Vue.component('product-component', require('./components/produk/ProdukComponent.vue').default);
Vue.component('pagination-component', require('./components/produk/PaginationComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import router from './router'

const app = new Vue({
    router,
    el: '#app',
});
