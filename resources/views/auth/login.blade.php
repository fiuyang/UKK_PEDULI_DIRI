<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Login - Peduli Diri</title>

    <link rel="stylesheet" href="{{ asset('assets/third-party/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/node_modules/fontawesome/css/all.min.css')}} ">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css')}} ">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css')}} ">
</head>

<body>
    <div id="app">
        <section class="section">
            <div class="d-flex flex-wrap align-items-stretch">
                <div class="col-lg-4 col-md-6 col-12 order-lg-1 min-vh-100 order-2 bg-white">
                  <div class="p-4 m-3">
                      <img src="{{ asset('assets/img/avatar/avatar-1.png') }}" alt="logo" width="80" class="shadow-light rounded-circle mb-5 mt-2 img-responsive center-block d-block mx-auto">
                        <h4 class="text-dark font-weight-normal mt-5 text-center">Selamat Datang Ke <span class="font-weight-bold">Peduli Diri</span></h4>
                          <p class="text-center">Sebelum memulai, Anda harus login atau mendaftar jika Anda belum memiliki akun.</p>
                        <br>
                        @if(session('error')) 
                            <div class="alert alert-danger alert-dismissible fade show" id="alert" role="alert">
                                {{ session('error') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate="">
                          @csrf
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" type="email" class="form-control" name="email" placeholder="Email" tabindex="1" required autofocus>
                                <div class="invalid-feedback">
                                    Tolong Isi Email anda
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input id="password" type="password" class="form-control" name="password" placeholder="Password" tabindex="2" required autofocus>
                                <div class="invalid-feedback">
                                    Tolong Isi Password anda
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg btn-block">
                                    Login
                                </button>
                            </div>

                            <div class="mt-5 text-center">
                                <div class="mb-5 text-danger">
                                </div>
                                Belum Punya Akun? <a href="{{ route('register') }}">Buat Akun</a>
                            </div>
                        </form>

                        <div class="text-center mt-2 text-small">
                            Copyright &copy; Bayu. Made with Stisla

                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-12 order-lg-2 order-1 min-vh-100 background-walk-y position-relative overlay-gradient-bottom" data-background="{{ asset('assets/img/bromo2.jpg') }}">
                    <div class="absolute-bottom-left index-2">
                        <div class="text-light p-5 pb-2">
                            <div class="mb-5 pb-3">
                                <h1 class="mb-2 display-4 font-weight-bold">WELCOME</h1>
                                <h5 class="font-weight-normal text-muted-transparent">Mount Bromo, Indonesia</h5>
                            </div>
                            Photo by <a class="text-light bb" target="_blank" href="https://unsplash.com/@heytherenindy">Nindy Rahmadani
                            </a> on <a class="text-light bb" target="_blank" href="https://unsplash.com">Unsplash</a>
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

    <!-- Page Specific JS File -->
</body>

</html>