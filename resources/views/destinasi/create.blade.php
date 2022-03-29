@extends('layouts.main')
@section('title','Isi Data')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
                        <span class="alert-inner--text">
                            {{ session('success') }}
                        </span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if($errors->any())
                <div class="alert alert-danger" role="alert">
                    <ul>
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form method="POST" action="{{ route('destinasi.store') }}">
                    @csrf
                    <div class="form-group">
                        <input type="hidden" name="users_id" value="{{Auth::user()->id}}">
                        <label for="tanggal">Nama Destinasi</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="nama_destinasi" id="destinasi" value="{{ old('nama_destinasi') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="lokasi">Lokasi Destinasi</label>
                        <textarea name="lokasi_destinasi" id="lokasi" class="form-control" style="height:150px" value="{{ old('lokasi_destinasi') }}"></textarea>
                    </div>
                    <div class="text-right">
                        <a href="{{ route('destinasi.index') }}" class="btn btn-danger">Kembali</a>
                        <button class="btn btn-primary" type="submit">Store</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection