@extends('layouts.app')

@section('title')
    <title>Rewards</title>
@endsection

@section('css')
    <link rel="stylesheet" href="/css/rewards.css">
    <link rel="stylesheet" href="/css/announcement.css">
@endsection

@section('content')

    @if(session('user_role') !== 'yv' && session('user_role') !== 'yip')
        @livewire('admin-side-nav')
    @else
        @livewire('side-nav')
    @endif

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        @if(session('user_role') !== 'yv' && session('user_role') !== 'yip')
                            <h1 class="m-0">Volunteer Rewards</h1>
                        @else
                            <h1 class="m-0">My Rewards</h1>
                        @endif
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/dashboard" wire:navigate>Home</a></li>
                            <li class="breadcrumb-item active">Rewards</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="container-fluid">
                <livewire:volunteer-rewards />
            </div>
        </div>
    </div>

@endsection

