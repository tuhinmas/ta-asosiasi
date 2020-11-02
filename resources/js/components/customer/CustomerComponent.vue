 <!-- We put our HTML code inside template tag -->
<template>
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Customer</h3>
          <div class="card-tools">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">
                  <i class="fas fa-search"></i>
                </span>
              </div>
              <input
                type="text"
                class="form form-control mr-3"
                placeholder="Search"
                aria-describedby="basic-addon1"
                v-model="search"
                @keyup="searchData"
              />

              <!-- Button "add new Customer". When clicked, it will call /showModal function (function to display modal pop up containing "add new Customer" form). -->
              <button
                type="submit"
                class="btn btn-primary"
                data-toggle="modal"
                data-target="#exampleModal"
                @click.prevent="showModal"
              >
                <i class="fas fa-Customer-plus"></i>Add new Customer
              </button>
            </div>
          </div>
        </div>
        <div class="card-body table-responsive p-0">
          <!-- Data-table with pagination for Customer list. -->
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>HP</th>
                <th>Alamat</th>
              </tr>
            </thead>
            <tbody>
              <!-- Loop through each Customer record and display Customer details -->
              <tr v-for="customer in customers.data" v-bind:key="customer.id">
                <td class="align-middle">{{ customer.name }}</td>
                <td class="align-middle">{{ customer.email }}</td>
                <td class="align-middle">{{ customer.phone }}</td>
                <td class="align-middle">{{ customer.address }}</td>
                <td class="align-middle">
                  <a href @click.prevent="editCustomer(customer)">
                    <i class="fa fa-edit"></i>
                  </a>
                  &nbsp; &nbsp; &nbsp;
                  <a
                    href
                    @click.prevent="deleteCustomer(customer.id)"
                  >
                    <i class="fa fa-trash"></i>
                  </a>
                </td>
              </tr>
            </tbody>
          </table>
          <nav aria-label="Page navigation example" class="pagination-container">
            <pagination
              :data="customers"
              :limit="2"
              @pagination-change-page="getCustomers"
            ></pagination>
            <!-- <jw-pagination :items="customers" @changePage="onChangePage" :labels="customLabels"></jw-pagination> -->
          </nav>
        </div>
      </div>
    </div>

    <!-- Modal containing dynamic form for adding/updating Customer details. -->
    <div
      class="modal fade"
      id="exampleModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <!-- Show/hide headings dynamically based on /isFormCreateUserMode value (true/false) -->
            <h5
              v-show="isFormCreateUserMode"
              class="modal-title"
              id="exampleModalLabel"
            >Add new Customer</h5>
            <h5
              v-show="!isFormCreateUserMode"
              class="modal-title"
              id="exampleModalLabel"
            >Update Customer</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <!-- Form for adding/updating Customer details. When submitted call /createCustomer() function if /isFormCreateUserMode value is true. Otherwise call /updateCustomer() function. -->
          <form @submit.prevent="isFormCreateUserMode ? createCustomer() : updateCustomer()">
            <div class="modal-body">
              <div class="form-group">
                <input
                  v-model="form.name"
                  type="text"
                  name="name"
                  placeholder="Nama"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('name') }"
                />
                <has-error :form="form" field="name"></has-error>
              </div>
              <div class="form-group">
                <input
                  v-model="form.email"
                  type="text"
                  name="email"
                  placeholder="Email"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('email') }"
                />
                <has-error :form="form" field="email"></has-error>
              </div>
              <div class="form-group">
                <input
                  v-model="form.phone"
                  type="number"
                  name="phone"
                  placeholder="HP"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('phone') }"
                />
                <has-error :form="form" field="phone"></has-error>
              </div>
              <div class="form-group">
                <input
                  v-model="form.address"
                  type="text"
                  name="address"
                  placeholder="Alamat"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('address') }"
                />
                <has-error :form="form" field="address"></has-error>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button
                type="submit"
                class="btn btn-primary"
                v-show="isFormCreateUserMode"
              >Save changes</button>
              <button type="submit" class="btn btn-primary" v-show="!isFormCreateUserMode">Update</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<!-- We put our scripts inside script tag -->
