@extends('layouts.app')

@section('title')
    <title>Volunteers Events and Trainings Dashboard</title>
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/announcement.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/volunteers.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/events-and-trainings.css') }}">
@endsection

@section('content')

    @if(session('user_role') !== "yv" && session('user_role') !== "yip")
        @livewire('admin-side-nav')
    @else
        @livewire('side-nav')
    @endif'

    <div class="content-wrapper content-wrapper2">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Volunteer Events and Trainings</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" wire:navigate>Home</a></li>
                            <li class="breadcrumb-item active">Volunteer Events and Trainings</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        @livewire('volunteer-events-and-trainings-table')
        
    </div>

@endsection