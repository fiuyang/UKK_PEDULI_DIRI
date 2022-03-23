@extends('layouts.main')
@section('title','Setting Profile')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link {{ (request()->segment(2) == 'profile') ? 'active' : '' }}" href="{{ route('profile', $user->id) }}">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('password', $user->id) }}">Change Password</a>
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
                <form method="POST" action="{{ route('profile.update', $user->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" name="username" id="username" value="{{ $user->username }}">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" value="{{ $user->email }}">
                    </div>
                    <div class="form-group">
                        <label for="avatar">Foto</label>
                        <div class="col-sm-10">
                            <div id="image-preview" class="image-preview">
                                <label for="image-upload" id="image-label">Pilih Foto</label>
                                <input type="file" name="avatar" id="image-upload" value="{{ $user->avatar }}" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Kofirmasi Password</label>
                        <input type="password" name="password" class="form-control" value="{{ old('confirm-password') }}"/>
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