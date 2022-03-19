@extends('layouts.main')
@section('title','Home')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header"></div>
            <div class="section-body">
                <div class="col-12 mb-4">
                    <div class="hero text-white hero-bg-image hero-bg-parallax" data-background="{{ asset('assets/img/unsplash/andre-benz-1214056-unsplash.jpg') }}">
                        <div class="hero-inner">
                            <h2>Welcome, {{ Auth::user()->username }}</h2>
                            <p class="lead">Anda Telah Berhasil Masuk Ke Aplikasi Peduli Diri</p>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
    