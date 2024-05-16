@extends ('layouts.layout')

@section ('title')
    <title>NYC - YVIP</title>
@endsection

@section ('css')
    <link href="css/welcome.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/announcement.css">
    <link rel="stylesheet" type="text/css" href="css/volunteers.css">
@endsection


@section ('main-content')

    <div class="main-container">

            <div class="landing-content">
                <div class="landing-page-hero">
                    <div class="welcome-header">
                        <div class="top-nav">
                            <div class="top-buttons">
                                <a href="/sign-in" class="sign-in margin-right">Sign In</a>
                                <a href="/registration" target="_blank">Register</a>
                            </div>
                            <div class="nyc">
                                <img src="images/nyc-logo_orig.png" width="70"/>
                                <p>National Youth Commission</p>
                            </div>
                        </div>

                        <div class="title-container">
                            <div class="mobile-logos">
                                <img class="m-logo" src="images/yvip_logo.png"/>
                            </div>
                            <div class="desktop-logos">
                                <img class="logo" src="images/yvip_logo.png"/>
                            </div>
                            <div class="yvip">
                                <img src="images/maskhead.png" alt="" width="220">
                                <h3>Youth Volunteers & <br>International Programs Beneficiaries Hub</h3>
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

