import Vue from "vue";
import VueRouter from "vue-router"; // We import /Vue router from /vue-router first.

Vue.use(VueRouter) 

import UserManagement from "./components/usermanagement";

const router = new VueRouter({ // Then we register route for User management module.
  routes: [
    {
      path:"/usermanagement",
      name: "usermanagement",
      component: UserManagement
    },
  ],
}); 

export default router // Next we create local registration of /router property, so we can import it within /app.js (our root /Vue instance). 