@extends('layouts.app')

@section('title')
    <title>Volunteers</title>
@endsection

@section('content')

    <div class="main-content-wrapper">

        @livewire('main-nav')

        <div class="scroll-detector"></div>

        @livewire('volunteers-table')
        
    </div>

@endsection
