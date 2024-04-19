@extends('layouts.app')

@section('title')
    <title>Skills and Categories</title>
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="css/announcement.css">
    <link rel="stylesheet" type="text/css" href="css/volunteers.css">
    <link rel="stylesheet" type="text/css" href="css/volunteerregistration.css">
@endsection

@section('content')

    @livewire('admin-side-nav')

    <div class="content-wrapper content-wrapper2">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Skills and Categories</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/admin-dashboard" wire:navigate>Home</a></li>
                            <li class="breadcrumb-item active">Skills and Categories</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        @livewire('tables.skills-and-categories-table')
        
    </div>

@endsection

@section('js')

@endsection