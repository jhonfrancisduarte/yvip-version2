<div class="forgot-pass-form" id="forgot-pass-form">
    <h2 class="title">Reset Password</h2>

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="input-group">
            <div class="col-md-6">
                <input id="email" type="email" class="panel-input-1" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="row row-space">
            <div class="col-2">
                <div class="input-group">
                    <button type="submit" class="login-button">
                        Reset Password
                    </button>
                </div>
            </div>
            <div class="col-2">
                <div class="input-group">
                    <p class="forget f-2" id="forget">Sign In</a></p>
                </div>
            </div>
        </div>
    </form>
</div>