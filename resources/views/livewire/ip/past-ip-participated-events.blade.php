@extends('layouts.app')

@section('title')
    <title>Past IP Events</title>
@endsection

@section('css')

@endsection

@section('content')

@if(session('user_role') !== 'yv' && session('user_role') !== 'yip')
    @livewire('admin-side-nav')
@else
    @livewire('side-nav')
@endif
    <div class="content-wrapper content-wrapper2">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">My Past Participated IP Events</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/admin-dashboard" wire:navigate>Home</a></li>
                            <li class="breadcrumb-item active">My Past Participated IP Events</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        @if(session('user_role') !== 'yv' && session('user_role') !== 'yip')
        @livewire('tables.admin-ip-validation')
        @else
        @livewire('tables.past-ip-participated-events-table')
        @endif

    </div>


@endsection

