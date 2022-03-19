@extends('layouts.main')
@section('title','Isi Perjalanan Anda')
@section('content')
<style>
    body {
        font-family: 'Nunito';
    }
</style>
<div class="container">
    <div class="row mt-5 justify-content-center">
        {!! $qrcode !!} 
        {{-- <img src="{!! url('storage/app/img/qr-code', $qrcode) !!}" alt=""> --}}
    </div>
</div>
@endsection
    