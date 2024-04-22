
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="#" class="brand-link" wire:navigate>
            <img src="images/yvip_logo_white.png" alt="AdminLTE Logo" class="brand-image brand-image1" style="opacity: .8">
            <span class="brand-text font-weight-bold">THE NYC - YVIP</span>
        </a>

            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset(auth()->user()->userData->profile_picture) }}" class="img-circle elevation-2" alt="User Image" style="width: 35px; height: 35px;">
                    </div>
                    <div class="info">
                    <a href="{{ route('profile') }}" class="d-block" wire:navigate>{{ auth()->user()->userData->first_name }} {{ auth()->user()->userData->last_name }}</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                
                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" wire:navigate>
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Home
                        </p>
                        </a>
                    </li>

                @if(session('user_role') == 'yv' || session('user_role') == 'yip')
                    {{-- Youth Volunteer Tabs --}}

                    <li class="nav-item">
                        <a href="{{ route('my-category') }}" class="nav-link {{ request()->routeIs('my-category') ? 'active' : '' }}" wire:navigate>
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            My Category
                        </p>
                        </a>
                    </li>

                    <li class="nav-item">
                    <a href="{{ route('events-and-trainings') }}" class="nav-link {{ request()->routeIs('events-and-trainings') ? 'active' : '' }}" wire:navigate>
                        <i class="nav-icon fas fa-list"></i>
                        <p>
                            Events and Trainings List
                        </p>
                        </a>
                    </li>

                    <li class="nav-item">
                    <a href="{{ route('my-participations') }}" class="nav-link {{ request()->routeIs('my-participations') ? 'active' : '' }}" wire:navigate>
                        <i class="nav-icon fas fa-handshake"></i>
                        <p>
                            My Participations
                        </p>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a href="{{ route('volunteering-hours') }}" class="nav-link {{ request()->routeIs('volunteering-hours') ? 'active' : '' }}" wire:navigate>
                        <i class="nav-icon fas fa-clock"></i>
                        <p>
                            My Volunteering Hours
                        </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('rewards') }}" class="nav-link {{ request()->routeIs('rewards') ? 'active' : '' }}" wire:navigate>
                        <i class="nav-icon fas fa-award"></i>
                        <p>
                            My Rewards
                        </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('leaderboard') }}" class="nav-link {{ request()->routeIs('leaderboard') ? 'active' : '' }}" wire:navigate>
                        <i class="nav-icon fas fa-trophy"></i>
                        <p>
                            Leaderboard
                        </p>
                        </a>
                    </li>

                @endif

                @if(session('user_role') == 'yip')
                    {{-- IP Beneficiary Tabs --}}

                    <li class="nav-item">
                        <a href="{{ route('ip-events-list') }}" class="nav-link {{ request()->routeIs('ip-events-list') ? 'active' : '' }}" wire:navigate>
                        <i class="nav-icon fas fa-list"></i>
                        <p>
                            IP Events List
                        </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('ip-participated-events') }}" class="nav-link {{ request()->routeIs('ip-participated-events') ? 'active' : '' }}" wire:navigate>
                        <i class="nav-icon fas fa-handshake"></i>
                        <p>
                            My Participated IP Events
                        </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('past-ip-participated-events') }}" class="nav-link {{ request()->routeIs('past-ip-participated-events') ? 'active' : '' }}" wire:navigate>
                        <i class="nav-icon fas fa-calendar-plus"></i>
                        <p>
                           Past Participated IP Events
                        </p>
                        </a>
                    </li>

                    {{-- <li class="nav-item">
                        <a href="{{ route('ip-passport') }}" class="nav-link {{ request()->routeIs('ip-passport') ? 'active' : '' }}" wire:navigate>
                        <i class="nav-icon fas fa-passport"></i>
                        <p>
                            My IP Passport
                        </p>
                        </a>
                    </li> --}}

                    <li class="nav-item">
                        <a href="{{ route('post-program-obligation') }}" class="nav-link {{ request()->routeIs('post-program-obligation') ? 'active' : '' }}" wire:navigate>
                        <i class="nav-icon fas fa-clipboard-check"></i>
                        <p>
                            Post-Program Obligation
                        </p>
                        </a>
                    </li>

                @endif

                @if(session('user_role') == 'yv' || session('user_role') == 'yip')
                    <li class="nav-item">
                        <a href="{{ route('virtual-passport') }}" class="nav-link {{ request()->routeIs('virtual-passport') ? 'active' : '' }}" wire:navigate>
                        <i class="nav-icon fas fa-passport"></i>
                        <p>
                            My Virtual Passport
                        </p>
                        </a>

                    <li class="nav-item">
                        <a href="{{ route('volunteer-manual') }}" class="nav-link {{ request()->routeIs('volunteer-manual') ? 'active' : '' }}" wire:navigate>
                        <i class="nav-icon fas fa-book-open"></i>
                        <p>
                            Volunteer Manual
                        </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/my-messages" class="nav-link" target="_blank">
                        <i class="nav-icon fas fa-envelope"></i>
                        <p>
                            My Messages
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