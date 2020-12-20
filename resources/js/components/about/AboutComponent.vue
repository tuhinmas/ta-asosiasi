 <!-- We put our HTML code inside template tag -->
<template>
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">About</h3>
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
            <h4>Aplikasi ini dibangun dengan beberapa teknologi:</h4>
            <ul>
                <li><h5>Frontend dengan Vue 2.*</h5></li>
                <li><h5>Backend dengan Laravel 6.8</h5></li>
                <li><h5>AdminLTE</h5></li>
                <li><h5>Integrasi Frontend dan Backend dengan Axios</h5></li>
                <li><h5>Validasi form dengan VForm</h5></li>
                <li><h5>Cache dengan Redis database</h5></li>
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