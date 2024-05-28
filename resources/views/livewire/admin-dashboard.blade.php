@extends('layouts.app')

@section('title')
    <title>Admin Dashboard</title>
@endsection

@section('content')

    <div class="main-content-wrapper">

        @livewire('main-nav')

        <div class="scroll-detector"></div>

        @livewire('tables.admin-table')
        
    </div>

@endsection