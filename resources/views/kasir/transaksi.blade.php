@extends('layouts.main')

@push('css')

@endpush
@section('konten')
<div class="content-header"></div>
    <div id="app">
            <div class="row">
                <div class="col">
                    <transaction-component/>
                </div>
            </div>
    </div>
@endsection
@push('scripts')
    <script src="https://unpkg.com/vuejs-paginate@latest"></script>
@endpush