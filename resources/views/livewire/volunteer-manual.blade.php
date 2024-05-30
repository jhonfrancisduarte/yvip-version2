@extends('layouts.app')

@section('title')
    <title>Volunteer Manual</title>
@endsection

@section('css')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.9.359/pdf.min.js"></script>
    <link rel="stylesheet" href="css/volunteers.css">
@endsection

@section('content')

    <div class="main-content-wrapper">

        @livewire('main-nav')

        <div class="scroll-detector"></div>
        
        <div class="viewer">
            <a href="{{ asset('uploads/NYVP-Operational-Guidelines.pdf') }}" download>
                <button class="btn-submit" style="margin-left: 20px;">Download Manual</button>
            </a>
            
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