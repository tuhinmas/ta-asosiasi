@extends('layouts.main')

@push('css')

@endpush
@section('konten')
<div class="content-header"></div>
    <div id="app">
        <div class="container">
            <div class="row">
                <div class="col">
                    <invoice-component/>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
 
@endpush