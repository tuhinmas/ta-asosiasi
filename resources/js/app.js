/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */





require('./bootstrap');

window.Vue = require('vue');
 //tambahan vue {
 // Import /Form, /HasError, /AlertError from /vform first.
 import { Form, HasError, AlertError } from 'vform'

  // Then register /HasError and /AlertError as component (so we can use them as tag later in our HTML).
  Vue.component(HasError.name, HasError)
  Vue.component(AlertError.name, AlertError)
 // Next, set /window.form as /Form so we can instantiate /Form later within our component.

//tambahan vue{
window.Form = Form; 
//tambahan vue}
// import Vue from 'vue';
// import VueRouter from "vue-router";

// window.Vue = Vue;
// Vue.use(VueRouter);

// import Form from "./utilities/Form";
// window.Form = Form;

// import router from './routes';


Vue.component('pagination', require('laravel-vue-pagination')); // Register /pagination as component 

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

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

  // Import /swal from /sweetalert2 first.
import swal from 'sweetalert2';

// Then, set /window.swal as /swal so we can instantiate /swal later within our component.
window.swal = swal; 

const app = new Vue({
    el: '#app',
});
