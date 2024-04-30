
<aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="#" class="brand-link" wire:navigate>
                <img src="/images/yvip_logo.png" alt="AdminLTE Logo" class="brand-image brand-image1" style="opacity: .8">
                <span class="brand-text font-weight-bold">THE NYC - YVIP</span>
            </a>

            <div class="sidebar">

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    @if(session('user_role') == 'sa')
                        <li class="nav-item">
                            <a href="{{ route('admin-dashboard') }}" class="nav-link {{ request()->routeIs('admin-dashboard') ? 'active' : '' }}" wire:navigate>
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
                                <i class="right bi bi-caret-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('volunteer-dashboard') }}" class="nav-link {{ request()->routeIs('volunteer-dashboard') ? 'active' : '' }}" wire:navigate>
                                <i class="nav-icon bi bi-speedometer2"></i>
                                <p>
                                    Volunteer Dashboard
                                </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('volunteer-registration') }}" class="nav-link {{ request()->routeIs('volunteer-registration') ? 'active' : '' }}" wire:navigate>
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
                            <a href="{{ route('volunteers') }}" class="nav-link {{ request()->routeIs('volunteers') ? 'active' : '' }}" wire:navigate>
                                <i class="nav-icon bi bi-people"></i>
                                <p>
                                    Volunteers
                                </p>
                                </a>
                            </li>

                            <li class="nav-item">
                            <a href="{{ route('volunteer-hours') }}" class="nav-link {{ request()->routeIs('volunteer-hours') ? 'active' : '' }}" wire:navigate>
                                <i class="nav-icon bi bi-clock"></i>
                                <p>
                                    Volunteer Hours
                                </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('volunteer-rewards') }}" class="nav-link {{ request()->routeIs('volunteer-rewards') ? 'active' : '' }}" wire:navigate>
                                <i class="nav-icon bi bi-award"></i>
                                <p>
                                    Volunteer Rewards
                                </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('volunteer-events-and-trainings') }}" class="nav-link {{ request()->routeIs('volunteer-events-and-trainings') ? 'active' : '' }}" wire:navigate>
                                <i class="nav-icon bi bi-card-list"></i>
                                <p>
                                    Events and Trainings
                                </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('skills-and-categories') }}" class="nav-link {{ request()->routeIs('skills-and-categories') ? 'active' : '' }}" wire:navigate>
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
                                <i class="right bi bi-caret-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('ip-dashboard') }}" class="nav-link {{ request()->routeIs('ip-dashboard') ? 'active' : '' }}" wire:navigate>
                                <i class="nav-icon bi bi-speedometer2"></i>
                                <p>
                                    IP Dashboard
                                </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('ip-registration') }}" class="nav-link {{ request()->routeIs('ip-registration') ? 'active' : '' }}" wire:navigate>
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
                                <a href="{{ route('ip-beneficiaries') }}" class="nav-link {{ request()->routeIs('ip-beneficiaries') ? 'active' : '' }}" wire:navigate>
                                <i class="nav-icon bi bi-people"></i>
                                <p>
                                    IP Beneficiaries
                                </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('past-ip-participated-events') }}" class="nav-link {{ request()->routeIs('past-ip-participated-events') ? 'active' : '' }}" wire:navigate>
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
                                <a href="{{ route('ip-events') }}" class="nav-link {{ request()->routeIs('ip-events') ? 'active' : '' }}" wire:navigate>
                                <i class="nav-icon bi bi-card-list"></i>
                                <p>
                                    IP Events
                                    @if($joinRequests !== 0)
                                        <span class="badge bg-primary2">{{ $joinRequests }}</span>
                                    @endif
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
