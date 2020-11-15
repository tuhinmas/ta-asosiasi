<template>
  <div>
    <div class="row mt-5">
      <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
          <div class="inner">
            <h3>{{ transaksi.allProducts }}</h3>
            <p>Produk</p>
            <h5>{{ transaksi.products }}</h5>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
          <div class="inner">
            <h3>{{ transaksi.allTransaksi }}</h3>
            <p>Transaksi</p>
            <h5> Rp {{ formatPrice(transaksi.transaksi) }}</h5>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
          <div class="inner">
            <h3>{{ transaksi.allCustomers }}</h3>
            <p>Pelanggan</p>
            <h5>{{ transaksi.customers }}</h5>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
          <div class="inner">
            <h3>{{ transaksi.users }}</h3>
            <p>Karyawan</p>
            <h5>6</h5>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <canvas id="dw-chart"></canvas>
    </div>
  </div>
</template>

<script>
export default {
  name:'home-component',
  created(){
    this.getData();
  },
  mounted() {
    this.getData();
    console.log("Component mounted.");
  },
  data(){
    return{
      transaksi:{}
    }
  },
  methods:{
    getData(){
      axios.get("/api/resume-transaksi")
           .then(response => {
             this.transaksi = response.data
             console.log(this.transaksi);
           });
    },
    formatPrice(value) {
      let val = (value / 1).toFixed(0).replace(".", ",");
      return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }
  }
};
</script>
