@extends('layouts.main')

@push('css')

@endpush
@section('konten')
<div class="content-header"></div>
    <div id="app">
        <div class="container">
            <div class="row">
                <div class="col">
                    <pagination-component/>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://unpkg.com/vuejs-paginate@latest"></script>
@endpush