@extends('layouts.main')
@section('title','Isi Data Admin') 
@section('content')
<style type="text/css">
    .upload-btn-wrapper {
    position: relative;
    overflow: hidden;
    display: inline-block;
}
.upload-btn-wrapper input[type=file] {
    font-size: 100px;
    position: absolute;
    left: 0;
    top: 0;
    opacity: 0;
}
.rounded-image {
    border-radius: 50%;
    width: 150px;
    height: 150px;
    border: 5px solid rgba(0, 0, 0, 0.4);
    overflow: hidden;
}

.rounded-image:before {
    content: "";
    background-size: cover;
    width: 100%;
    height: 100%;
    display: block;
    overflow: hidden;
}
</style>
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
                <form method="POST" action="{{ route('pengguna.update', $pengguna->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="username">Username</label>
                            <input id="username" type="text" class="form-control" name="username" tabindex="1" autofocus value="{{ old('username', $pengguna->username) }}">
                            <div class="invalid-feedback">
                                Tolong Isi Username anda
                            </div>
                        </div>
                        <div class="form-group col-6">
                            <label for="email">Email</label>
                            <input id="email" type="email" class="form-control" name="email" tabindex="1" autofocus value="{{ old('email', $pengguna->email) }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="no_telepon">No Telepon</label>
                            <input id="no_telepon" type="text" class="form-control" name="no_telepon" tabindex="1" autofocus value="{{ old('no_telepon', $pengguna->no_telepon) }}">
                        </div>
                        <div class="form-group col-6">
                                <div class="card card-small mb-4 pt-3">
                                    <div class="card-header border-bottom text-center">
                                        <div class="mb-3 mx-auto">
                                            @if($pengguna->avatar === null)
                                            <img id="imageResult" class="rounded-image" src="{{ asset('assets/img/avatars/avatar-1.png')}}" alt="User Avatar" width="100%"> 
                                            @else
                                            <img id="imageResult" class="rounded-image" src="{{ asset('assets/images'.$pengguna->avatar) }}" alt="User Avatar" width="150px"> 
                                            @endif
                                        </div>
                                        <div class="upload-btn-wrapper">
                                            <button type="button" class="mb-2 btn btn-sm btn-pill btn-outline-primary mr-2">
                                            Change Profile</button>
                                            <input type="file" name="avatar" id="avatar" onchange="readURL(this);"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        {{-- <div class="form-group col-6">
                        <label for="avatar">Foto</label>
                            <div class="col-sm-10">
                                <div id="image-preview" class="image-preview">
                                    <label for="image-upload" id="image-label">Pilih Foto</label>
                                    <input type="file" name="avatar" id="image-upload" value="{{ old('avatar', $pengguna->avatar) }}" />
                                </div>
                            </div>
                        </div> --}}
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="nik">Nik</label>
                            <input id="nik" type="number" class="form-control" name="nik" tabindex="1" autofocus value="{{ old('nik', $pengguna->nik) }}">
                        </div>
                        <div class="form-group col-6">
                            <label for="password">Password</label>
                            <div class="input-group-prepend">
                                <input id="password" type="password" class="form-control" name="password" placeholder="Password" tabindex="2" autofocus  value="{{ old('password') }}">
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
    // $.uploadPreview({
    //     input_field: "#image-upload", // Default: .image-upload
    //     preview_box: "#image-preview", // Default: .image-preview
    //     label_field: "#image-label", // Default: .image-label
    //     label_default: "Pilih Foto", // Default: Choose File
    //     label_selected: "Ganti Foto", // Default: Change File
    //     no_label: false, // Default: false
    //     success_callback: null // Default: null
    // });

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

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#imageResult')
                    .attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    $(function () {
        $('#upload').on('change', function () {
            readURL(input);
        });
    });

        var input = document.getElementById( 'upload' );
        var infoArea = document.getElementById( 'upload-label' );

        input.addEventListener( 'change', showFileName );
        function showFileName( event ) {
        var input = event.srcElement;
        var fileName = input.files[0].name;
        infoArea.textContent = 'File name: ' + fileName;
    }
</script>
@endsection