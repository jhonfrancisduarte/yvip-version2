@extends('layouts.app')

@section('title')
    <title>Leaderboard</title>
@endsection

@section('css')
    <link rel="stylesheet" href="/css/leaderboard.css">
@endsection

@section('content')

    <div class="main-content-wrapper">

        @livewire('main-nav')

        <div class="scroll-detector"></div>
        
        <livewire:volunteer-leaderboard />

    </div>

@endsection

