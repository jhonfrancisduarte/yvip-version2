@extends('layouts.app')

@section('title')
    <title>Past IP Events</title>
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="css/events-and-trainings.css">
    <link rel="stylesheet" type="text/css" href="css/past-participated-event.css">
@endsection

@section('content')

    <div class="main-content-wrapper">

        @livewire('main-nav')

        <div class="scroll-detector"></div>

        @if(session('user_role') !== 'yv' && session('user_role') !== 'yip')
            @livewire('tables.admin-ip-validation')
        @else
            @livewire('tables.past-ip-participated-events-table')
        @endif

    </div>

@endsection

