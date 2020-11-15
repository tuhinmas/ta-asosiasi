<template>
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="page-title-box">
          <div class="row align-items-center">
            <div class="col-md-8">
              <h4 class="page-title m-0">Riwayat Transaksi</h4>
            </div>
            <!-- end col -->
          </div>
          <!-- end row -->
        </div>
        <!-- end page-title-box -->
      </div>
    </div>
    <!-- end page title -->

    <div class="row">
      <div class="col-xl-12">
        <div class="card m-b-30">
          <div class="card-body">
            <div class="row mb-3">
              <div class="col-8">
                <h4 class="mt-0 header-title">Semua Transaksi</h4>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table table-hover table-lg" id="transaction-table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Kasir</th>
                    <th>Customer</th>
                    <th>Jumlah Item</th>
                    <th>Sub Total</th>
                    <th>Diskon</th>
                    <th>Total</th>
                    <th>Tanggal</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(data, index ) in transactions.data" :key="data.id">
                    <td>{{ index + 1 + (30 * (page-1)) }}</td>
                    <td>{{ data.user == null ? 'Deleted':data.user.name }}</td>
                    <td>{{ data.customers.name }}</td>
                    <td>{{ data.jumlah_item }}</td>
                    <td>Rp {{ formatPrice(data.sub_total) }}</td>
                    <td>Rp {{ formatPrice(data.diskon) }}</td>
                    <td>Rp {{ formatPrice(data.total) }}</td>
                    <td>{{ moment(data.created_at).format('DD MMMM YYYY') }}</td>
                    <td>
                      <a
                        class="btn btn-primary btn-sm"
                        :href="`/transaksi/invoice/${invoice(data.invoice)}`"
                      >invoice</a>
                    </td>
                  </tr>
                </tbody>
              </table>
              <nav aria-label="Page navigation example" class="pagination-container">
                <pagination :data="transactions" 
                            :limit="2" 
                            @pagination-change-page="viewData"></pagination>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- end row -->
  </div>
  <!-- container fluid -->
</template>

<script>
export default {
  mounted() {
    this.viewData(this.page);
    console.log(this.transactions);
    // this.invoice();
  },

  data() {
    return {
      produk: [],
      transactions: {},
      inv: [],
      page: 1
    };
  },

  methods: {
    viewData(page = 1) {
      if (typeof page === "undefined") {
        page = 1;
      }
      axios
        .get("/api/riwayat-transaksi", {
          params: {
            page: page
          }
        })
        .then(res => {
          this.transactions = res.data;
          this.page = this.transactions.current_page;
          console.log(this.page);
          // this.invoice = res.data.invoice;
        });
    },
    formatPrice(value) {
      let val = (value / 1).toFixed(0).replace(".", ",");
      return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    },
    invoice(dataInvoice) {
      // let parsingInvoice = dataInvoice.split('/');
      let parsingInvoice = dataInvoice.replace(new RegExp("/", "g"), "-");
      this.inv = parsingInvoice;
      // console.log(parsingInvoice);
      return parsingInvoice;
    }
  }
};
</script>
