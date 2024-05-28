<div class="top-nav">

    <div class="top-nav-bg"></div>

    <div class="top-nav-wrapper">

        <div class="navbar-nav-on-mobile">
            <div class="menu-bar">
                <a href="#" style="color: black"><i class="fas fa-bars"></i></a>
            </div>
        </div>

        <div class="app-name">
            <a href="{{ route('admin-dashboard') }}" class="app" >
                <img class="nyc-logo" src="/images/nyc_logo.png" alt="nyc logo" width="46" style="margin-right: 7px">
                <img class="yvip-logo" src="/images/yvip_logo.png" alt="yvip logo" width="38" style="margin-right: 7px">
                <h5><span class="t-1">THE NYC</span> - <span class="t-2">Y</span><span class="t-3">V</span><span class="t-4">I</span><span class="t-5">P</span></h5>
            </a>
        </div>

        <div class="acc-section">
            <div class="image">
                @if(session('user_role') == 'yv' || session('user_role') == 'yip')
                    <a href="{{ route('profile') }}"><img src="{{ Auth::user()->userData->profile_picture }}" class="img-circle elevation-2" alt="User Image" style="width: 35px; height: 35px;"></a>
                @else
                    <a href="{{ route('admin-profile') }}"><img src="{{ Auth::user()->admin->profile_picture }}" class="img-circle elevation-2" alt="User Image" style="width: 35px; height: 35px;"></a>
                @endif
            </div>
            <div class="sub-menu">
                <div class="user-info">
                    @if(session('user_role') == 'yv' || session('user_role') == 'yip')
                        <a href="{{ route('profile') }}" class="d-block">{{ Auth::user()->userData->first_name }} {{ Auth::user()->userData->middle_name }} {{ Auth::user()->userData->last_name }}</a>
                    @else
                        <a href="{{ route('admin-profile') }}" class="d-block">{{ Auth::user()->admin->first_name }} {{ Auth::user()->admin->middle_name }} {{ Auth::user()->admin->last_name }}</a>
                    @endif
                </div>
                <div class="nav-item">
                    <a href="#" class="nav-link" wire:click="logout">
                        <i class="nav-icon bi bi-box-arrow-right"></i>
                        <span class="link-hover">Logout</span>
                    </a>
                </div>
            </div>
        </div>

    </div>

    @if(Auth::user()->user_role !== 'yv' && Auth::user()->user_role !== 'yip')
        <div class="side-nav-container"> 
            @livewire('admin-side-nav')
        </div>
    @else
        <div class="side-nav-container"> 
            @livewire('side-nav')
        </div>
    @endif

</div>
