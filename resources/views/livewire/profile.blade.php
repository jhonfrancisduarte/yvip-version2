@extends('layouts.app')

@section('title')
    <title>My Profile</title>
@endsection

@section('css')
    <link rel="stylesheet" href="css/profile.css">
    <link rel="stylesheet" href="css/announcement.css">
@endsection

@section('content')

    @livewire('side-nav')

    <div class="content-wrapper">

        @livewire('tables.my-profile')
        
    </div>

@endsection

@section('js')

@endsection

