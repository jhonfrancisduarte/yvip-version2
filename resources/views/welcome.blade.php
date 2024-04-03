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

        <div class="card card-4 login-form-container">
            <div class="card-body">
                <p class="close-button">✖</p>
                <h2 class="title">Sign in to your account</h2>
                <form method="POST" action="client/dashboard.php">
                    <div class="row row-space login-input-div">
                        <div class="col-1">
                            <div class="input-group">
                                <label class="label">Email</label>
                                <input class="input--style-4" type="text" name="first_name">
                            </div>
                        </div>
                    </div>
                    <div class="row row-space login-input-div">
                        <div class="col-1">
                            <div class="input-group">
                                <label class="label">password</label>
                                <input class="input--style-4" type="password" name="last_name">
                            </div>
                        </div>
                    </div>
                    <div class="p-t-15">
                        <button class="btn btn--radius-2 btn--blue" type="submit">Sign In</button>
                    </div>
                    <div class="to-register-button">
                        <b><a href="/registration" style="color:#2c6ed5">I don't have an account yet!</a></b>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section ('js')
    
@endsection
