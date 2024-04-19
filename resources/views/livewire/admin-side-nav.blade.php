
<aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="#" class="brand-link" wire:navigate>
                <img src="images/yvip_logo_white.png" alt="AdminLTE Logo" class="brand-image brand-image1" style="opacity: .8">
                <span class="brand-text font-weight-bold">THE NYC - YVIP</span>
            </a>

            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
    
                    </div>
                    <div class="info">
                    
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href="{{ route('admin-dashboard') }}" class="nav-link {{ request()->routeIs('admin-dashboard') ? 'active' : '' }}" wire:navigate>
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Welcome Admin
                        </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#" wire:click='create' wire:navigate>
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Register Admin
                        </p>
                        </a>
                    </li>  

                @if(session('user_role') == 'sa' || session('user_role') == 'vs' || session('user_role') == 'vsa')
                    {{-- Volunteer navlinks --}}

                    <li class="nav-item">
                        <a href="{{ route('volunteer-dashboard') }}" class="nav-link {{ request()->routeIs('volunteer-dashboard') ? 'active' : '' }}" wire:navigate>
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Volunteer Dashboard
                        </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('volunteer-registration') }}" class="nav-link {{ request()->routeIs('volunteer-registration') ? 'active' : '' }}" wire:navigate>
                        <i class="nav-icon fas fa-user-check"></i>
                        <p>
                            Volunteer Registration
                        </p>
                        </a>
                    </li>

                    <li class="nav-item">
                    <a href="{{ route('volunteers') }}" class="nav-link {{ request()->routeIs('volunteers') ? 'active' : '' }}" wire:navigate>
                        <i class="nav-icon fas fa-user-friends"></i>
                        <p>
                            Volunteers
                        </p>
                        </a>
                    </li>

                    <li class="nav-item">
                    <a href="{{ route('volunteer-hours') }}" class="nav-link {{ request()->routeIs('volunteer-hours') ? 'active' : '' }}" wire:navigate>
                        <i class="nav-icon fas fa-user-clock"></i>
                        <p>
                            Volunteer Hours
                        </p>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a href="{{ route('volunteer-rewards') }}" class="nav-link {{ request()->routeIs('volunteer-rewards') ? 'active' : '' }}" wire:navigate>
                        <i class="nav-icon fas fa-award"></i>
                        <p>
                            Volunteer Rewards
                        </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('volunteer-events-and-trainings') }}" class="nav-link {{ request()->routeIs('volunteer-events-and-trainings') ? 'active' : '' }}" wire:navigate>
                        <i class="nav-icon fas fa-list"></i>
                        <p>
                            Events and Trainings
                        </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('volunteer-category') }}" class="nav-link {{ request()->routeIs('volunteer-category') ? 'active' : '' }}" wire:navigate>
                        <i class="nav-icon fas fa-passport"></i>
                        <p>
                            Volunteer Category
                        </p>
                        </a>

                    <li class="nav-item">
                        <a href="{{ route('volunteer-messages') }}" class="nav-link {{ request()->routeIs('volunteer-messages') ? 'active' : '' }}" wire:navigate>
                        <i class="nav-icon fas fa-envelope"></i>
                        <p>
                            Volunteer Messages
                        </p>
                        </a>
                    </li>

                @endif

                @if(session('user_role') == 'sa')
                    <hr class="hr">
                @endif

                @if(session('user_role') == 'sa' || session('user_role') == 'ips')
                    {{-- IP navlinks --}}

                    <li class="nav-item">
                        <a href="{{ route('ip-dashboard') }}" class="nav-link {{ request()->routeIs('ip-dashboard') ? 'active' : '' }}" wire:navigate>
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            IP Dashboard
                        </p>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a href="{{ route('ip-registration') }}" class="nav-link {{ request()->routeIs('ip-registration') ? 'active' : '' }}" wire:navigate>
                        <i class="nav-icon fas fa-user-check"></i>
                        <p>
                            IP Registration
                        </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('ip-beneficiaries') }}" class="nav-link {{ request()->routeIs('ip-beneficiaries') ? 'active' : '' }}" wire:navigate>
                        <i class="nav-icon fas fa-user-friends"></i>
                        <p>
                            IP Beneficiaries
                        </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('ip-validation') }}" class="nav-link {{ request()->routeIs('ip-validation') ? 'active' : '' }}" wire:navigate>
                        <i class="nav-icon fas fa-check-circle"></i>
                        <p>
                            IP Validation
                        </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('ip-events') }}" class="nav-link {{ request()->routeIs('ip-events') ? 'active' : '' }}" wire:navigate>
                        <i class="nav-icon fas fa-list"></i>
                        <p>
                            IP Events
                        </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('ip-messages') }}" class="nav-link {{ request()->routeIs('ip-messages') ? 'active' : '' }}" wire:navigate>
                        <i class="nav-icon fas fa-envelope"></i>
                        <p>
                            IP Messages
                        </p>
                        </a>
                    </li>

                @endif

                    <li class="nav-item">
                        <a href="#" class="nav-link" wire:click="logout">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>
                                Logout
                            </p>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>