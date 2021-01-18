<template>
  <div class="container mt-5">
    <div class="row align-items-center">
      <div class="col-lg-6 offset-lg-3 col-12">
        <div class="card">
          <div class="card-header">
            <h4 class="text-muted font-18 mt-4">Login</h4>
          </div>
          <div class="card-body">
            <div class="p-2">
              <form class="form-horizontal m-t-20" @submit.prevent="login()">
                <transition name="fade">
                  <div
                    class="alert alert-danger"
                    v-if="auth.has_error"
                  >Username atau password salah.</div>
                  <div class="alert alert-success" v-else-if="auth.success">Sukses login.</div>
                </transition>
                <div class="form-group row">
                  <div class="col-12">
                    <input
                      class="form-control"
                      type="text"
                      placeholder="Email"
                      v-model="auth.email"
                    />
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-12">
                    <input
                      class="form-control"
                      type="password"
                      placeholder="Password"
                      v-model="auth.password"
                    />
                  </div>
                </div>

                <div class="form-group text-center row m-t-20">
                  <div class="col-12">
                    <button
                      class="btn btn-primary btn-block waves-effect waves-light"
                      :disabled="button_loading==true"
                      type="submit"
                    >
                      <span
                        class="spinner-border spinner-border-sm"
                        role="status"
                        aria-hidden="true"
                        v-if="button_loading==true"
                      ></span>
                      Login
                    </button>
                  </div>
                </div>
              </form>
              <a href="/password/reset">Forgot Your Password?</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- end row -->
  </div>
</template>
<script>
export default {
  mounted() {},

  data() {
    return {
      auth: {
        email: "",
        password: "",
        has_error: false,
        success: false
      },
      button_loading: false
    };
  },

  methods: {
    login() {
      let email = this.auth.email;
      let password = this.auth.password;
      if (this.auth.email == "" || this.auth.password == "") {
        alertify.alert("Oops!", "Email dan Password harus diisi!");
      } else {
        axios.post("/api/authenticate", { email, password }).then(res => {
          console.log(res.data.user);
          if (res.data.msg == "not found") {
            this.auth.has_error = true;
            this.auth.success = false;
          } else {
            this.auth.has_error = false;
            this.auth.success = true;
            this.button_loading = true;
            setTimeout(() => {
              window.location = "/";
            }, 1000);
          }
        });
      }
    }
  }
};
</script>

<style>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 1s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
  opacity: 0;
}
</style>
