@extends('layouts.main')
@section('title','Change Password')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('profile', $user->id) }}">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ (request()->segment(2) == 'profile') ? 'active' : '' }}" href="{{ route('password', $user->id) }}">Change Password</a>
                </li>
            </ul>
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
                <form method="POST" action="{{ route('password.change', $user->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="current_password">Password Lama</label>
                        <input type="password" class="form-control" name="current_password" id="current_password">
                    </div>
                    <div class="form-group">
                        <label for="new_password">Password Baru</label>
                        <input type="password" class="form-control" name="new_password" id="new_password">
                    </div>
                    <div class="form-group">
                        <label>Konfirmasi Password</label>
                        <input type="password" name="confirm-password" value="{{ old('confirm-password') }}"class="form-control" />
                    </div>
                    <div class="text-center">
                        <a href="{{ route('perjalanan.index') }}" class="btn btn-danger">Kembali</a>
                        <button class="btn btn-primary" type="submit">Store</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $.uploadPreview({
        input_field: "#image-upload", // Default: .image-upload
        preview_box: "#image-preview", // Default: .image-preview
        label_field: "#image-label", // Default: .image-label
        label_default: "Pilih Foto", // Default: Choose File
        label_selected: "Ganti Foto", // Default: Change File
        no_label: false, // Default: false
        success_callback: null // Default: null
    });
</script>
@endsection