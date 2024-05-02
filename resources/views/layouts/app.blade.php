<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ asset('images/yvip_logo.png') }}">

    @yield('title')

    @yield ('css')
    @livewireStyles
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="Login and Register/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="Login and Register/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="Login and Register/vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="Login and Register/vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">
    <link href="Login and Register/css/main.css" rel="stylesheet" media="all">
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" type="text/css" href="css/global.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">

     <div class="wrapper">
        <!--Top Navbar Buttons -->
        <nav class="main-header navbar navbar-expand navbar-light navbar-pink">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link navs" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                {{-- <li class="nav-item">
                    <a class="nav-link navs" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li> --}}
                <li class="nav-item">
                    <div class="userpanel">
                        <div class="info">
                            @if(session('user_role') == 'yv' || session('user_role') == 'yip')
                                <a href="{{ route('profile') }}" class="d-block" wire:navigate>{{ auth()->user()->name }}</a>
                            @else
                                <a href="{{ route('admin-profile') }}" class="d-block" wire:navigate>{{ auth()->user()->name }}</a>
                            @endif
                        </div>
                        <div class="image">
                            @if(session('user_role') == 'yv' || session('user_role') == 'yip')
                                <a href="{{ route('profile') }}"><img src="{{ asset(auth()->user()->userData->profile_picture) }}" class="img-circle elevation-2" alt="User Image" style="width: 35px; height: 35px;"></a>
                            @else
                                <a href="{{ route('admin-profile') }}"><img src="{{ asset(auth()->user()->admin->profile_picture) }}" class="img-circle elevation-2" alt="User Image" style="width: 35px; height: 35px;"></a>
                            @endif

                        </div>
                    </div>
                </li>
            </ul>
        </nav>
    </div>

    @yield('content')

    @yield('js')

    <script>
        var table = document.getElementById('volunteers-table');
        var isHovering = false;

        table.addEventListener('mouseenter', function() {
            isHovering = true;
        });

        table.addEventListener('mouseleave', function() {
            isHovering = false;
        });

        document.getElementById('scroll-table').addEventListener('wheel', function(event) {
            if (isHovering) {
                event.preventDefault();
                this.scrollLeft += event.deltaY;
            }
        });
    </script>

    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <script src="dist/js/adminlte.js"></script>
    <script src="dist/js/demo.js"></script>
    <script src="dist/js/pages/dashboard.js"></script>
    <script src="js/dashboard.js"></script>
    @livewireScripts


</body>
</html>
