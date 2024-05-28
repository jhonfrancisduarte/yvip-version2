@extends('layouts.app')

@section('title')
    <title>My Profile</title>
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="css/profile.css">
@endsection

@section('content')

    <div class="main-content-wrapper">

        @livewire('main-nav')

        <div class="scroll-detector"></div>

        @livewire('admin.admin-profile-table')

    </div>

@endsection