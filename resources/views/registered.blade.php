@extends ('layouts.layout')

@section ('title')
    <title>NYC - YVIP</title>
@endsection

@section ('css')
    <link href="css/main.css" rel="stylesheet">
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
                        <a href="/" wire:navigate><button class="login-button" type="submit">Sign In</button></a>
                </div>
            </div>
    </div>

@endsection

