@extends ('layouts.layout')

@section ('title')
    <title>Youth Registration</title>
@endsection

@section ('css')
    <link href="Login and Register/css/main.css" rel="stylesheet" media="all">
    <link rel="stylesheet" type="text/css" href="client/file.css">
@endsection


@section ('main-content')

    @livewire('register')

@endsection

@section ('js')
    
@endsection
