<template>
  <div class="container">
    <div class="row mt-3">
      <div class="col-lg-6 col-12">
        <div class="small-box bg-danger">
          <div class="inner">
            <h3>{{ transaksi.allProducts }}</h3>
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
            <h3>{{ transaksi.allTransaksi }}</h3>
            <p>Transaksi</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
        </div>
      </div>
    </div>
    <div class="card card-default">
      <div class="card-header">
        <h3 class="card-title">Parameter</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
          </button>
          <button type="button" class="btn btn-tool" data-card-widget="remove">
            <i class="fas fa-times"></i>
          </button>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Minimum Support</label>
              <select class="form-control select2bs4" style="width: 100%;" v-model="support">
                <option
                  v-for="parameter in this.parameters"
                  :key="parameter.id"
                  :value="parameter.min_support"
                >{{ parameter.min_support }} %</option>
              </select>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-md-6">
            <!-- /.form-group -->
            <div class="form-group">
              <label>Minimum Confidence</label>
              <select class="form-control select2bs4" style="width: 100%;" v-model="confidence">
                <option
                  v-for="parameter in this.parameters"
                  :key="parameter.id"
                  :value="parameter.min_confidence"
                >{{ parameter.min_confidence }} %</option>
              </select>
            </div>
            <!-- /.form-group -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Proses</button>
        <div class="alert alert-success" v-if="successMsg !== ''" v-html="successMsg"></div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "parameter-component",
  created() {
    this.getData();
    this.getDataTransaksi();
  },
  mounted() {
    this.getData();
    this.getDataTransaksi();
    console.log("Component mounted.");
  },
  data() {
    return {
      parameters: {},
      transaksi: {},
      support: 2,
      confidence: 2,
      successMsg:''
    };
  },
  methods: {
    getData() {
      axios.get("/api/parameter").then(response => {
        this.parameters = response.data;
        console.log(this.parameters);
      });
    },
    getDataTransaksi() {
      axios.get("/api/resume-transaksi").then(response => {
        this.transaksi = response.data;
      });
    },
    prosesDataMining(){
      axios.post("api/data-mining")
    }
  }
};
</script>
