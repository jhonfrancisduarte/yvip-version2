<aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="#" class="brand-link" wire:navigate>
            <img src="images/yvip_logo.png" alt="yvip logo" class="brand-image brand-image1" style="opacity: .8">
            <span class="brand-text font-weight-bold">THE NYC - YVIP</span>
        </a>

        <div class="sidebar">

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                        <li class="nav-item">
                            <a href="{{ route('dashboard') }}"  wire:navigate class="nav-link  {{ request()->routeIs('dashboard') ? 'active' : '' }}" >
                            <i class="nav-icon bi bi-house"></i>
                            <p>
                                Home
                            </p>
                            </a>
                        </li>

                    @if(session('user_role') == 'yv' || session('user_role') == 'yip')
                        {{-- Youth Volunteer Tabs --}}
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link navs">
                                <i class="nav-icon bi bi-people"></i>
                                <p>
                                    Youth Volunteer
                                    <i class="right bi bi-caret-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('my-category') }}" class="nav-link {{ request()->routeIs('my-category') ? 'active' : '' }}" wire:navigate>
                                    <i class="nav-icon bi bi-tags"></i>
                                    <p>
                                        My Category
                                    </p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                <a href="{{ route('events-and-trainings-list') }}" class="nav-link {{ request()->routeIs('events-and-trainings-list') ? 'active' : '' }}" wire:navigate>
                                    <i class="nav-icon bi bi-card-list"></i>
                                    <p>
                                        Events and Trainings List
                                    </p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                <a href="{{ route('participated-yv-events') }}" class="nav-link {{ request()->routeIs('participated-yv-events') ? 'active' : '' }}" wire:navigate>
                                    <i class="nav-icon bi bi-card-checklist"></i>
                                    <p>
                                        Participated YV Events
                                    </p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('volunteering-hours') }}" class="nav-link {{ request()->routeIs('volunteering-hours') ? 'active' : '' }}" wire:navigate>
                                        <i class="nav-icon bi bi-clock"></i>
                                    <p>
                                        My Volunteering Hours
                                    </p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('rewards') }}" class="nav-link {{ request()->routeIs('rewards') ? 'active' : '' }}" wire:navigate>
                                    <i class="nav-icon bi bi-award"></i>
                                    <p>
                                        My Rewards
                                    </p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('leaderboard') }}" class="nav-link {{ request()->routeIs('leaderboard') ? 'active' : '' }}" wire:navigate>
                                    <i class="nav-icon bi bi-trophy"></i>
                                    <p>
                                        Leaderboard
                                    </p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif

                    @if(session('user_role') == 'yip')
                        {{-- IP Beneficiary Tabs --}}
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-globe"></i>
                                <p>
                                    International Program
                                    <i class="right bi bi-caret-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('ip-events-list') }}" class="nav-link {{ request()->routeIs('ip-events-list') ? 'active' : '' }}" wire:navigate>
                                    <i class="nav-icon bi bi-card-list"></i>
                                    <p>
                                        IP Events List
                                    </p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('ip-participated-events') }}" class="nav-link {{ request()->routeIs('ip-participated-events') ? 'active' : '' }}" wire:navigate>
                                    <i class="nav-icon bi bi-card-checklist"></i>
                                    <p>
                                        Participated IP Events
                                    </p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('past-ip-participated-events') }}" class="nav-link {{ request()->routeIs('past-ip-participated-events') ? 'active' : '' }}" wire:navigate>
                                    <i class="nav-icon bi bi-clipboard-plus"></i>
                                    <p>
                                    Past Participated IP Events
                                    </p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('post-program-obligation') }}" class="nav-link {{ request()->routeIs('post-program-obligation') ? 'active' : '' }}" wire:navigate>
                                    <i class="nav-icon bi bi-clipboard-check"></i>
                                    <p>
                                        Post-Program Obligation
                                    </p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif

                    @if(session('user_role') == 'yv' || session('user_role') == 'yip')
                        <li class="nav-item">
                            <a href="{{ route('virtual-passport') }}" class="nav-link {{ request()->routeIs('virtual-passport') ? 'active' : '' }}" wire:navigate>
                            <i class="nav-icon bi bi-passport"></i>
                            <p>
                                My Virtual Passport
                            </p>
                            </a>

                        <li class="nav-item">
                            <a href="{{ route('volunteer-manual') }}" class="nav-link {{ request()->routeIs('volunteer-manual') ? 'active' : '' }}" wire:navigate>
                            <i class="nav-icon bi bi-journal-text"></i>
                            <p>
                                Volunteer Manual
                            </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="/my-messages" class="nav-link" target="_blank">
                            <i class="nav-icon bi bi-chat-dots"></i>
                            <p>
                                My Messages
                            </p>
                            </a>
                        </li>
                    @endif

                    <li class="nav-item">
                        <a href="#" class="nav-link" wire:click.prevent="logout">
                            <i class="nav-icon bi bi-box-arrow-right"></i>
                            <p>
                                Logout
                            </p>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
</aside>
