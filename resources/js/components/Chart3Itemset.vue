<template>
  <div>
    <div class="field is-grouped">
      <div class="control">
        <label class="checkbox">
          <input type="checkbox" :value="`sup`" v-model="selectedYears" />
          Spport
        </label>
      </div>
      <div class="control">
        <label class="checkbox">
          <input type="checkbox" :value="`conf`" v-model="selectedYears" />
          Confidence
        </label>
      </div>
    </div>

    <line-chart
      v-if="loaded"
      :width="500"
      :height="300"
      :labels="dataL"
      :datasets="displayedDatasets"
      :options="$options.options"
    ></line-chart>
  </div>
</template>

<script>
import numeral from "numeral";
import LineChart from "./LineChart";

// const datasets = {
//   "sup": {
//     label: "Support",
//     borderColor: "rgba(50, 115, 220, 0.5)",
//     backgroundColor: "rgba(50, 115, 220, 0.1)",
//     data: []
//   },
//   "conf": {
//     label: "Confidence",
//     borderColor: "rgba(255, 56, 96, 0.5)",
//     backgroundColor: "rgba(255, 56, 96, 0.1)",
//     data: [600, 550, 750, 250, 700]
//   }
// };

const options = {
  scales: {
    yAxes: [
      {
        ticks: {
          beginAtZero: true,
          callback: value => numeral(value).format("0,0%")
        }
      }
    ]
  },
  tooltips: {
    mode: "index",
    callbacks: {
      label(tooltipItem, data) {
        const label = data.datasets[tooltipItem.datasetIndex].label;
        const value = numeral(tooltipItem.yLabel).format("%");

        return `${label}: ${value}`;
      }
    }
  }
};
export default {
  name: "monthly-sales-chart",
  // datasets,
  options,
  components: {
    LineChart
  },
  mounted() {
    let minimum_sup = this.$route.params.support;
    let minimum_conf = this.$route.params.conf;
    this.min_sup = minimum_sup;
    this.min_conf = minimum_conf;
    console.log(this.min_sup);
    console.log(this.min_conf);
    this.getData(this.min_sup, this.min_conf);
    this.dataLabel = this.results.label_3;
    console.log("label mounted", this.dataLabel);
  },
  data() {
    return {
      selectedYears: ["sup", "conf"],
      results: {},
      min_sup: "",
      min_conf: "",
      total: "",
      lvl3: [],
      dataLabel: [],
      loaded: false,
      datasets: {
        "sup": {
          label: "Support (dalam x100)",
          borderColor: "rgba(50, 115, 220, 0.5)",
          backgroundColor: "rgba(50, 115, 220, 0.1)",
          data: []
        },
        "conf": {
          label: "Confidence",
          borderColor: "rgba(255, 56, 96, 0.5)",
          backgroundColor: "rgba(255, 56, 96, 0.1)",
          data: []
        }
      }
    };
  },
  computed: {
    displayedDatasets() {
      return this.selectedYears.map(sup => this.datasets[sup]);
    },
    dataL() {
      return this.results.label_3;
    }
  },
  created() {
    // this.getData(this.min_sup, this.min_conf);
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
          this.loaded = false;
          this.results = response.data;
          this.total = this.results.total_transaksi;

          let cnf_3 = this.min_conf;
          this.lvl3 = this.results.lvl_3.filter(function(lv) {
            return lv.conf >= cnf_3;
          });

          this.dataLabel = response.data.label_3;
          this.datasets.sup.data = response.data.support_3;
          this.datasets.conf.data = response.data.conf_3;
          console.log("dataset sup",this.datasets.sup.data);
          console.log("dataset conf",this.datasets.conf.data);
          console.log("label after axios:", this.dataLabel);
          this.loaded = true;
        });
    }
  }
};
</script>