<script>
// Declare /Customer-management component
export default {
  name: "customer-component",
  // Declare Customers (as object), form (as /vform instance) and /isFormCreateUserMode (as boolean defaulted to 'true') inside /data() { return {} }.
  data() {
    return {
      customers: {},
      pageOfItems: [],
      search: "",
      page: 1,
      form: new Form({
        id: "",
        name: "",
        email: "",
        phone: "",
        address:""
      }),
      isFormCreateUserMode: true
    };
  },
  methods: {
    // onChangePage(pageOfItems) {
    //   // update page of items
    //   this.pageOfItems = pageOfItems;
    // },
    // /getCustomers() function. Function we use to get Customer list by calling api/Customers method GET.
    getCustomers(page = 1, search = "") {
      if (typeof page === "undefined") {
        page = 1;
      }
      axios
        .get("api/customers", {
              params: {
              page: page,
              search: this.search
          }
        //   params: {
        //     search: this.search,
        //     page: this.page
        //   }
        })
        .then(response => {
          this.customers = response.data;
        });
    },
    // /showModal() function. Function we use to 1. Set /isFormCreateUserMode to 'true', 2. Reset form data, 3. Show modal containing dynamic form for adding/updating Customer details.
    showModal() {
      this.isFormCreateUserMode = true;
      this.form.reset(); // v form reset
      $("#exampleModal").modal("show"); // show modal
    },
    // /createCustomer() function. Function we use to store Customer details by calling api/Customers method POST (carrying form input data).
    createCustomer() {
      // request post
      this.form
        .post("api/customers",{})
        .then(() => {
          $("#exampleModal").modal("hide"); // hide modal

          // sweet alert 2
          swal.fire({
            icon: "success",
            title: "Customer created successfully"
          });

          this.getCustomers();
        })
        .catch((error) => {
          console.log("transaction fail"+error);
          console.log(this.form);
        });
    },
    // /editCustomer() function. Function we use to 1. Set /isFormCreateUserMode to 'false', 2. Reset and clear form data, 3. Show modal containing dynamic form for adding/updating Customer details, 4. Fill form with Customer details.
    editCustomer(Customer) {
      this.isFormCreateUserMode = false;
      this.form.reset(); // v form reset inputs
      this.form.clear(); // v form clear errors

      $("#exampleModal").modal("show"); // show modal
      this.form.fill(Customer);
      console.log(Customer);

    },
    // /updateCustomer() function. Function we use to update Customer details by calling api/Customers/{id} method PUT (carrying form input data).
    updateCustomer() {
      // request put
      
      this.form
        .put("api/customers/" + this.form.id, {})
        .then(() => {
          $("#exampleModal").modal("hide"); // hide modal

          // sweet alert 2
          swal.fire({
            icon: "success",
            title: "Customer updated successfully"
          });

          this.getCustomers();
        })
        .catch(() => {
          console.log("transaction fail");
        });
    },
    // /deleteCustomer() function. Function we use to delete Customer record by calling api/Customers/{id} method DELETE.
    deleteCustomer(id) {
      // console.log(id)
      // sweet alert confirmation
      swal
        .fire({
          title: "Are you sure?",
          text: "You won't be able to revert this!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes, delete it!"
        })
        .then(result => {
          // confirm delete?
          if (result.value) {
            // request delete
            this.form
              .delete("api/customers/" + id, {})
              .then(() => {
                // sweet alert success
                swal.fire("Deleted!", "Your file has been deleted.", "success");

                this.getCustomers(); // reload table Customers
              })
              .catch(() => {
                // sweet alert fail
                swal.fire({
                  icon: "error",
                  title: "Oops...",
                  text: "Something went wrong!",
                  footer: "<a href>Why do I have this issue?</a>"
                });
              });
          }
        });
    },
    searchData() {
      this.getCustomers(this.page, this.search);
    //   window.history.replaceState(null, null, "?page=1");
    }
  },
  created() {
    // Call /getCustomers() function initially.
    this.getCustomers(this.page, this.search);
    
  },
  mounted() {
    console.log("Component mounted."), this.getCustomers(this.page, this.search);
    //   this.displayData(this.page, this.search);
  }
};
</script>

<!-- We put our custom css/scss inside style (type can be css or scss) -->
<style type="scss">
.pagination-container {
  height: 75px;
  display: grid;
}
.pagination {
  margin: auto !important;
}
</style> 