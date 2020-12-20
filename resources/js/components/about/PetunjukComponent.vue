 <!-- We put our HTML code inside template tag -->
<template>
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Petunjuk</h3>
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
            <h4>Data Mining</h4>
            <ul>
                <li><h5>Sesuaikan input yang diinginkan di Parameter</h5></li>
                <li><h5>Pilih tampilan hasil yang diinginkan (tabel/grafik)</h5></li>
            </ul>
            <h4>Transaksi</h4>
            <ul>
                <li><h5>Masukkan kode produk atau nama produk di form kode produk</h5></li>
                <li><h5>Pilih produk dan sesuaikan QTY nya</h5></li>
                <li><h5>Harga sudah termasuk PPN dan Diskon</h5></li>
                <li><h5>Struk dapat dicetak setelah transaksi sukses</h5></li>
            </ul>
            <h4>Laporan</h4>
            <ul>
                <li><h5>Secara default laporan dicetak dalam 1 bulan terakhir</h5></li>
                <li><h5>Semakin lama rentang waktu laporan semakin lama prosesnya</h5></li>
            </ul>
        </div>
      </div>
    </div>
  </div>
</template>

<!-- We put our scripts inside script tag -->
<script>
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