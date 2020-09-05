<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--
We have to include public/css/app.css
Add the following code inside head tag 
-->
<link rel="stylesheet" type="text/css" href="/css/app.css">
  @stack('script-head')
  @stack("css")
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  @include('layouts.menu.navBar')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->

  @include('layouts.menu.sideBar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
          @yield('konten')
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.0.5
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

 <!-- 
We have to include public/js/app.js 
Add the following code before end of body tag
-->
@if( app()->environment('local') )
  <script src="{{ mix('js/app.js') }}"></script>
@else
  <script src="{{ url('/js/app.js') }}"></script>
@endif 

@stack('script')
@stack ("scripts")

</body>
</html>

 