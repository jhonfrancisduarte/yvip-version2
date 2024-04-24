@extends ('layouts.layout')

@section ('title')
    <title>NYC - YVIP</title>
@endsection

@section ('css')
    <link href="{{ asset('css/welcome.css') }}" rel="stylesheet">
@endsection


@section ('main-content')

    <div class="main-container">
            <div class="registered-page-hero">
                <div class="reg-message">
                        <div class="logo">
                            <img src="images/yvip_logo.png" width="60"/>
                        </div>
                        <h3>Thank you for registering!</h3>
                        <p>Your account has been created successfully. <br>
                            Please wait for the approval of your account by the administrator.
                            <br><br>
                            We will notify you through your email.
                        </p>

                        <p class="reg-button"><a href="/" wire:navigate >Login</a></p>
                </div>
            </div>
    </div>

@endsection
