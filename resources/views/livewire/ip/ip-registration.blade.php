@extends('layouts.app')

@section('title')
    <title>IP Registration</title>
@endsection

@section('css')
    <link rel="stylesheet" href="css/ipbs.css">
@endsection

@section('content')

    <div class="main-content-wrapper">
            
        @livewire('main-nav')

        <div class="scroll-detector"></div>

        @livewire('tables.ip-registration-table')
        
    </div>

@endsection
