@extends ('layout')

@section ('title')
    <title>NYC - YIMS</title>
@endsection

@section ('css')
    <link href="{{ asset('css/welcome.css') }}" rel="stylesheet">
@endsection


@section ('main-content')

    <div class="main-container">
        <div class="welcome-nav">
            <div class="contact-info">

            </div>
            <p class="sign-in-button">Sign In</p>
            <p class="reg-button"><a href="/registration">Register</a></p>
        </div>

        <div class="welcome-header">
            <img src="images/nyc-logo.png" width="130"/>
            <div class="title-container">
                <h4>Republic of the Philippines</h4>
                <h1>NATIONAL YOUTH COMMISSION</h1>
                <h3>Youth Information Management System</h3>
            </div>
        </div>
        <div class="login-container">
            <div class="login-overlay"></div>
            @livewire('login')
        </div>
        
    </div>

@endsection

@section ('js')
    
@endsection
