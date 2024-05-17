@extends ('layouts.layout')

@section ('title')
    <title>NYC - YVIP</title>
@endsection

@section ('css')
    <link href="css/welcome.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/announcement.css">
    <link rel="stylesheet" type="text/css" href="css/volunteers.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
@endsection


@section ('main-content')

    <div class="main-container">

        <div class="scroll-detector"></div>
            <div class="landing-content">
                <div class="landing-page-hero"> 
                    <div class="welcome-header">

                        <div class="top-nav" id="topNavBar">
                            <div class="top-buttons">
                                <a href="/sign-in" class="sign-in margin-right">Sign In</a>
                                <a href="/registration">Register</a>
                            </div>
                            <div class="onscroll-logos">
                                <img src="images/nyc-logo_orig.png" width="50"/>
                                <img src="images/yvip_logo.png" width="45"/>
                                <span class="brand-text">THE NYC - </span>
                                <span class="y">Y</span>
                                <span class="v">V</span>
                                <span class="i">I</span>
                                <span class="p">P</span>
                            </div>
                        </div>

                        <div class="title-container">
                            <div class="mobile-logos">
                                <img class="m-logo" src="images/yvip_logo.png"/>
                                <img class="m-logo" src="images/nyc-logo_orig.png"/>
                            </div>
                            <div class="desktop-logos logos-1">
                                <img class="logo" src="images/yvip_logo.png"/>
                            </div>
                            <div class="yvip logos-3">
                                <img src="images/maskhead.png" alt="" width="220">
                                <h3>Youth Volunteers & <br>International Programs Beneficiaries Hub</h3>
                            </div>
                            <div class="desktop-logos logos-2">
                                <a href="https://nyc.gov.ph/" target="_blank">
                                    <img class="logo" src="images/nyc-logo_orig.png"/>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
    
                <div class="landing-page-content">
                    <livewire:main-announcement />
                </div>
            </div>

    </div>

@endsection

@section('js')
<script>
    if (window.innerWidth >= 1024) {
        let isOffScreen = false;
        const topNavBar = document.getElementById('topNavBar');
        const scrollDetector = document.querySelector('.scroll-detector');

        const observer = new IntersectionObserver(
            ([entry]) => {
                isOffScreen = !entry.isIntersecting;
                topNavBar.classList.toggle('active', isOffScreen);
            },
            { threshold: 0.1 }
        );

        if (scrollDetector) {
            observer.observe(scrollDetector);
        }

        window.addEventListener('beforeunload', function () {
            if (scrollDetector) {
                observer.unobserve(scrollDetector);
            }
        });
        
        document.addEventListener('DOMContentLoaded', function() {
            const logo1 = document.querySelector('.logos-1');
            const logo2 = document.querySelector('.logos-2');
            const logo3 = document.querySelector('.logos-3');
        
            logo1.classList.add('animate');
        
            logo2.classList.add('animate');
        
            logo3.classList.add('animate');
        });
    }
</script>
@endsection
