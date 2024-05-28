@extends('layouts.app')

@section('title')
    <title>Volunteer Hours</title>
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="css/volunteers.css">
@endsection

@section('content')

    <div class="main-content-wrapper">

        @livewire('main-nav')

        <div class="scroll-detector"></div>

        @livewire('tables.volunteer-hours-table')
        
    </div>

@endsection
