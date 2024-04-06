
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="" class="brand-link">
            <img src="images/nyc-logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">YVIP</span>
        </a>

            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                    <img src="{{ asset(auth()->user()->profile_picture) }}" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                    <a href="{{ route('profile') }}" class="d-block" wire:navigate>{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" wire:navigate>
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                        </a>
                    </li>
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
                        <a href="{{ route('leaderboard') }}" class="nav-link {{ request()->routeIs('leaderboard') ? 'active' : '' }}" wire:navigate>
                        <i class="nav-icon fas fa-trophy"></i>
                        <p>
                            Leaderboard
                        </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('messages') }}" class="nav-link {{ request()->routeIs('messages') ? 'active' : '' }}" wire:navigate>
                        <i class="nav-icon fas fa-envelope"></i>
                        <p>
                            My Messages
                        </p>
                        </a>
                    </li>
                
                    <li class="nav-item">
                        <a href="" class="nav-link" wire:click="logout">
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