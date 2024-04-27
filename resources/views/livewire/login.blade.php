<div class="login-form-container">
        <h2 class="title">Sign in to your account</h2>
        <form wire:submit.prevent="login">
            <div class="row row-space login-input-div">
                <div class="col-1">
                    <div class="input-group">
                        <input class="input--style-4" type="text" id="email" name="email" required wire:model="email" placeholder="Email">
                        @error('email')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row row-space login-input-div">
                <div class="col-1">
                    <div class="input-group input-group-login">
                        <input class="input--style-4" type="{{ $showPassword ? 'text' : 'password' }}" id="password" name="password" required wire:model="password" placeholder="Password">
                        <span class="toggle-password" wire:click="togglePasswordVisibility">
                            <i class="fa {{ $showPassword ? 'fa-eye-slash' : 'fa-eye' }}"></i>
                        </span>
                    </div>
                    @error('password')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="row row-space login-input-div2">
                <div class="col-2">
                    <div class="input-group">
                        <div class="remember-me">
                            <input type="checkbox" name="remember" id="remember" wire:model="remember">
                            <p>Remember Me</p>
                        </div>
                    </div>
                </div>
                <div class="col-2 col-forget">
                    <div class="input-group">
                        <p class="forget"><a href="{{ route('password.request')}}">Forgot Password?</a></p>
                    </div>
                </div>
            </div>

            <div class="p-t-15">
                <button class="login-button" type="submit">Sign In</button>
            </div>

            @if ($errors->has('login'))
                <span style="color: red;">Invalid credentials.</span>
            @elseif ($errors->has('status'))
                <span style="color: red;">Your account has not been approved yet!</span>
            @endif
 
            <p class="p"><a href="/registration" wire:navigate>I don't have an account yet!</a></p>
        </form>
</div>