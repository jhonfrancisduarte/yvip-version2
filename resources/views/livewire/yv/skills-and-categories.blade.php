@extends('layouts.app')

@section('title')
    <title>Skills and Categories</title>
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="css/skills-and-categories.css">
@endsection

@section('content')

    <div class="main-content-wrapper">

        @livewire('main-nav')

        <div class="scroll-detector"></div>

        @livewire('tables.skills-and-categories-table')
        
    </div>

@endsection