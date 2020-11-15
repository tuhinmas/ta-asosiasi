<template>
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="page-title-box d-print-none">
          <div class="row align-items-center">
            <div class="col-md-8">
              <h4 class="page-title m-0">Invoice</h4>
            </div>
            <div class="col-md-4">
              <div class="float-right d-none d-md-block">
                <!-- <div class="dropdown">
                  <button
                    class="btn btn-primary dropdown-toggle"
                    type="button"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false">
                    <i class="ti-settings mr-1"></i> Settings
                  </button>
                  <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Separated link</a>
                  </div>
                </div> -->
              </div>
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
      <div class="col-12">
        <div class="card m-b-30">
          <div class="card-body">
            <div class="row">
              <div class="col-12">
                <div class="invoice-title">
                  <h4 class="float-right font-16">
                    <strong>Order : {{ detail.invoice }}</strong>
                  </h4>
                  <h3 class="m-t-0">
                    <img src="/images/logo3.png" alt="logo" height="28" />
                  </h3>
                </div>
                <hr />
                <div class="row">
                  <div class="col-6">
                    <address>
                      <strong>Billed To:</strong>
                      <br />
                      {{ customer.name }}
                      <br />
                      {{ customer.address }}
                      <br />
                      
                    </address>
                  </div>
                  <div class="col-6 text-right">
                    <address>
                      <strong>Shipped To:</strong>
                      <br />
                      {{ customer.name }}
                      <br />
                      {{ customer.address }}
                      <br />
                      
                    </address>
                  </div>
                </div>
                <div class="row">
                  <div class="col-6 m-t-30">
                    <address>
                      <strong>Metode Pembayaran:</strong>
                      <br />
                      {{ payment.name }}
                      <br />
                    </address>
                  </div>
                  <div class="col-6 m-t-30 text-right">
                    <address>
                      <strong>Tanggal Pesanan:</strong>
                      <br />
                      {{ moment(data_order.created_at).format('DD MMMM YYYY') }}
                      <br />
                      <br />
                    </address>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-12">
                <div class="panel panel-default">
                  <div class="p-2">
                    <h3 class="panel-title font-20">
                      <strong>Ringkasan Pesanan</strong>
                    </h3>
                  </div>
                  <div class>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <td>
                              <strong>Barang</strong>
                            </td>
                            <td class="text-center">
                              <strong>Harga</strong>
                            </td>
                            <td class="text-center">
                              <strong>Jumlah</strong>
                            </td>
                            <td class="text-right">
                              <strong>Total</strong>
                            </td>
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-for="transaction in transaksi" v-bind:key="transaction.id">
                            <td>{{transaction.product_name}}</td>
                            <td class="text-center">
                              Rp {{ formatPrice(transaction.products.harga 
                              + ((transaction.products.ppn/100) * transaction.products.harga) 
                              - (transaction.products.harga * (diskon(transaction.products.diskon))/100)) }}</td>
                            <td class="text-center">{{ transaction.qty }}</td>
                            <td class="text-right">
                              Rp {{ formatPrice(transaction.qty *  harga(transaction.products)) }}</td>
                          </tr>
                          <tr>
                            <td class="no-line"></td>
                            <td class="no-line"></td>
                            <td class="no-line text-center">
                              <strong>PPN</strong>
                            </td>
                            <td class="no-line text-right">
                              <span>{{ formatPrice(PPN_Total) }}</span>
                            </td>
                          </tr>
                          <tr>
                            <td class="thick-line"></td>
                            <td class="thick-line"></td>
                            <td class="thick-line text-center">
                              <strong>Subtotal</strong>
                            </td>
                            <td class="thick-line text-right">Rp {{formatPrice(detail.sub_total)}}</td>
                          </tr>
                          <tr>
                            <td class="thick-line"></td>
                            <td class="thick-line"></td>
                            <td class="thick-line text-center">
                              <strong>Diskon</strong>
                            </td>
                            <td class="thick-line text-right">Rp {{formatPrice(Diskon_Total)}}</td>
                          </tr>
                          <tr>
                            <td class="no-line"></td>
                            <td class="no-line"></td>
                            <td class="no-line text-center">
                              <strong>Total</strong>
                            </td>
                            <td class="no-line text-right">
                              <h4 class="m-0">{{formatPrice(detail.total)}}</h4>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>

                    <div class="d-print-none mo-mt-2">
                      <div class="float-right">
                        <a
                          href="javascript:window.print()"
                          class="btn btn-success waves-effect waves-light"
                        >
                          <i class="fa fa-print"></i> Print
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- end row -->
          </div>
        </div>
      </div>
      <!-- end col -->
    </div>
    <!-- end row -->
  </div>
  <!-- container fluid -->
</template>
<script>
export default {
  mounted() {
    let invoice_id = this.$route.params.invoice_id;
    this.displayData(invoice_id);
    // this.diskon(disc);
  },

  data() {
    return {
      invoice_id: "",
      order_detail: [],
      data_order: {},
      total_ppn: "",
      detail :{},
      transaksi: [],
      pot:null,
      customer :{},
      payment :{},
    };
  },

  computed: {
    PPN_Total() {
      let ppn = 0;
      this.transaksi.forEach(data => {
        ppn += ((data.products.ppn/100) * data.products.harga) * data.qty;
      });

      return ppn;
      console.log(ppn);
    },
    Diskon_Total(){
      let diskon = 0;
      this.transaksi.forEach(element => {
        let diskonVal = 0;
        if(element.products.diskon != null){
          diskonVal = element.products.diskon.diskon/100;
        }
        diskon += (diskonVal * element.products.harga) * element.qty;
      });
      return diskon;
    }
  },

  methods: {
    displayData(invoice_id) {
      axios.get(`/api/transaction/${invoice_id}`).then(res => {
        this.data_order = res.data;
        this.detail = res.data.detail_transaksi[0];
        this.transaksi = res.data.transaksi;
        this.customer = this.detail.customers;
        this.payment = this.detail.payment_method;
        console.log(this.transaksi);
      });
    },
      formatPrice(value) {
      let val = (value / 1).toFixed(0).replace(".", ",");
      return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    },
    diskon(disc){
      let pot = 0;
      if(disc == null){
        pot = 0;
      }
      else{
        pot = disc.diskon;
      }
      return pot;
    },
    harga(transaction){
      let price= transaction.harga 
      + ((transaction.ppn/100) * transaction.harga) 
      - (transaction.harga * ((this.diskon(transaction.diskon))/100))
      return price;
    },
    ppn(pajeg){
      let totalPPN = 0;
      // this.transaksi.forEach(element => {
      //   totalPPN = element.qty * (element.products.harga * (element.products.ppn/100)) ;
      // });

      console.log(totalPPN);
    },
    totalPPN() {
      let ppn = 0;
      this.transaksi.forEach(data => {
        ppn += data.products.ppn * data.qty;
      });

      return ppn;
      console.log(ppn);
    }
  }
};
</script>

