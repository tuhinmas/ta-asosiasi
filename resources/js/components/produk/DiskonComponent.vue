 <!-- We put our HTML code inside template tag -->
<template>
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Discount</h3>
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

              <!-- Button "add new Product". When clicked, it will call /showModal function (function to display modal pop up containing "add new Product" form). -->
              <button
                type="submit"
                class="btn btn-primary"
                data-toggle="modal"
                data-target="#exampleModal"
                @click.prevent="showModal"
              >
                <i class="fas fa-Product-plus"></i>Add new Discount
              </button>
              <!-- <div class="search-wrapper panel-heading col-sm-12"> -->
              <!-- <input class="form-control" type="text" v-model="searchQuery" placeholder="Search" /> -->
              <!-- <input
                  type="text"
                  v-model.trim="search"
                  placeholder="Search people..."
                  @keyup="getDiskon"
              />-->
              <!-- </div>   -->
            </div>
          </div>
        </div>
        <div class="card-body table-responsive p-0">
          <!-- Data-table with pagination for Product list. -->
          <table class="table table-hover">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Diskon</th>
              </tr>
            </thead>
            <tbody>
              <!-- Loop through each Product record and display Product details -->
              <tr v-for="diskon in diskon.data" v-bind:key="diskon.id">
                <td class="align-middle">{{ diskon.p_id }}</td>
                <td class="align-middle">{{ diskon.product_name }}</td>
                <td class="align-middle">{{ diskon.diskon }}%</td>
                <td class="align-middle">
                  <a href @click.prevent="editDiskon(diskon)">
                    <i class="fa fa-edit"></i>
                  </a>
                  &nbsp; &nbsp; &nbsp;
                  <a href @click.prevent="deleteDiskon(diskon.id)">
                    <i class="fa fa-trash"></i>
                  </a>
                </td>
              </tr>
            </tbody>
          </table>
          <nav aria-label="Page navigation example" class="pagination-container">
            <pagination :data="diskon" :limit="2" @pagination-change-page="getDiskon"></pagination>
            <!-- <jw-pagination :items="products" @changePage="onChangePage" :labels="customLabels"></jw-pagination> -->
          </nav>
        </div>
      </div>
    </div>

    <!-- Modal containing dynamic form for adding/updating Product details. -->
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
            >Add new Discount</h5>
            <h5
              v-show="!isFormCreateUserMode"
              class="modal-title"
              id="exampleModalLabel"
            >Update Discount</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <!-- Form for adding/updating Product details. When submitted call /createDiskon() function if /isFormCreateUserMode value is true. Otherwise call /updateDiskon() function. -->
          <form @submit.prevent="isFormCreateUserMode ? createDiskon() : updateDiskon()">
            <div class="modal-body">
              <div class="form-group">
                <input
                  v-model="form.p_id"
                  type="text"
                  name="p_id"
                  placeholder="Product ID"
                  class="form-control"
                  @keyup="searchProduct()"
                  :class="{ 'is-invalid': form.errors.has('p_id') }"
                />
                <div class="dropdown-search">
                  <ul>
                    <li v-for="data in productSearch" :key="data.id" @click="addProduct(data)">
                      <span>
                        <b>{{ data.product_id.toUpperCase() }}</b>
                        - {{ data.product_name }}
                      </span>
                    </li>
                  </ul>
                </div>
                <has-error :form="form" field="product_id"></has-error>
              </div>
              <div class="form-group">
                <input
                  v-model="form.product_name"
                  type="text"
                  name="product_name"
                  placeholder="Nama Product"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('product_name') }"
                />
                <has-error :form="form" field="product_name"></has-error>
              </div>
              <div class="form-group">
                <input
                  v-model="form.diskon"
                  type="number"
                  name="diskon"
                  placeholder="Diskon (dalam %)"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('diskon') }"
                />
                <has-error :form="form" field="diskon"></has-error>
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
// Declare /Product-management component
export default {
  name: "diskon-component",
  // Declare Products (as object), form (as /vform instance) and /isFormCreateUserMode (as boolean defaulted to 'true') inside /data() { return {} }.
  data() {
    return {
      productSearch: [],
      diskon: {},
      pageOfItems: [],
      search: "",
      page: 1,
      form: new Form({
        id:'',
        product_id: "",
        p_id:'',
        diskon: "",
        product_name: ""
      }),
      isFormCreateUserMode: true
    };
  },
  methods: {
    searchProduct() {
      let searchProduct = this.form.p_id;
      if (searchProduct == "") {
        this.productSearch = [];
      } else {
        axios
          .get("api/searchProduct", {
            params: {
              search: searchProduct
            }
          })
          .then(response => {
            this.productSearch = response.data;
            console.log(response.data);
          });
      }
    },
    addProduct(data) {
      this.form.product_id = data.id;
      this.form.p_id = data.product_id;
      this.form.product_name = data.product_name;
      console.log(this.form);
      this.productSearch = [];
    },

    onChangePage(pageOfItems) {
      // update page of items
      this.pageOfItems = pageOfItems;
    },
    // /getDiskon() function. Function we use to get Product list by calling api/Products method GET.
    getDiskon(page = 1, search = "") {
      if (typeof page === "undefined") {
        page = 1;
      }
      axios
        .get("api/diskon", {
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
          this.diskon = response.data;
        });
    },
    // /showModal() function. Function we use to 1. Set /isFormCreateUserMode to 'true', 2. Reset form data, 3. Show modal containing dynamic form for adding/updating Product details.
    showModal() {
      this.isFormCreateUserMode = true;
      this.form.reset(); // v form reset
      $("#exampleModal").modal("show"); // show modal
    },
    // /createDiskon() function. Function we use to store Product details by calling api/Products method POST (carrying form input data).
    createDiskon() {
      // request post
      this.form
        .post("api/diskon", {})
        .then(() => {
          console.log(this.form);
          $("#exampleModal").modal("hide"); // hide modal

          // sweet alert 2
          swal.fire({
            icon: "success",
            title: "Product created successfully"
          });

          this.getDiskon();
        })
        .catch(error => {
          console.log("transaction fail" + error);
          console.log(this.form.product_name);
          console.log(this.form);
        });
    },
    // /editDiskon() function. Function we use to 1. Set /isFormCreateUserMode to 'false', 2. Reset and clear form data, 3. Show modal containing dynamic form for adding/updating Product details, 4. Fill form with Product details.
    editDiskon(Diskon) {
      this.isFormCreateUserMode = false;
      this.form.reset(); // v form reset inputs
      this.form.clear(); // v form clear errors

      $("#exampleModal").modal("show"); // show modal
      this.form.fill(Diskon);
      console.log(Diskon);
    },
    // /updateDiskon() function. Function we use to update Product details by calling api/Products/{id} method PUT (carrying form input data).
    updateDiskon() {
      // request pu
      this.form
        .put("api/diskon/" + this.form.id, {})
        .then(() => {
          $("#exampleModal").modal("hide"); // hide modal

          // sweet alert 2
          swal.fire({
            icon: "success",
            title: "Diskon updated successfully"
          });

          this.getDiskon();
        })
        .catch(() => {
          console.log("transaction fail");
        });
    },
    // /deleteDiskon() function. Function we use to delete Product record by calling api/Products/{id} method DELETE.
    deleteDiskon(id) {
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
              .delete("api/diskon/" + id, {})
              .then(() => {
                // sweet alert success
                swal.fire("Deleted!", "Your file has been deleted.", "success");

                this.getDiskon(); // reload table Products
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
      this.getDiskon(this.page, this.search);
      //   window.history.replaceState(null, null, "?page=1");
    }
  },
  created() {
    // Call /getDiskon() function initially.
    this.getDiskon(this.page, this.search);
  },
  mounted() {
    console.log("Component mounted."), this.getDiskon(this.page, this.search);
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