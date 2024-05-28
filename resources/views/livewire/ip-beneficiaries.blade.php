@extends('layouts.app')

@section('title')
    <title>IP Beneficiaries</title>
@endsection

@section('css')
    <link rel="stylesheet" href="css/ipbs.css">
@endsection

@section('content')

    <div class="main-content-wrapper">

        @livewire('main-nav')

        <div class="scroll-detector"></div>

        @livewire('ipbs-table')

    </div>

@endsection