@extends('layouts.app')

@section('title')
    <title>Home</title>
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="css/announcement.css">
    <link rel="stylesheet" type="text/css" href="css/volunteers.css">
@endsection

@section('content')

    @livewire('side-nav')

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"></h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/dashboard" wire:navigate>Home</a></li>
                            <li class="breadcrumb-item active">Announcements</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        @if(session('user_role') === "yip")
            <livewire:announcement-table />
        @elseif(session('user_role') === "yv")
            <livewire:announcement-table :dashboardType="'yv'" />
        @endif

    </div>

@endsection

@section('js')

@endsection