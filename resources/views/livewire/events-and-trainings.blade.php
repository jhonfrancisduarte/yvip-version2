@extends('layouts.app')

@section('title')
    <title>Events and Trainings</title>
@endsection


@section('content')

    @livewire('side-nav')

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">My Events and Trainings</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/dashboard" wire:navigate>Home</a></li>
                            <li class="breadcrumb-item active">My Events and Trainings</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

