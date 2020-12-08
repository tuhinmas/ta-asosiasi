<template>
  <div class="row">
    <div class="col">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Laporan</h3>
        </div>
        <div class="card-body">
          <div class="form-group">
            <label>Mulai Tanggal:</label>
            <datepicker
              :calendar-button="true"
              calendar-button-icon="fas fa-calendar"
              v-model="date_before"
            ></datepicker>
            <div class="mt-5"></div>
            <label>Sampai Tanggal:</label>
            <datepicker
              :calendar-button="true"
              calendar-button-icon="fas fa-calendar"
              v-model="date_after"
            ></datepicker>
          </div>
        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-primary" @click="printLaporan()">Cetak Laporan</button>
        </div>
        <!-- /.card-body -->
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: "report-component",
  data() {
    return {
      date_after: '',
      date_before:'',
      cek:''
    };
  },
  methods:{
     currentDateTime() {
      const current = new Date();
      const date = current.getFullYear()+'-'+(current.getMonth()+1)+'-'+current.getDate();
      const time = current.getHours() + ":" + current.getMinutes() + ":" + current.getSeconds();
      const dateTime = date +' '+ time;

      const date_month = current.getFullYear()+'-'+(current.getMonth())+'-'+current.getDate();
      this.date_after = date;
      this.date_before =  date_month;
    },
    printLaporan(){
      let akhir = moment(this.date_after).format('YYYY-MM-DD');
      let awal = moment(this.date_before).format('YYYY-MM-DD');

      axios.get('/pdf-transaction-report',{
        params:{
          first:awal,
          end:akhir
        },
      })
           .then(res =>{
             this.cek = res.data;
             console.log(this.cek);
           });
    }
  },
  created(){
    this.currentDateTime();
  },
  mounted(){
    this.currentDateTime();
    console.log(this.date_before);
  }
};
</script>