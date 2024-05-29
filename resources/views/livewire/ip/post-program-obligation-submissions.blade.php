@extends('layouts.app')

@section('title')
    <title>Post-Program Obligation</title>
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="css/ppo.css">
    <link rel="stylesheet" type="text/css" href="css/ip-events.css">
    <link rel="stylesheet" type="text/css" href="css/events-and-trainings.css">
@endsection

@section('content')

 
    <div class="main-content-wrapper">

        @livewire('main-nav')

        <div class="scroll-detector"></div>

        @livewire('tables.post-program-obligation-submissions-table')
        
    </div>

@endsection