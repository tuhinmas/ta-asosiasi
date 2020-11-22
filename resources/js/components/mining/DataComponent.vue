 <!-- We put our HTML code inside template tag -->
<template>
  <div class="row">
    <div class="col-lg-6 col-12">
      <div class="small-box bg-danger">
        <div class="inner">
          <h3>{{ total_data_train.jml_item }}</h3>
          <p>Item</p>
        </div>
        <div class="icon">
          <i class="ion ion-bag"></i>
        </div>
      </div>
    </div>

    <div class="col-lg-6 col-12">
      <div class="small-box bg-warning">
        <div class="inner">
          <h3>{{ total_data_train.jml_train }}</h3>
          <p>Record</p>
        </div>
        <div class="icon">
          <i class="ion ion-stats-bars"></i>
        </div>
      </div>
    </div>
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Order</h3>
          <div class="card-tools">
            <div class="input-group mb-3">
              <div class="input-group-prepend"></div>
            </div>
          </div>
        </div>
        <div class="card-body table-responsive p-0">
          <!-- Data-table with pagination for Product list. -->
          <table class="table table-hover">
            <thead>
              <tr>
                <th>#</th>
                <th>Invoice</th>
                <th>ID Produk</th>
                <th>Nama Produk</th>
              </tr>
            </thead>
            <tbody>
              <!-- Loop through each Product record and display Product details -->
              <tr v-for="(data, index) in DataTrain.data" v-bind:key="data.id">
                <td class="align-middle">{{ index + 1 + (50 * (page-1)) }}</td>
                <td class="align-middle">{{ data.invoice }}</td>
                <td class="align-middle">{{ data.products.product_id }}</td>
                <td class="align-middle">{{ data.products.product_name }}</td>
              </tr>
            </tbody>
          </table>
          <nav aria-label="Page navigation example" class="pagination-container">
            <pagination :data="DataTrain" :limit="2" @pagination-change-page="getProducts"></pagination>
            <!-- <jw-pagination :items="DataTrain" @changePage="onChangePage" :labels="customLabels"></jw-pagination> -->
          </nav>
        </div>
      </div>
    </div>
  </div>
</template>

<!-- We put our scripts inside script tag -->
<script>
// Declare /Product-management component
export default {
  name: "data-component",
  // Declare Order (as object), form (as /vform instance) and /isFormCreateUserMode (as boolean defaulted to 'true') inside /data() { return {} }.
  data() {
    return {
      DataTrain: {},
      page: 1,
      total_data_train: {},
      isFormCreateUserMode: true
    };
  },
  methods: {
    // onChangePage(pageOfItems) {
    //   // update page of items
    //   this.pageOfItems = pageOfItems;
    // },
    // /getProducts() function. Function we use to get Product list by calling api/Order method GET.
    getProducts(page = 1) {
      if (typeof page === "undefined") {
        page = 1;
      }
      axios
        .get("api/data-train", {
          params: {
            page: page
          }
          //   params: {
          //     search: this.search,
          //     page: this.page
          //   }
        })
        .then(response => {
          this.DataTrain = response.data;
          this.page = this.DataTrain.current_page;
        });
    },
    totalDataTrain() {
      axios.get("api/count-data-train").then(response => {
        this.total_data_train = response.data;
      });
    }
  },
  created() {
    // Call /getProducts() function initially.
    this.getProducts(this.page);
    this.totalDataTrain();
  },
  mounted() {
    console.log("Component mounted."), this.getProducts(this.page);
    this.totalDataTrain();
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