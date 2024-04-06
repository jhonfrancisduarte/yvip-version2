@extends ('layout')

@section ('title')
    <title>NYC - YVIP</title>
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
            <p class="reg-button"><a href="/registration" wire:navigate >Register</a></p>
        </div>

        <div class="welcome-header">
            <img src="images/nyc-logo.png" width="130"/>
            <div class="title-container">
                <h4>The NYC</h4>
                <h1>YVIP</h1>
                <h3>Youth Volunteers & International Programs Beneficiaries Hub</h3>
            </div>
        </div>
        <div class="login-container">.
            
            <div class="login-overlay"></div>
            @livewire('login')
        </div>
        
    </div>

@endsection

@section ('js')
    
@endsection
