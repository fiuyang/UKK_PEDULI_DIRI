<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Peduli Diri - Register</title>

    <link rel="stylesheet" href="{{ asset('assets/third-party/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/node_modules/fontawesome/css/all.min.css')}} ">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css')}} ">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css')}} ">
</head>

<body>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
                        <div class="login-brand">
                            <h4 class="text-dark font-weight-normal mt-3 text-center" style="font-size:25px!important; color:#666666!important;">
                                <span class="font-weight-bold">Buat Akun Peduli Diri</span>
                            </h4>
                        </div>

                        <div class="card card-primary">
                            <div class="card-header">
                                <h4>Register</h4>
                            </div>

                            <div class="card-body">
                                @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
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
                                <form method="POST" action="{{ route('register') }}" class="needs-validation" novalidate="">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="email">Email</label>
                                            <input id="email" type="email" class="form-control" name="email" tabindex="1" autofocus value="{{ old('email') }}">
                                            <div class="invalid-feedback">
                                                Tolong Isi Email anda
                                            </div>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="username">Username</label>
                                            <input id="username" type="text" class="form-control" name="username" tabindex="1" autofocus value="{{ old('username') }}">
                                            <div class="invalid-feedback">
                                                Tolong Isi Username anda
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <label for="no_telepon">No Telepon</label>
                                            <input id="no_telepon" type="text" class="form-control" name="no_telepon" tabindex="1" autofocus value="{{ old('no_telepon') }}">
                                            <div class="invalid-feedback">
                                                Tolong Isi No Telepon anda
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="nik">Nik</label>
                                            <input id="nik" type="number" class="form-control" name="nik" tabindex="1" autofocus value="{{ old('nik') }}">
                                            <div class="invalid-feedback">
                                                Tolong Isi Nik anda
                                            </div>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="password">Password</label>
                                            <input id="password" type="password" class="form-control" name="password" tabindex="1" autofocus value="{{ old('password') }}">
                                            <div class="invalid-feedback">
                                                Tolong Isi Password anda
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block">
                                            Daftar
                                        </button>
                                    </div>
                                    <div class="mt-5 text-center">
                                        <div class="mb-5 text-danger">
                                        </div>
                                        Sudah Punya Akun? <a href="{{ route('login') }}">Kembali</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="simple-footer">
                            Copyright &copy; Bayu 2022
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script src="{{asset('assets/third-party/jquery.min.js')}}"></script>
    <script src="{{asset('assets/third-party/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/third-party/jquery.nicescroll.min.js')}}"></script>
    <script src="{{asset('assets/js/stisla.js')}}"></script>

    <!-- Template JS File -->
    <script src="{{asset('assets/js/scripts.js')}}"></script>
    <script src="{{asset('assets/js/custom.js')}}"></script>

</body>

</html>