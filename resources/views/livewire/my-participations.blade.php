@extends('layouts.app')

@section('title')
    <title>My Participated YV Events</title>
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="css/ip-events.css">
@endsection

@section('content')
    
    <div class="main-content-wrapper">

        @livewire('main-nav')

        <div class="scroll-detector"></div>

        @livewire('tables.my-participated-yv-events-table')

    </div>

@endsection

