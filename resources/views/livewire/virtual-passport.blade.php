@extends('layouts.app')

@section('title')
    <title>My Virtual Passport</title>
@endsection

@section('css')
    <link rel="stylesheet" href="css/passport.css">
@endsection

@section('content')

    <div class="main-content-wrapper">

        @livewire('main-nav')

        <div class="scroll-detector"></div>

        @livewire('tables.virtual-passport-table')

    </div>

@endsection
