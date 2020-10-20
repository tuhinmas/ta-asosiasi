 <!-- We put our HTML code inside template tag -->
<template>
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">products</h3>
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
                <i class="fas fa-Product-plus"></i>Add new Product
              </button>
              <!-- <div class="search-wrapper panel-heading col-sm-12"> -->
              <!-- <input class="form-control" type="text" v-model="searchQuery" placeholder="Search" /> -->
              <!-- <input
                  type="text"
                  v-model.trim="search"
                  placeholder="Search people..."
                  @keyup="getProducts"
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
                <th>Harga</th>
                <th>Merk</th>
                <th>Stok</th>
              </tr>
            </thead>
            <tbody>
              <!-- Loop through each Product record and display Product details -->
              <tr v-for="product in products.data" v-bind:key="product.id">
                <td class="align-middle">{{ product.product_id }}</td>
                <td class="align-middle">{{ product.product_name }}</td>
                <td class="align-middle">{{ product.harga }}</td>
                <td class="align-middle">{{ product.merk }}</td>
                <td class="align-middle">{{ product.stok.stok }}</td>
                <td class="align-middle">
                  <a href @click.prevent="editProduct(product)">
                    <i class="fa fa-edit"></i>
                  </a>
                  &nbsp; &nbsp; &nbsp;
                  <a
                    href
                    @click.prevent="deleteProduct(product.id)"
                  >
                    <i class="fa fa-trash"></i>
                  </a>
                </td>
              </tr>
            </tbody>
          </table>
          <nav aria-label="Page navigation example" class="pagination-container">
            <pagination
              :data="products"
              :limit="2"
              @pagination-change-page="getProducts"
            ></pagination>
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
            >Add new Product</h5>
            <h5
              v-show="!isFormCreateUserMode"
              class="modal-title"
              id="exampleModalLabel"
            >Update Product</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <!-- Form for adding/updating Product details. When submitted call /createProduct() function if /isFormCreateUserMode value is true. Otherwise call /updateProduct() function. -->
          <form @submit.prevent="isFormCreateUserMode ? createProduct() : updateProduct()">
            <div class="modal-body">
              <div class="form-group">
                <input
                  v-model="form.product_id"
                  type="text"
                  name="product_id"
                  placeholder="ID"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('product_id') }"
                />
                <has-error :form="form" field="product_id"></has-error>
              </div>
              <div class="form-group">
                <input
                  v-model="form.product_name"
                  type="text"
                  name="product_name"
                  placeholder="Nama Produk"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('product_name') }"
                />
                <has-error :form="form" field="product_name"></has-error>
              </div>
              <div class="form-group">
                <input
                  v-model="form.harga"
                  type="number"
                  name="harga"
                  placeholder="Harga"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('harga') }"
                />
                <has-error :form="form" field="harga"></has-error>
              </div>
              <div class="form-group">
                <input
                  v-model="form.merk"
                  type="text"
                  name="merk"
                  placeholder="Merk"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('merk') }"
                />
                <has-error :form="form" field="merk"></has-error>
              </div>
              <div class="form-group">
                <input
                  v-model="form.jml"
                  type="number"
                  name="jml"
                  placeholder="Stok"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('jml') }"
                />
                <has-error :form="form" field="jml"></has-error>
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
const customLabels = {
  first: "<<",
  last: ">>",
  previous: "<",
  next: ">"
};
// Declare /Product-management component
export default {
  name: "produk-component",
  // Declare Products (as object), form (as /vform instance) and /isFormCreateUserMode (as boolean defaulted to 'true') inside /data() { return {} }.
  data() {
    return {
      products: {},
      customLabels,
      pageOfItems: [],
      search: "",
      page: 1,
      form: new Form({
        id: "",
        product_id: "",
        product_name: "",
        harga: "",
        merk: "",
        stok:{
          stok:''
        },
        jml:""
      }),
      isFormCreateUserMode: true
    };
  },
  methods: {
    // onChangePage(pageOfItems) {
    //   // update page of items
    //   this.pageOfItems = pageOfItems;
    // },
    // /getProducts() function. Function we use to get Product list by calling api/Products method GET.
    getProducts(page = 1, search = "") {
      if (typeof page === "undefined") {
        page = 1;
      }
      axios
        .get("api/products", {
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
          this.products = response.data;
        });
    },
    // /showModal() function. Function we use to 1. Set /isFormCreateUserMode to 'true', 2. Reset form data, 3. Show modal containing dynamic form for adding/updating Product details.
    showModal() {
      this.isFormCreateUserMode = true;
      this.form.reset(); // v form reset
      $("#exampleModal").modal("show"); // show modal
    },
    // /createProduct() function. Function we use to store Product details by calling api/Products method POST (carrying form input data).
    createProduct() {
      // request post
      this.form
        .post("api/products",{})
        .then(() => {
          $("#exampleModal").modal("hide"); // hide modal

          // sweet alert 2
          swal.fire({
            icon: "success",
            title: "Product created successfully"
          });

          this.getProducts();
        })
        .catch((error) => {
          console.log("transaction fail"+error);
          console.log(this.form.product_name);
          console.log(this.form.harga);
          console.log(this.form.merk);
          console.log(this.form.stok);
          console.log(this.form.stok.stok);
          console.log(this.form);
        });
    },
    // /editProduct() function. Function we use to 1. Set /isFormCreateUserMode to 'false', 2. Reset and clear form data, 3. Show modal containing dynamic form for adding/updating Product details, 4. Fill form with Product details.
    editProduct(Product) {
      this.isFormCreateUserMode = false;
      this.form.reset(); // v form reset inputs
      this.form.clear(); // v form clear errors

      $("#exampleModal").modal("show"); // show modal
      this.form.jml = Product.stok.stok;
      console.log("jml = "+this.form.jml)
      Product.jml=Product.stok.stok;
      this.form.fill(Product);
      console.log(Product);

    },
    // /updateProduct() function. Function we use to update Product details by calling api/Products/{id} method PUT (carrying form input data).
    updateProduct() {
      // request put
      
      this.form
        .put("api/products/" + this.form.id, {})
        .then(() => {
          $("#exampleModal").modal("hide"); // hide modal

          // sweet alert 2
          swal.fire({
            icon: "success",
            title: "Product updated successfully"
          });

          this.getProducts();
        })
        .catch(() => {
          console.log("transaction fail");
        });
    },
    // /deleteProduct() function. Function we use to delete Product record by calling api/Products/{id} method DELETE.
    deleteProduct(id) {
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
              .delete("api/products/" + id, {})
              .then(() => {
                // sweet alert success
                swal.fire("Deleted!", "Your file has been deleted.", "success");

                this.getProducts(); // reload table Products
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
      this.getProducts(this.page, this.search);
    //   window.history.replaceState(null, null, "?page=1");
    }
  },
  created() {
    // Call /getProducts() function initially.
    this.getProducts(this.page, this.search);
    
  },
  mounted() {
    console.log("Component mounted."), this.getProducts(this.page, this.search);
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