@extends('layouts.app')

@section('title')
    <title>IP Announcements</title>
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="css/announcement.css">
@endsection

@section('content')

    <div class="main-content-wrapper">

        @livewire('main-nav')

        <div class="scroll-detector"></div>

        <livewire:announcement-table :dashboardType="'ip'" />
        
    </div>

@endsection