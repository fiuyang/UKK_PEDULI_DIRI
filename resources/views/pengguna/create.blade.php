@extends('layouts.main')
@section('title','Isi Data Admin') 
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
                <form method="POST" action="{{ route('pengguna.store') }}" class="needs-validation" novalidate="" enctype="multipart/form-data">
                @csrf
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="username">Username</label>
                            <input id="username" type="text" class="form-control" name="username" tabindex="1" autofocus value="{{ old('username') }}">
                            <div class="invalid-feedback">
                                Tolong Isi Username anda
                            </div>
                        </div>
                        <div class="form-group col-6">
                            <label for="email">Email</label>
                            <input id="email" type="email" class="form-control" name="email" tabindex="1" autofocus value="{{ old('email') }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="no_telepon">No Telepon</label>
                            <input id="no_telepon" type="text" class="form-control" name="no_telepon" tabindex="1" autofocus value="{{ old('no_telepon') }}">
                        </div>
                        <div class="form-group col-6">
                        <label for="avatar">Foto</label>
                        <div class="col-sm-10">
                            <div id="image-preview" class="image-preview">
                                <label for="image-upload" id="image-label">Pilih Foto</label>
                                <input type="file" name="avatar" id="image-upload" value="{{ old('avatar') }}" />
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="nik">Nik</label>
                            <input id="nik" type="number" class="form-control" name="nik" tabindex="1" autofocus value="{{ old('nik') }}">
                        </div>
                        <div class="form-group col-6">
                            <label for="password">Password</label>
                            <div class="input-group-prepend">
                                <input id="password" type="password" class="form-control" name="password" placeholder="Password" tabindex="2" autofocus>
                                <button type="button" onclick="seePassword(this)" class="input-group-text" id="seePass"><i class="fas fa-eye"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-lg btn-block">
                            Store
                        </button>
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

    // toggle password
    function seePassword(icon) {
        try {
            var icon = $(`#${icon.id} i`);
            var inputPass = $('input[id="password"]')
            var type = 'password'
            if (icon.attr('class') === 'fas fa-eye') {
                type = 'text'
                icon.removeClass().addClass('fas fa-eye-slash')
            } else {
                icon.removeClass().addClass('fas fa-eye')
            }
            inputPass.map((i, input) => {
                $(`input[name="${input.name}"]`).attr('type', type)
            })
            return true;
        } catch (error) {
            console.log(error)
            return false;
        }
    }
</script>
@endsection