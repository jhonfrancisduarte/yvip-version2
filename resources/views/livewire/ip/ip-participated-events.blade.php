@extends('layouts.app')

@section('title')
    <title>My Participated IP Events</title>
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="css/announcement.css">
    <link rel="stylesheet" type="text/css" href="css/volunteers.css">
    <link rel="stylesheet" type="text/css" href="css/volunteerregistration.css">
    <link rel="stylesheet" type="text/css" href="css/ip-events.css">
@endsection

@section('content')

    @livewire('side-nav')

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">My Participated IP Events</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/dashboard" wire:navigate>Home</a></li>
                            <li class="breadcrumb-item active">My Participated IP Events</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        @livewire('tables.ip-events-table')

    </div>

@endsection

