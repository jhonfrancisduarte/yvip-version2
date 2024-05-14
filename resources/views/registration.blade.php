@extends ('layouts.layout')

@section ('title')
    <title>Youth Registration</title>
@endsection

@section ('css')
    <link href="Login and Register/css/main.css" rel="stylesheet" media="all">
    <link rel="stylesheet" type="text/css" href="/Client/file.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/global.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
@endsection


@section ('main-content')

    @livewire('register')

@endsection
