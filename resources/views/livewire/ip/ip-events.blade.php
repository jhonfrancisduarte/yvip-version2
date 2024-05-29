@extends('layouts.app')

@section('title')
    <title>IP Events</title>
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="css/ip-events.css">
    <link rel="stylesheet" type="text/css" href="css/events-and-trainings.css">
@endsection

@section('content')

    <div class="main-content-wrapper">

        @livewire('main-nav')

        <div class="scroll-detector"></div>
    
        @livewire('tables.ip-events-table')
        
    </div>

@endsection