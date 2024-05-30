@extends('layouts.app')

@section('title')
    <title>IP Events List</title>
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="css/ip-events.css">
@endsection

@section('content')

    <div class="main-content-wrapper">

        @livewire('main-nav')

        <div class="scroll-detector"></div>

        @livewire('tables.ip-events-table')

    </div>

@endsection

