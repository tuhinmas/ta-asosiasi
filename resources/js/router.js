import Vue from "vue";
import VueRouter from "vue-router"; // We import /Vue router from /vue-router first.

Vue.use(VueRouter) 

import UserManagement from "./components/UserManagement";
import data from "./components/mining/DataComponent";
import produk from "./components/produk/ProdukComponent";
import customer from "./components/customer/CustomerComponent";
import riwayat from "./components/transaksi/InvoiceDetailComponent";

const router = new VueRouter({ // Then we register route for User management module.
  mode : 'history',
  routes: [
    {
      path:"/usermanagement",
      name: "usermanagement",
      component: UserManagement
    },
    {
      path:"/transaksi/invoice/:invoice_id",
      name: "riwayat-component",
      component: riwayat
    },
    {
      path:"/data/mining",
      name: "data",
      component: data
    },
    {
      path:"/kasir/produk",
      name: "produk",
      component: produk
    },
    {
      path:"/customer",
      name: "customer",
      component: customer
    },
  ],
}); 

export default router // Next we create local registration of /router property, so we can import it within /app.js (our root /Vue instance). 