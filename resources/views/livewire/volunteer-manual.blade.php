@extends('layouts.app')

@section('title')
    <title>Volunteer Manual</title>
@endsection

@section('css')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.9.359/pdf.min.js"></script>
    <link rel="stylesheet" href="css/volunteers.css">
@endsection

@section('content')

    @livewire('side-nav')

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Volunteer Manual
                        </h1>
                        <a href="{{ asset('uploads/NYVP-Operational-Guidelines.pdf') }}" download>
                            <button class="btn-submit">Download Manual</button>
                        </a>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/dashboard" wire:navigate>Home</a></li>
                            <li class="breadcrumb-item active">Volunteer Manual</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="viewer">
            <div id="pdf-viewer"></div>
        </div>
    </div>

@endsection

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const pdfViewer = document.getElementById('pdf-viewer');
        const pdfUrl = 'uploads/NYVP-Operational-Guidelines.pdf';

        pdfjsLib.getDocument(pdfUrl)
            .promise.then(pdf => {
                for (let pageNum = 1; pageNum <= pdf.numPages; pageNum++) {
                    pdf.getPage(pageNum).then(page => {
                        const canvas = document.createElement('canvas');
                        const context = canvas.getContext('2d');
                        const viewport = page.getViewport({ scale: 1.5 });
                        canvas.height = viewport.height;
                        canvas.width = viewport.width;
                        pdfViewer.appendChild(canvas);

                        page.render({
                            canvasContext: context,
                            viewport: viewport
                        });
                    });
                }
            })
            .catch(error => {
                console.error('Error loading PDF:', error);
            });
    });
</script>
@endsection