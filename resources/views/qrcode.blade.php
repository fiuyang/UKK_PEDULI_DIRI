@extends('layouts.main')
@section('title','Qrcode Destinasi')
@section('content')
<style>
    body {
        font-family: 'Nunito';
    }
</style>
<div class="container">
    <div class="row mt-5">
        <div class="col-md-4">
            <a href="{{ route('destinasi.index') }}" class="btn btn-danger">Kembali</a>
        </div>
        <div class="col-md-8">
            <div class="justify-content-center">
                {!! $qrcode !!}
                <img src="{!! url('storage/app/img/qrcode/qr-', $qrcode) !!}" alt="">
            </div>
        </div>
    </div>
</div>
@endsection
    