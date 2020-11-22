 <!-- We put our HTML code inside template tag -->
<template>
  <div class="container">
    <div class="row">
      <div class="col">
        <div class="small-box bg-primary">
          <div class="inner">
            <h3>{{ total }}</h3>
            <h4>Item</h4>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
        </div>
      </div>
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Order Of Item</h3>
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
                  <th>ID</th>
                  <th>Nama</th>
                  <th>Order Of Item</th>
                </tr>
              </thead>
              <tbody>
                <!-- Loop through each Product record and display Product details -->
                <tr v-for="order in orders.data" v-bind:key="order.id">
                  <td class="align-middle">{{ order.id }}</td>
                  <td class="align-middle">{{ order.products.product_id }}</td>
                  <td class="align-middle">{{ order.products.product_name }}</td>
                  <td class="align-middle">{{ order.id }}</td>
                </tr>
              </tbody>
            </table>
            <nav aria-label="Page navigation example" class="pagination-container">
              <pagination :data="orders" :limit="2" @pagination-change-page="getProducts"></pagination>
              <!-- <jw-pagination :items="orders" @changePage="onChangePage" :labels="customLabels"></jw-pagination> -->
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<!-- We put our scripts inside script tag -->
<script>
// Declare /Product-management component
export default {
  name: "order-component",
  // Declare Order (as object), form (as /vform instance) and /isFormCreateUserMode (as boolean defaulted to 'true') inside /data() { return {} }.
  data() {
    return {
      orders: {},
      page: 1,
      total:'',
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
        .get("api/order-of-item", {
          params: {
            page: page
          }
          //   params: {
          //     search: this.search,
          //     page: this.page
          //   }
        })
        .then(response => {
          this.orders = response.data;
        });
    },
    TotalItem(){
        axios.get("api/total-item")
             .then(response =>{
                 this.total = response.data;
             });
    }
  },
  created() {
    // Call /getProducts() function initially.
    this.getProducts(this.page);
    this.TotalItem();
  },
  mounted() {
    console.log("Component mounted.");
    this.getProducts(this.page, this.search);
    this.TotalItem();
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