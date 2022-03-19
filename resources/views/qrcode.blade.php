@extends('layouts.main')
@section('title','Home')
@section('content')
<style>
    body {
        font-family: 'Nunito';
    }
</style>
<div class="container">
    <div class="row mt-5 text-center">
        {!! $qrcode !!}
    </div>
</div>
@endsection
    