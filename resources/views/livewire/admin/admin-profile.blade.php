@extends('layouts.app')

@section('title')
    <title>My Profile</title>
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="css/profile.css">
    <link rel="stylesheet" href="css/announcement.css">
@endsection

@section('content')

    @livewire('admin-side-nav')

    <div class="content-wrapper">

        @livewire('admin.admin-profile-table')

    </div>

@endsection

