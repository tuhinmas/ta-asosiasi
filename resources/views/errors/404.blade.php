  @extends('layouts.main')
  @section('konten')
     <!-- Content Wrapper. Contains page content -->
        <!-- Content Header (Page header) -->
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1>404 Error Page</h1>
            </div>
            {{-- <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">404 Error Page</li>
                </ol>
            </div> --}}
            </div>
        </div><!-- /.container-fluid -->

        <!-- Main content -->
        <section class="content">
        <div class="error-page">
            <h2 class="headline text-warning"> 404</h2>

            <div class="error-content">
            <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Halaman tidak ditemukan.</h3>

            <p>
                Kami tidak menemukan halaman yang anda cari.
                Pastikan alamat yang anda masukan benar, atau hubungi pihak pengembang.
            </p>
            <p>
                <a href="{{ url('/') }}"><b>Refreash</b></a>
            </p>

            <form class="search-form">
                <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search">

                <div class="input-group-append">
                    <button type="submit" name="submit" class="btn btn-warning"><i class="fas fa-search"></i>
                    </button>
                </div>
                </div>
                <!-- /.input-group -->
            </form>
            </div>
            <!-- /.error-content -->
        </div>
        <!-- /.error-page -->
        </section>
        <!-- /.content -->
    </div>  
  @endsection
 
