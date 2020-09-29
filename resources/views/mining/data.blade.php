@extends('layouts.main')

@push("css")
    <link rel="stylesheet" href="{{ asset ('/template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset ('/template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
@endpush

@section('konten')
    <div class="content-header">
        <div id="app">
            <div class="container-fluid">
                <data-mining-component/>
            </div>
        </div>
    </div>
@endsection

@push ("scripts")
    <script src="{{ asset ('/template/plugins/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset ('/template/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset ('/template/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset ('/template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
@endpush
