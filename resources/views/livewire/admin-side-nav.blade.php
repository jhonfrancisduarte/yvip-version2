
<div class="side-nav">
    <div class="overlay-on-mobile"></div>

    <div class="sidebar-mobile">

        <span class="close-side-nav-btn" aria-hidden="true">&times;</span>

        <nav class="mt-2" >

            <div class="acc-section2">
                <div class="image">
                    @if(session('user_role') == 'yv' || session('user_role') == 'yip')
                        <a href="{{ route('profile') }}"><img src="{{ Auth::user()->userData->profile_picture }}" class="img-circle elevation-2" alt="User Image" style="width: 35px; height: 35px;"></a>
                    @else
                        <a href="{{ route('admin-profile') }}"><img src="{{ Auth::user()->admin->profile_picture }}" class="img-circle elevation-2" alt="User Image" style="width: 35px; height: 35px;"></a>
                    @endif
                </div>

                <div class="info">
                    @if(session('user_role') == 'yv' || session('user_role') == 'yip')
                        <a href="{{ route('profile') }}" class="d-block">{{ Auth::user()->userData->first_name }} {{ Auth::user()->userData->middle_name }} {{ Auth::user()->userData->last_name }}</a>
                    @else
                        <a href="{{ route('admin-profile') }}" class="d-block">{{ Auth::user()->admin->first_name }} {{ Auth::user()->admin->middle_name }} {{ Auth::user()->admin->last_name }}</a>
                    @endif
                </div>
            </div>

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
                                @if($volunteerRegs !== 0 || $volunteerJoinRequests !== 0 || $claimRequests !== 0 || $unassignedParticipantsCount !== 0)
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
                                    @if($volunteerJoinRequests !== 0 || $unassignedParticipantsCount !== 0)
                                        <span class="badge bg-primary2">{{ $volunteerJoinRequests + $unassignedParticipantsCount }}</span>
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
                            </li>
                            
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

    <div class="sidebar-desktop">
        <div class="floating-nav-container">
            <div style="position: relative">
                <div class="curve"></div>
                <div class="curve2"></div>
                <div class="floating-nav" id="floating-nav">
        
                    @if(Auth::user()->user_role == 'sa')
                        <div class="nav-item home-nav-item {{ request()->routeIs('admin-dashboard') ? 'active' : '' }}">
                            <a href="{{ route('admin-dashboard') }}" class="nav-link a" >
                                <i class="nav-icon bi bi-house"></i>
                                <span class="link-hover">Home</span>
                            </a>
                        </div>
                    @endif
        
                    @if(session('user_role') == 'sa' || session('user_role') == 'vs' || session('user_role') == 'vsa')
                        <div class="nav-item yv-group-nav
                            {{ request()->routeIs('volunteer-announcements') ||
                            request()->routeIs('volunteer-registration') ||
                            request()->routeIs('volunteers') ||
                            request()->routeIs('volunteer-hours') ||
                            request()->routeIs('volunteer-rewards') ||
                            request()->routeIs('volunteer-events-and-trainings') ||
                            request()->routeIs('skills-and-categories')
                            ? 'outlined' : '' }}
                        ">
                            <a href="#" class="nav-link a" >
                                <i class="nav-icon bi bi-people"></i><span> Youth Volunteer</span>
                            </a>
                            <div class="sub-menu">
                                <div class="nav-item {{ request()->routeIs('volunteer-announcements') ? 'active' : '' }}">
                                    <a href="{{ route('volunteer-announcements') }}" class="nav-link" >
                                    <i class="nav-icon bi bi-speedometer2"></i>
                                    <span>
                                        Volunteer Announcements
                                    </span>
                                    </a>
                                </div>
        
                                <div class="nav-item {{ request()->routeIs('volunteer-registration') ? 'active' : '' }}">
                                    <a href="{{ route('volunteer-registration') }}" class="nav-link" >
                                    <i class="nav-icon bi bi-person-check"></i>
                                    <span>
                                        Volunteer Registration
                                        {{-- @if($volunteerRegs !== 0)
                                            <span class="badge bg-primary2">{{ $volunteerRegs }}</span>
                                        @endif --}}
                                    </span>
                                    </a>
                                </div>
        
                                <div class="nav-item {{ request()->routeIs('volunteers') ? 'active' : '' }}">
                                <a href="{{ route('volunteers') }}" class="nav-link" >
                                    <i class="nav-icon bi bi-people"></i>
                                    <span>
                                        Youth Volunteers
                                    </span>
                                    </a>
                                </div>
        
                                <div class="nav-item {{ request()->routeIs('volunteer-hours') ? 'active' : '' }}">
                                <a href="{{ route('volunteer-hours') }}" class="nav-link" >
                                    <i class="nav-icon bi bi-clock"></i>
                                    <span>
                                        Volunteer Hours
                                    </span>
                                    </a>
                                </div>
        
                                <div class="nav-item {{ request()->routeIs('volunteer-rewards') ? 'active' : '' }}">
                                    <a href="{{ route('volunteer-rewards') }}" class="nav-link" >
                                    <i class="nav-icon bi bi-award"></i>
                                    <span>
                                        Volunteer Rewards
                                        {{-- @if($claimRequests !== 0)
                                            <span class="badge bg-primary2">{{ $claimRequests }}</span>
                                        @endif --}}
                                    </span>
                                    </a>
                                </div>
        
                                <div class="nav-item {{ request()->routeIs('volunteer-events-and-trainings') ? 'active' : '' }}">
                                    <a href="{{ route('volunteer-events-and-trainings') }}" class="nav-link" >
                                    <i class="nav-icon bi bi-card-list"></i>
                                    <span>
                                        Events and Trainings
                                        {{-- @if($volunteerJoinRequests !== 0 || $unassignedParticipantsCount !== 0)
                                            <span class="badge bg-primary2">{{ $volunteerJoinRequests + $unassignedParticipantsCount }}</span>
                                        @endif --}}
                                    </span>
                                    </a>
                                </div>
        
                                <div class="nav-item {{ request()->routeIs('skills-and-categories') ? 'active' : '' }}">
                                    <a href="{{ route('skills-and-categories') }}" class="nav-link" >
                                    <i class="nav-icon bi bi-tags"></i>
                                    <span>
                                        Skills and Category
                                    </span>
                                    </a>
                                </div>
                                
                                <div class="nav-item">
                                    <a href="/my-messages" class="nav-link" target="_blank">
                                    <i class="nav-icon bi bi-chat-dots"></i>
                                    <span>
                                        Volunteer Messages
                                    </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
        
                    @if(session('user_role') == 'sa' || session('user_role') == 'ips')
                        <div class="nav-item ip-group-nav
                            {{ request()->routeIs('ip-announcements') ||
                            request()->routeIs('ip-registration') ||
                            request()->routeIs('ip-beneficiaries') ||
                            request()->routeIs('past-ip-participated-events') ||
                            request()->routeIs('ip-events') ||
                            request()->routeIs('post-program-obligations')
                            ? 'outlined' : '' }}
                        ">
                            <a href="#" class="nav-link a" >
                                <i class="nav-icon bi bi-globe"></i><span> International Program</span>
                            </a>
                            <div class="sub-menu">
                                <div class="nav-item {{ request()->routeIs('ip-announcements') ? 'active' : '' }}">
                                    <a href="{{ route('ip-announcements') }}" class="nav-link" >
                                    <i class="nav-icon bi bi-speedometer2"></i>
                                    <span>
                                        IP Announcements
                                    </span>
                                    </a>
                                </div>
        
                                <div class="nav-item {{ request()->routeIs('ip-registration') ? 'active' : '' }}">
                                    <a href="{{ route('ip-registration') }}" class="nav-link" >
                                    <i class="nav-icon bi bi-person-check"></i>
                                    <span>
                                        IP Registration
                                        {{-- @if($ipRegs !== 0)
                                            <span class="badge bg-primary2">{{ $ipRegs }}</span>
                                        @endif --}}
                                    </span>
                                    </a>
                                </div>
        
                                <div class="nav-item {{ request()->routeIs('ip-beneficiaries') ? 'active' : '' }}">
                                    <a href="{{ route('ip-beneficiaries') }}" class="nav-link" >
                                    <i class="nav-icon bi bi-people"></i>
                                    <span>
                                        IP Beneficiaries
                                    </span>
                                    </a>
                                </div>
        
                                <div class="nav-item {{ request()->routeIs('past-ip-participated-events') ? 'active' : '' }}">
                                    <a href="{{ route('past-ip-participated-events') }}" class="nav-link" >
                                    <i class="nav-icon bi bi-clipboard-check"></i>
                                    <span>
                                        IP Validation
                                        {{-- @if($confirmedEventsCount !== 0)
                                            <span class="badge bg-primary2">{{ $confirmedEventsCount }}</span>
                                        @endif --}}
                                    </span>
                                    </a>
                                </div>
        
                                <div class="nav-item {{ request()->routeIs('ip-events') ? 'active' : '' }}">
                                    <a href="{{ route('ip-events') }}" class="nav-link" >
                                    <i class="nav-icon bi bi-card-list"></i>
                                    <span>
                                        IP Events
                                        {{-- @if($joinRequests !== 0)
                                            <span class="badge bg-primary2">{{ $joinRequests }}</span>
                                        @endif --}}
                                    </span>
                                    </a>
                                </div>
        
                                <div class="nav-item {{ request()->routeIs('post-program-obligations') ? 'active' : '' }}">
                                    <a href="{{ route('post-program-obligations') }}" class="nav-link" >
                                    <i class="nav-icon bi bi-card-list"></i>
                                    <span>
                                        Post-Program Obligations
                                    </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="open-top-nav"></div>
                </div>
            </div>
        </div>
    </div>
</div>
