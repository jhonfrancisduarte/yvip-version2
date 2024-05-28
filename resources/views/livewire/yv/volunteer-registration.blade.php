@extends('layouts.app')

@section('title')
    <title>Volunteer Registration</title>
@endsection

@section('content')

    <div class="main-content-wrapper">
        
        @livewire('main-nav')

        <div class="scroll-detector"></div>

        @livewire('tables.volunteer-registration-table')

    </div>

@endsection
