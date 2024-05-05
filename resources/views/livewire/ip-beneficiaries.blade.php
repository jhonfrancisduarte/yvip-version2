@extends('layouts.app')

@section('title')
    <title>IP Beneficiaries</title>
@endsection

@section('css')
    <link rel="stylesheet" href="css/profile.css">
    <link rel="stylesheet" type="text/css" href="css/volunteers.css">
    <link rel="stylesheet" type="text/css" href="css/ipbs.css">
    <link rel="stylesheet" type="text/css" href="css/announcement.css">
@endsection

@section('content')

    @livewire('admin-side-nav')

    <div class="content-wrapper content-wrapper2">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">IP Beneficiaries</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/dashboard" wire:navigate>Home</a></li>
                            <li class="breadcrumb-item active">IP Beneficiaries</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        @livewire('ipbs-table')

    </div>

@endsection

@section('js')
    <script>
        var table = document.getElementById('volunteers-table');
        var isHovering = false;

        table.addEventListener('mouseenter', function() {
            isHovering = true;
        });

        table.addEventListener('mouseleave', function() {
            isHovering = false;
        });

        document.getElementById('scroll-table').addEventListener('wheel', function(event) {
            if (isHovering) {
                event.preventDefault();
                this.scrollLeft += event.deltaY;
            }
        });
    </script>
@endsection