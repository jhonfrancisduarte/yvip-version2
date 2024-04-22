@extends('layouts.app')

@section('title')
    <title>My Virtual Passport</title>
@endsection

@section('css')
<link rel="stylesheet" href="css/passport.css">
@endsection

@section('content')
    @livewire('side-nav')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">My Virtual Passport</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/dashboard" wire:navigate>Home</a></li>
                            <li class="breadcrumb-item active">My Virtual Passport</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        @livewire('tables.virtual-passport-table')
    </div>
@endsection
