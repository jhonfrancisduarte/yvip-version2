<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/forgotpassword.css">

    <title>Reset Password</title>
</head>
<body>
    <div class="container font-poppins">
        <div class="card card-4">
        <div class="reg-logo-container">
                <img src="/images/yvip_logo.png" width="100"/>
            </div>
            <div class="col-md-8 border-container">
                <div class="card">
                <center><h2 class="title reg-title">RESET PASSWORD</h2></center>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <div class="input-group">
                                <label for="email" class="label">{{ __('Email Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="input--style-4" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn--radius-2 btn--blue">
                                        {{ __('Send Password Reset Link') }}
                                    </button>
                                </div>
                            </div>

                            <div class="to-login-button">
                                    <b><a href="/" style="color:#2c6ed5">Back to login</a></b>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>