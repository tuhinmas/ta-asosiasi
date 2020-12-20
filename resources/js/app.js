/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import moment from 'moment';

window.Vue = require('vue');

Vue.prototype.moment = moment
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
import Datepicker from 'vuejs-datepicker';
Vue.component('datepicker',Datepicker);


Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('user-management-component', require('./components/UserManagement.vue').default);
Vue.component('data-mining-component', require('./components/mining/DataComponent.vue').default);
Vue.component('product-component', require('./components/produk/ProdukComponent.vue').default);
Vue.component('pagination-component', require('./components/produk/PaginationComponent.vue').default);
Vue.component('diskon-component', require('./components/produk/DiskonComponent.vue').default);
Vue.component('customer-component', require('./components/customer/CustomerComponent.vue').default);
Vue.component('transaction-component', require('./components/transaksi/TransactionComponent.vue').default);
Vue.component('invoice-component', require('./components/transaksi/InvoiceDetailComponent.vue').default);
Vue.component('riwayat-transaksi-component', require('./components/transaksi/RiwayatTransaksiComponent.vue').default);
Vue.component('report-component', require('./components/transaksi/ReportComponent.vue').default);
Vue.component('home-component', require('./components/HomeComponent.vue').default);
Vue.component('parameter-component', require('./components/mining/ParameterComponent.vue').default);
Vue.component('order-component', require('./components/mining/OrderComponent.vue').default);
Vue.component('data-component', require('./components/mining/DataComponent.vue').default);
Vue.component('results-component', require('./components/mining/TableResultsComponent.vue').default);
Vue.component('grafik-component', require('./components/mining/GrafikComponent.vue').default);
Vue.component('MonthlySalesChart',require('./components/MonthlySalesChart.vue').default);
Vue.component('chart-3-itemset',require('./components/Chart3Itemset.vue').default);
Vue.component('LineChart',require('./components/LineChart.vue').default);
Vue.component('grafik-coba-component',require('./components/grafikCoba.vue').default);
Vue.component('grafik-coba-component',require('./components/grafikCoba.vue').default);
Vue.component('petunjuk-component',require('./components/about/PetunjukComponent.vue').default);
Vue.component('about-component',require('./components/about/AboutComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import router from './router'
import Vue from 'vue';
Vue.router =router;
const app = new Vue({
    router,
    el: '#app',
});
