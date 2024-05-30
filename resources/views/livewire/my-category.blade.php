@extends('layouts.app')

@section('title')
    <title>Dashboard</title>
@endsection

@section('css')
    <link rel="stylesheet" href="css/category.css">
@endsection

@section('content')

    <div class="main-content-wrapper">

        @livewire('main-nav')

        <div class="scroll-detector"></div>

        <livewire:category-form />
      
    </div>

@endsection

