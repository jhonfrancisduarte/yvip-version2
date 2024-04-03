<div class="card card-4 login-form-container">
            <div class="card-body">
                <p class="close-button">✖</p>
                <h2 class="title">Sign in to your account</h2>
                <form method="POST" wire:submit.prevent="login" action="{{ route('login') }}">
                    @csrf
                    <div class="row row-space login-input-div">
                        <div class="col-1">
                            <div class="input-group">
                                <label class="label" for="email">Email</label>
                                <input class="input--style-4" type="text" id="email" name="email" wire:model="email">
                            </div>
                            <div class="col-1">
                                @error('email')
                                    <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row row-space login-input-div">
                        <div class="col-1">
                            <div class="input-group">
                                <label class="label" for="password">Password</label>
                                <input class="input--style-4" type="password" id="password" name="password" wire:model="password">
                            </div>
                            <div class="col-1">
                                @error('password')
                                    <span style="color: red;">{{ $message }}</span>
                                @enderror
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