@extends('layouts.app')

@section('title')
    <title>Rewards</title>
@endsection

@section('css')
    <link rel="stylesheet" href="/css/rewards.css">
@endsection

@section('content')

    <div class="main-content-wrapper">

        @livewire('main-nav')

        <div class="scroll-detector"></div>

        <livewire:volunteer-rewards />
        
    </div>

@endsection

