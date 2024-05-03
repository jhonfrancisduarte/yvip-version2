@extends('layouts.app')

@section('title')
    <title>My Participations</title>
@endsection


@section('content')

    @livewire('side-nav')

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">My Participated Volunteer Events and Trainings</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/dashboard" wire:navigate>Home</a></li>
                            <li class="breadcrumb-item active">My Participations</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @livewire('my-participations')


    @livewire('tables.my-participated-yv-events-table')

@endsection

