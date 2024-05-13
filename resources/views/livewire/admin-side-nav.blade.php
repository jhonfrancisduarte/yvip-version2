
<aside class="main-sidebar sidebar-dark-primary elevation-4"  wire:poll.30s="counter">
            <a href="#" class="brand-link" >
                <img src="/images/yvip_logo.png" alt="yvip logo" class="brand-image brand-image1">
                <span class="brand-text font-weight-bold">THE NYC - YVIP
                    <img src="/images/nyc_logo.png" alt="nyc logo" width="40" style="margin-top: -5px">
                </span>
            </a>

            <div class="sidebar" style="position: relative; z-index: 2;">

                <!-- Sidebar Menu -->
                <nav class="mt-2" >
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        @if(session('user_role') == 'sa')
                            <li class="nav-item">
                                <a href="{{ route('admin-dashboard') }}" class="nav-link {{ request()->routeIs('admin-dashboard') ? 'active' : '' }}" >
                                <i class="nav-icon bi bi-house"></i>
                                <p>
                                    Home
                                </p>
                                </a>
                            </li>
                        @endif

                    @if(session('user_role') == 'sa' || session('user_role') == 'vs' || session('user_role') == 'vsa')
                        {{-- Volunteer navlinks --}}

                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link navs">
                                <i class="nav-icon bi bi-people"></i>
                                <p>
                                    Youth Volunteer
                                    @if($volunteerRegs !== 0 || $volunteerJoinRequests !== 0 || $claimRequests !== 0)
                                        <span style="color: red; font-size:30px; position: absolute; top: -5px;">•</span>
                                    @endif
                                    <i class="right bi bi-caret-left pos-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('volunteer-announcements') }}" class="nav-link {{ request()->routeIs('volunteer-announcements') ? 'active' : '' }}" >
                                    <i class="nav-icon bi bi-speedometer2"></i>
                                    <p>
                                        Volunteer Announcements
                                    </p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('volunteer-registration') }}" class="nav-link {{ request()->routeIs('volunteer-registration') ? 'active' : '' }}" >
                                    <i class="nav-icon bi bi-person-check"></i>
                                    <p>
                                        Volunteer Registration
                                        @if($volunteerRegs !== 0)
                                            <span class="badge bg-primary2">{{ $volunteerRegs }}</span>
                                        @endif
                                    </p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                <a href="{{ route('volunteers') }}" class="nav-link {{ request()->routeIs('volunteers') ? 'active' : '' }}" >
                                    <i class="nav-icon bi bi-people"></i>
                                    <p>
                                        Youth Volunteers
                                    </p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                <a href="{{ route('volunteer-hours') }}" class="nav-link {{ request()->routeIs('volunteer-hours') ? 'active' : '' }}" >
                                    <i class="nav-icon bi bi-clock"></i>
                                    <p>
                                        Volunteer Hours
                                    </p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('volunteer-rewards') }}" class="nav-link {{ request()->routeIs('volunteer-rewards') ? 'active' : '' }}" >
                                    <i class="nav-icon bi bi-award"></i>
                                    <p>
                                        Volunteer Rewards
                                        @if($claimRequests !== 0)
                                            <span class="badge bg-primary2">{{ $claimRequests }}</span>
                                        @endif
                                    </p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('volunteer-events-and-trainings') }}" class="nav-link {{ request()->routeIs('volunteer-events-and-trainings') ? 'active' : '' }}" >
                                    <i class="nav-icon bi bi-card-list"></i>
                                    <p>
                                        Events and Trainings
                                        @if($volunteerJoinRequests !== 0)
                                            <span class="badge bg-primary2">{{ $volunteerJoinRequests }}</span>
                                        @endif
                                    </p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('skills-and-categories') }}" class="nav-link {{ request()->routeIs('skills-and-categories') ? 'active' : '' }}" >
                                    <i class="nav-icon bi bi-tags"></i>
                                    <p>
                                        Skills and Category
                                    </p>
                                    </a>

                                <li class="nav-item">
                                    <a href="/my-messages" class="nav-link" target="_blank">
                                    <i class="nav-icon bi bi-chat-dots"></i>
                                    <p>
                                        Volunteer Messages
                                    </p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif

                    @if(session('user_role') == 'sa' || session('user_role') == 'ips')
                        {{-- IP navlinks --}}
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-globe"></i>
                                <p>
                                    International Program
                                    @if($confirmedEventsCount !== 0 || $ipRegs !== 0 || $joinRequests !== 0)
                                        <span style="color: red; font-size:30px; position: absolute; top: -5px;">•</span>
                                    @endif
                                    <i class="right bi bi-caret-left pos-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('ip-announcements') }}" class="nav-link {{ request()->routeIs('ip-announcements') ? 'active' : '' }}" >
                                    <i class="nav-icon bi bi-speedometer2"></i>
                                    <p>
                                        IP Announcements
                                    </p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('ip-registration') }}" class="nav-link {{ request()->routeIs('ip-registration') ? 'active' : '' }}" >
                                    <i class="nav-icon bi bi-person-check"></i>
                                    <p>
                                        IP Registration
                                        @if($ipRegs !== 0)
                                            <span class="badge bg-primary2">{{ $ipRegs }}</span>
                                        @endif
                                    </p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('ip-beneficiaries') }}" class="nav-link {{ request()->routeIs('ip-beneficiaries') ? 'active' : '' }}" >
                                    <i class="nav-icon bi bi-people"></i>
                                    <p>
                                        IP Beneficiaries
                                    </p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('past-ip-participated-events') }}" class="nav-link {{ request()->routeIs('past-ip-participated-events') ? 'active' : '' }}" >
                                    <i class="nav-icon bi bi-clipboard-check"></i>
                                    <p>
                                        IP Validation
                                        @if($confirmedEventsCount !== 0)
                                            <span class="badge bg-primary2">{{ $confirmedEventsCount }}</span>
                                        @endif
                                    </p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('ip-events') }}" class="nav-link {{ request()->routeIs('ip-events') ? 'active' : '' }}" >
                                    <i class="nav-icon bi bi-card-list"></i>
                                    <p>
                                        IP Events
                                        @if($joinRequests !== 0)
                                            <span class="badge bg-primary2">{{ $joinRequests }}</span>
                                        @endif
                                    </p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('post-program-obligations') }}" class="nav-link {{ request()->routeIs('post-program-obligations') ? 'active' : '' }}" >
                                    <i class="nav-icon bi bi-card-list"></i>
                                    <p>
                                        Post-Program Obligations
                                    </p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                    @endif

                        <li class="nav-item">
                            <a href="#" class="nav-link" wire:click="logout">
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

@livewireScripts
