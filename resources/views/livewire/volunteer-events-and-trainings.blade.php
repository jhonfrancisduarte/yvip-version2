@extends('layouts.app')

@section('title')
    <title>Volunteers Events and Trainings Dashboard</title>
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="css/events-and-trainings.css">
@endsection

@section('content')

    <div class="main-content-wrapper">

        @livewire('main-nav')

        <div class="scroll-detector"></div>
        
        @livewire('volunteer-events-and-trainings-table')
    </div>

@endsection