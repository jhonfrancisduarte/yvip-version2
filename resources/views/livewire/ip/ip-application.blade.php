@extends('layouts.app')

@section('title')
    <title>IP Application</title>
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="css/ip-application.css">
@endsection

@section('content')

    <div class="main-content-wrapper">

        @livewire('main-nav')

        <div class="scroll-detector"></div>

        @livewire('tables.ip-application-table')

    </div>

@endsection