<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="images/yvip_logo.png">

    @yield ('title')
    @yield ('css')
    @livewireStyles
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="Login and Register/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="Login and Register/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="Login and Register/css/main.css" rel="stylesheet" media="all">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body class="hold-transition sidebar-mini layout-fixed">

        @yield ('header')

        <main>
            @yield ('main-content')
        </main>

        @yield ('footer')

        @yield ('js')


        <script src="Login and Register/vendor/jquery/jquery.min.js"></script>
        <script src="Login and Register/vendor/select2/select2.min.js"></script>
        <script src="Login and Register/vendor/datepicker/moment.min.js"></script>
        <script src="Login and Register/vendor/datepicker/daterangepicker.js"></script>
        <script src="Login and Register/js/global.js"></script>

</body>
</html>
