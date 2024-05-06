<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="images/yvip_logo.png">

    @yield('title')

    @yield ('css')
    @livewireStyles
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" type="text/css" href="css/global.css">
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
                                <a href="{{ route('profile') }}" class="d-block">{{ Auth::user()->userData->first_name }} {{ Auth::user()->userData->middle_name }} {{ Auth::user()->userData->last_name }}</a>
                            @else
                                <a href="{{ route('admin-profile') }}" class="d-block">{{ Auth::user()->admin->first_name }} {{ Auth::user()->admin->middle_name }} {{ Auth::user()->admin->last_name }}</a>
                            @endif
                        </div>
                        <div class="image">
                            @if(session('user_role') == 'yv' || session('user_role') == 'yip')
                                <a href="{{ route('profile') }}"><img src="{{ Auth::user()->userData->profile_picture }}" class="img-circle elevation-2" alt="User Image" style="width: 35px; height: 35px;"></a>
                            @else
                                <a href="{{ route('admin-profile') }}"><img src="{{ Auth::user()->admin->profile_picture }}" class="img-circle elevation-2" alt="User Image" style="width: 35px; height: 35px;"></a>
                            @endif
                        </div>
                    </div>
                </li>
            </ul>
        </nav>
    </div>

    @yield('content')

    <script>
        var table = document.getElementById('volunteers-table');
        var isHovering = false;

        if (table) {
            table.addEventListener('mouseenter', function() {
                isHovering = true;
            });

            table.addEventListener('mouseleave', function() {
                isHovering = false;
            });
        }

        var scrollTable = document.getElementById('scroll-table');

        if (scrollTable) {
            scrollTable.addEventListener('wheel', function(event) {
                if (isHovering) {
                    event.preventDefault();
                    this.scrollLeft += event.deltaY;
                }
            });
        }
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

    @yield('js')

</body>
</html>