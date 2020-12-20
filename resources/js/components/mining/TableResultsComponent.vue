<template>
  <div class="container">
    <div class="row">
      <div class="col-xl-12">
        <div class="card m-b-30">
          <div class="card-header">
            <div class="card-title"><b>Produk Paling Tidak Laku</b></div>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-hover table-lg" id="transaction-table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>id</th>
                    <th>Nama Produk</th>
                    <th>Support</th>
                    <th>Bulan Ini</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(res,index) in this.results.gak_laku" :key="res.index">
                    <td>{{ index+1 }}</td>
                    <td>{{ res.product_1.product_id }}</td>
                    <td>{{ res.product_1.product_name }}</td>
                    <td>{{ toFix(res.sup / total * 100)}} %</td>
                    <td>{{ res.sup }}</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row mt-3">
      <div class="col-xl-12">
        <div class="card m-b-30">
          <div class="card-header">
            <div class="card-title"><b>2 Item Bersamaan Paling Laku</b></div>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-hover table-lg" id="transaction-table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Itemset Rules</th>
                    <th>Support</th>
                    <th>Confidence</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(lvl2,index) in this.lvl2" :key="lvl2.index">
                    <td>{{ index+1 }}</td>
                    <td>
                      {{ lvl2.id_1.product_name }}
                      <b>-></b>
                      {{ lvl2.id_2.product_name }}
                    </td>
                    <td>{{ toFix(lvl2.sup/ total * 100) }} %</td>
                    <td>{{ toFixConf(lvl2.conf) }} %</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row mt-3">
      <div class="col-xl-12">
        <div class="card m-b-30">
          <div class="card-header">
            <div class="card-title"><b>3 Item Bersamaan Paling Laku</b></div>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-hover table-lg" id="transaction-table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Itemset Rules</th>
                    <th>Support</th>
                    <th>Confidence</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(lvl3,index) in this.lvl3" :key="lvl3.index">
                    <td>{{ index+1 }}</td>
                    <td>
                      ({{ lvl3.id_1.product_name }}
                      <b>-</b>
                      {{ lvl3.id_2.product_name }})
                      <b>-></b>
                      {{ lvl3.id_3.product_name }}
                    </td>
                    <td>{{ toFix(lvl3.sup/ total * 100) }} %</td>
                    <td>{{ toFixConf(lvl3.conf) }} %</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "results-component",
  created() {
    // this.getData(this.min_sup, this.min_conf);
  },
  mounted() {
    let minimum_sup = this.$route.params.support;
    let minimum_conf = this.$route.params.conf;
    this.min_sup = minimum_sup;
    this.min_conf = minimum_conf;
    console.log(this.min_sup);
    console.log(this.min_conf);
    this.getData(this.min_sup, this.min_conf);
  },
  data() {
    return {
      results: {},
      min_sup: "",
      min_conf: "",
      total: "",
      lvl2: [],
      lvl3: []
    };
  },
  methods: {
    getData(min_sup, min_conf) {
      axios
        .get("/api/h1-results", {
          params: {
            sup: min_sup,
            conf: min_conf
          }
        })
        .then(response => {
          this.results = response.data;
          this.total = this.results.total_transaksi;
          let cnf = this.min_conf;
          this.lvl2 = this.results.lvl_2.filter(function(lvl) {
            return lvl.conf >= cnf;
          });

          let cnf_3 = this.min_conf;
          this.lvl3 = this.results.lvl_3.filter(function(lv) {
            return lv.conf >= cnf_3;
          });
          console.log("lvl 3", this.lvl3);
        });
    },
    toFix(angka) {
      return angka.toFixed(4);
    },
    toFixConf(angka) {
      return angka.toFixed(2);
    }
  }
};
</script>
