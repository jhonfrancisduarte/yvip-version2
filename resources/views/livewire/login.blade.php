<div class="card card-4 login-form-container">
    <div class="card-body">
        <p class="close-button">✖</p>
        <h2 class="title">Sign in to your account</h2>

        <form wire:submit.prevent="login">
            @csrf
            <div class="row row-space login-input-div">
                <div class="col-1">
                    <div class="input-group">
                        <label class="label" for="email">Email
                            @error('email')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </label>
                        <input class="input--style-4" type="text" id="email" name="email" required wire:model="email">
                    </div>
                </div>
            </div>
            <div class="row row-space login-input-div">
                <div class="col-1">
                    <div class="input-group">
                        <label class="label" for="password">Password
                            @error('password')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </label>
                        <input class="input--style-4" type="password" id="password" name="password" required wire:model="password">
                    </div>
                </div>
            </div>
            <div class="p-t-15">
                <button class="btn btn--radius-2 btn--blue login-button" type="submit">Sign In</button>
            </div>

            @if ($errors->has('email'))
                <span style="color: red;">Invalid credentials.</span>
            @endif

            <div class="to-register-button">
                <b><a href="/registration" style="color:#2c6ed5" wire:navigate>I don't have an account yet!</a></b>
            </div>
        </form>
    </div>
</div>