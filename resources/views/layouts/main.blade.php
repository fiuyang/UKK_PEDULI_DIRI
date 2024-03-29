
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Peduli Diri - @yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{  asset('assets/img/peduli_diri.svg')  }}" />
    {{-- <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css"> --}}
    <link rel="stylesheet" href="{{ asset('assets/node_modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/node_modules/timepicker/jquery.timepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/node_modules/fontawesome/css/all.min.css')}} ">
    <link rel="stylesheet" href="{{ asset('assets/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}} ">
    <link rel="stylesheet" href="{{ asset('assets/node_modules/bootstrap-daterangepicker/daterangepicker.css')}} ">
    <link rel="stylesheet" href="{{ asset('assets/node_modules/swal/dist/sweetalert2.min.css')}} ">
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css')}} ">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css')}} ">
    @yield('styles')
</head>

<body class="layout-3">
    <div id="app">
        <div class="main-wrapper container">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <a href="#" class="navbar-brand sidebar-gone-hide">PEDULI DIRI</a>
                <div class="navbar-nav">
                    <a href="#" class="nav-link sidebar-gone-show" data-toggle="sidebar"><i class="fas fa-bars"></i></a>
                </div>
                
                <form class="form-inline ml-auto">
                </form>
                <ul class="navbar-nav navbar-right">
                    
                    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                        @if(Auth::user()->avatar)
                        <img alt="image" src="{{ asset('assets/img/avatar/avatar-1.png') }}" class="rounded-circle">
                        @else
                        <img alt="image" src="{{ asset('assets/images/' . Auth::user()->avatar) }}" class="rounded-circle mr-1">
                        @endif
                        <div class="d-sm-none d-lg-inline-block">Hi, {{ ucwords(Auth::user()->username) }}</div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="{{ route('profile', Auth::user()->id) }}" class="dropdown-item has-icon">
                            <i class="far fa-user"></i> Profile
                        </a>
                        <a href="javascript:void(0)" onclick="logout()" role="button" class="dropdown-item has-icon text-danger">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </div>
                </li>
            </ul>
        </nav>
        
        <nav class="navbar navbar-secondary navbar-expand-lg">
            <div class="container">
                <ul class="navbar-nav">
                    @if (Auth::user()->role == "admin")
                    <li class="nav-item {{ Request::is('admin/dashboard') ? 'active' : '' }}">
                        <a href="{{ route('dashboard') }}" class="nav-link "><i class="fas fa-home"></i><span>Dashboard</span></a>
                    </li>
                    <li class="nav-item {{ Request::is('admin/destinasi') ? 'active' : '' }}">
                        <a href="{{ route('destinasi.index') }}" class="nav-link"><i class="fas fa-clipboard"></i><span>Destinasi</span></a>
                    </li>
                    <li class="nav-item {{ Request::is('admin/destinasi/create') ? 'active' : '' }}">
                        <a href="{{ route('destinasi.create') }}" class="nav-link"><i class="fas fa-book-open"></i><span>Isi Data</span></a>
                    </li>
                    <li class="nav-item {{ Request::is('admin/pengguna') ? 'active' : '' }}">
                        <a href="{{ route('pengguna.index') }}" class="nav-link"><i class="fas fa-users"></i><span>Users</span></a>
                    </li>
                    @endif
                    @if (Auth::user()->role == 'user')
                    <li class="nav-item {{ Request::is('user/dashboard-user') ? 'active' : '' }}">
                        <a href="{{ route('dashboard-user') }}" class="nav-link "><i class="fas fa-home"></i><span>Home</span></a>
                    </li>
                    <li class="nav-item {{ Request::is('user/perjalanan') ? 'active' : '' }}">
                        <a href="{{ route('perjalanan.index') }}" class="nav-link"><i class="fas fa-user"></i><span>Data Perjalanan</span></a>
                    </li>
                    <li class="nav-item {{ Request::is('user/scanner') ? 'active' : '' }}">
                        <a href="{{ route('scanner') }}" class="nav-link"><i class="fas fa-qrcode"></i><span>Scanner QRcode</span></a>
                    </li>
                    <li class="nav-item {{ Request::is('user/perjalanan/create') ? 'active' : '' }}">
                        <a href="{{ route('perjalanan.create') }}" class="nav-link"><i class="fas fa-book-open"></i><span>Manual</span></a>
                    </li>
                    <li class="nav-item {{ Request::is('user/log') ? 'active' : '' }}">
                        <a href="{{ route('log.index') }}" class="nav-link"><i class="fas fa-history"></i><span>Log</span></a>
                    </li>
                    @endif
                </ul>
                <img src="{{ asset('assets/img/peduli_diri.svg') }}" alt="logo" width="180" class="mb-5 mt-5 img-responsive">
            </div>
        </nav>
        
        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <h1>@yield('title')</h1>
                    <div class="section-header-breadcrumb">
                        <div class="breadcrumb-item active"><a href="#">@yield('title')</a></div>
                    </div>
                </div>
            </section>
            @yield('content')
        </div>
        <footer class="main-footer">
            <div class="footer-left">
                Copyright &copy; {{ date('Y') }} <div class="bullet">Development By <a href="https://github.com/bayudiartaa" target="_blank">Bayudiarta Laksono</a>
                </div>
                <div class="footer-right">
                    2.3.0
                </div>
            </footer>
        </div>
    </div>
    
    <!-- General JS Scripts -->
    <script src="{{asset('assets/third-party/jquery.min.js')}}"></script>
    <script src="{{asset('assets/third-party/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/third-party/jquery.nicescroll.min.js')}}"></script>
    <script src="{{asset('assets/third-party/moment.min.js')}}"></script>
    <script src="{{asset('assets/js/stisla.js')}}"></script>
    
    <!-- JS Libraies -->
    <script src="{{asset('assets/node_modules/swal/dist/sweetalert2.all.min.js')}}"></script>
    <script src="{{asset('assets/node_modules/datatables/media/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/node_modules/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
    <script src="{{asset('assets/js/jquery.uploadPreview.min.js')}}"></script>
    <!-- Template JS File -->
    <script src="{{asset('assets/js/scripts.js')}}"></script>
    <script src="{{asset('assets/js/custom.js')}}"></script>
    <script src="{{ asset('assets/node_modules/instascan.min.js') }}"></script>
    <script src="{{ asset('assets/node_modules/timepicker/jquery.timepicker.js') }}"></script>

    @yield('script')
    <script>
        function logout() {
            Swal.fire({
                title: 'Apakah anda yakin akan Keluar?',
                icon: 'warning',
                showCancelButton: false,
                showConfirmButton: false,
                html : '<a href="{{ route('logout') }}" class="btn btn-info btn-lg">Keluar</a> <button href="javascript:void(0)" onclick="swal.close()" class="btn btn-danger btn-lg">Batal</button>'            
            });
        }
    </script>
</body>
</html>
