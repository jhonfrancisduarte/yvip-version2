@extends('layouts.app')

@section('title')
    <title>Past IP Events</title>
@endsection

@section('content')

    <div class="main-content-wrapper">

        @livewire('main-nav')

        <div class="scroll-detector"></div>

        @if(session('user_role') !== 'yv' && session('user_role') !== 'yip')
            @livewire('tables.admin-ip-validation')
        @else
            @livewire('tables.past-ip-participated-events-table')
        @endif

    </div>

@endsection

