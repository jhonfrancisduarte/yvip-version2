<aside class="main-sidebar elevation-4">
        <a href="#" class="brand-link">
            <img src="images/yvip_logo.png" alt="yvip logo" class="brand-image brand-image1">
            <span class="brand-text font-weight-bold">THE NYC - YVIP
                <img src="/images/nyc_logo.png" alt="nyc logo" width="40" style="margin-top: -5px">
            </span>
        </a>

        <div class="sidebar">
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                        <li class="nav-item">
                            <a href="{{ route('dashboard') }}"  class="nav-link  {{ request()->routeIs('dashboard') ? 'active' : '' }}" >
                            <i class="nav-icon bi bi-house"></i>
                            <p>
                                Home
                            </p>
                            </a>
                        </li>

                    @if(Auth::user()->user_role == 'yv' || Auth::user()->user_role == 'yip')
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
                                    <a href="{{ route('my-category') }}" class="nav-link {{ request()->routeIs('my-category') ? 'active' : '' }}">
                                    <i class="nav-icon bi bi-tags"></i>
                                    <p>
                                        My Category
                                    </p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                <a href="{{ route('events-and-trainings-list') }}" class="nav-link {{ request()->routeIs('events-and-trainings-list') ? 'active' : '' }}">
                                    <i class="nav-icon bi bi-card-list"></i>
                                    <p>
                                        Events and Trainings List
                                    </p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                <a href="{{ route('participated-yv-events') }}" class="nav-link {{ request()->routeIs('participated-yv-events') ? 'active' : '' }}">
                                    <i class="nav-icon bi bi-card-checklist"></i>
                                    <p>
                                        Participated YV Events
                                    </p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('volunteering-hours') }}" class="nav-link {{ request()->routeIs('volunteering-hours') ? 'active' : '' }}">
                                        <i class="nav-icon bi bi-clock"></i>
                                    <p>
                                        My Volunteering Hours
                                    </p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('rewards') }}" class="nav-link {{ request()->routeIs('rewards') ? 'active' : '' }}">
                                    <i class="nav-icon bi bi-award"></i>
                                    <p>
                                        My Rewards
                                    </p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('leaderboard') }}" class="nav-link {{ request()->routeIs('leaderboard') ? 'active' : '' }}">
                                    <i class="nav-icon bi bi-trophy"></i>
                                    <p>
                                        Leaderboard
                                    </p>
                                    </a>
                                </li>

                                @if($volunteerHours === 100 && Auth::user()->user_role == 'yv')
                                    <li class="nav-item">
                                        <a href="{{ route('ip-application') }}" class="nav-link {{ request()->routeIs('ip-application') ? 'active' : '' }}">
                                        <i class="nav-icon bi bi-globe"></i>
                                        <p>
                                            IP Application
                                        </p>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endif

                    @if(Auth::user()->user_role == 'yip')
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
                                    <a href="{{ route('ip-events-list') }}" class="nav-link {{ request()->routeIs('ip-events-list') ? 'active' : '' }}">
                                    <i class="nav-icon bi bi-card-list"></i>
                                    <p>
                                        IP Events List
                                    </p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('ip-participated-events') }}" class="nav-link {{ request()->routeIs('ip-participated-events') ? 'active' : '' }}">
                                    <i class="nav-icon bi bi-card-checklist"></i>
                                    <p>
                                        Participated IP Events
                                    </p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('past-ip-participated-events') }}" class="nav-link {{ request()->routeIs('past-ip-participated-events') ? 'active' : '' }}">
                                    <i class="nav-icon bi bi-clipboard-plus"></i>
                                    <p>
                                    Past Participated IP Events
                                    </p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('post-program-obligation') }}" class="nav-link {{ request()->routeIs('post-program-obligation') ? 'active' : '' }}">
                                    <i class="nav-icon bi bi-clipboard-check"></i>
                                    <p>
                                        Post-Program Obligation
                                    </p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif

                    @if(Auth::user()->user_role == 'yv' || Auth::user()->user_role == 'yip')
                        <li class="nav-item">
                            <a href="{{ route('virtual-passport') }}" class="nav-link {{ request()->routeIs('virtual-passport') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-passport"></i>
                            <p>
                                My Virtual Passport
                            </p>
                            </a>

                        <li class="nav-item">
                            <a href="{{ route('volunteer-manual') }}" class="nav-link {{ request()->routeIs('volunteer-manual') ? 'active' : '' }}">
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
