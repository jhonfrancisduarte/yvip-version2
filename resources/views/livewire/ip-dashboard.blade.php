@extends('layouts.app')

@section('title')
    <title>IPs' Dashboard</title>
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="css/announcement.css">
    <link rel="stylesheet" type="text/css" href="css/volunteers.css">
@endsection

@section('content')

    @livewire('admin-side-nav')

    <div class="content-wrapper content-wrapper2">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Volunteers' Dashboard</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/admin-dashboard" wire:navigate>Home</a></li>
                            <li class="breadcrumb-item active">Volunteers' Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <livewire:announcement-table :dashboardType="'ip'" />
        
    </div>

@endsection

@section('js')

@endsection