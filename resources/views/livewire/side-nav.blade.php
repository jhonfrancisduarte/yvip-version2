<div class="side-nav">
    <div class="overlay-on-mobile"></div>

    <div class="sidebar-mobile">

        <span class="close-side-nav-btn" aria-hidden="true">&times;</span>

        <nav class="mt-2">

            <div class="acc-section2">
                <div class="image">
                    <a href="{{ route('profile') }}"><img src="{{ Auth::user()->userData->profile_picture }}" class="img-circle elevation-2" alt="User Image" style="width: 35px; height: 35px;"></a>
                </div>

                <div class="info">
                    <a href="{{ route('profile') }}" class="d-block">{{ Auth::user()->userData->first_name }} {{ Auth::user()->userData->middle_name }} {{ Auth::user()->userData->last_name }}</a>
                </div>
            </div>

            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                    <li class="nav-item">
                        <a href="{{ route('home') }}"  class="nav-link  {{ request()->routeIs('home') ? 'active' : '' }}" >
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

    <div class="sidebar-desktop">
        <div class="floating-nav-container">
            <div style="position: relative">
                <div class="curve"></div>
                <div class="curve2"></div>
                <div class="floating-nav" id="floating-nav">
        
                    <div class="nav-item home-nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
                        <a href="{{ route('home') }}" class="nav-link a" >
                            <i class="nav-icon bi bi-house"></i>
                        </a>
                    </div>
        
                    @if(Auth::user()->user_role == 'yv' || Auth::user()->user_role == 'yip')
                        <div class="nav-item yv-group-nav
                            {{ request()->routeIs('my-category') ||
                            request()->routeIs('events-and-trainings-list') ||
                            request()->routeIs('participated-yv-events') ||
                            request()->routeIs('volunteering-hours') ||
                            request()->routeIs('rewards') ||
                            request()->routeIs('leaderboard') ||
                            request()->routeIs('ip-application')
                            ? 'outlined' : '' }}
                        ">
                            <a href="#" class="nav-link a" >
                                <i class="nav-icon bi bi-people"></i><span> Youth Volunteer</span>
                            </a>
                            <div class="sub-menu">

                                <div class="nav-item {{ request()->routeIs('my-category') ? 'active' : '' }}">
                                    <a href="{{ route('my-category') }}" class="nav-link" >
                                        <i class="nav-icon bi bi-tags"></i>
                                    <span>
                                        My Category
                                    </span>
                                    </a>
                                </div>
        
                                <div class="nav-item {{ request()->routeIs('events-and-trainings-list') ? 'active' : '' }}">
                                    <a href="{{ route('events-and-trainings-list') }}" class="nav-link" >
                                    <i class="nav-icon bi bi-card-list"></i>
                                    <span>
                                        Events and Trainings List
                                    </span>
                                    </a>
                                </div>

                                <div class="nav-item {{ request()->routeIs('participated-yv-events') ? 'active' : '' }}">
                                    <a href="{{ route('participated-yv-events') }}" class="nav-link" >
                                    <i class="nav-icon bi bi-card-checklist"></i>
                                    <span>
                                        Participated YV Events
                                    </span>
                                    </a>
                                </div>
        
                                <div class="nav-item {{ request()->routeIs('volunteering-hours') ? 'active' : '' }}">
                                    <a href="{{ route('volunteering-hours') }}" class="nav-link" >
                                    <i class="nav-icon bi bi-clock"></i>
                                    <span>
                                        My Volunteering Hours
                                    </span>
                                    </a>
                                </div>
        
                                <div class="nav-item {{ request()->routeIs('rewards') ? 'active' : '' }}">
                                    <a href="{{ route('rewards') }}" class="nav-link" >
                                    <i class="nav-icon bi bi-award"></i>
                                    <span>
                                        My Rewards
                                    </span>
                                    </a>
                                </div>
        
                                <div class="nav-item {{ request()->routeIs('leaderboard') ? 'active' : '' }}">
                                    <a href="{{ route('leaderboard') }}" class="nav-link" >
                                        <i class="nav-icon bi bi-trophy"></i>
                                    <span>
                                        Leaderboard
                                    </span>
                                    </a>
                                </div>

                                <div class="nav-item {{ request()->routeIs('virtual-passport') ? 'active' : '' }}">
                                    <a href="{{ route('virtual-passport') }}" class="nav-link" >
                                        <i class="nav-icon bi bi-passport"></i>
                                    <span>
                                        My Virtual Passport
                                    </span>
                                    </a>
                                </div>

                                <div class="nav-item {{ request()->routeIs('volunteer-manual') ? 'active' : '' }}">
                                    <a href="{{ route('volunteer-manual') }}" class="nav-link" >
                                        <i class="nav-icon bi bi-journal-text"></i>
                                    <span>
                                        Volunteer Manual
                                    </span>
                                    </a>
                                </div>

                                @if($volunteerHours === 100 && Auth::user()->user_role == 'yv')
                                    <div class="nav-item {{ request()->routeIs('ip-application') ? 'active' : '' }}">
                                        <a href="{{ route('ip-application') }}" class="nav-link" >
                                        <i class="nav-icon bi bi-globe"></i>
                                        <span>
                                            IP Application
                                        </span>
                                        </a>
                                    </div>
                                @endif
                                
                            </div>
                        </div>
                    @endif
        
                    @if(Auth::user()->user_role == 'yip')
                        <div class="nav-item ip-group-nav
                            {{ request()->routeIs('ip-events-list') ||
                            request()->routeIs('ip-participated-events') ||
                            request()->routeIs('past-ip-participated-events') ||
                            request()->routeIs('post-program-obligation') 
                            ? 'outlined' : '' }}
                        ">
                            <a href="#" class="nav-link a" >
                                <i class="nav-icon bi bi-globe"></i><span> International Program</span>
                            </a>
                            <div class="sub-menu">
                                <div class="nav-item {{ request()->routeIs('ip-events-list') ? 'active' : '' }}">
                                    <a href="{{ route('ip-events-list') }}" class="nav-link" >
                                    <i class="nav-icon bi bi-card-list"></i>
                                    <span>
                                        IP Events List
                                    </span>
                                    </a>
                                </div>
        
                                <div class="nav-item {{ request()->routeIs('ip-participated-events') ? 'active' : '' }}">
                                    <a href="{{ route('ip-participated-events') }}" class="nav-link" >
                                    <i class="nav-icon bi bi-card-checklist"></i>
                                    <span>
                                        Participated IP Events
                                    </span>
                                    </a>
                                </div>
        
                                <div class="nav-item {{ request()->routeIs('past-ip-participated-events') ? 'active' : '' }}">
                                    <a href="{{ route('past-ip-participated-events') }}" class="nav-link" >
                                    <i class="nav-icon bi bi-clipboard-plus"></i>
                                    <span>
                                        Past Participated IP Events
                                    </span>
                                    </a>
                                </div>
        
                                <div class="nav-item {{ request()->routeIs('post-program-obligation') ? 'active' : '' }}">
                                    <a href="{{ route('post-program-obligation') }}" class="nav-link" >
                                    <i class="nav-icon bi bi-clipboard-check"></i>
                                    <span>
                                        Post-Program Obligation
                                    </span>
                                    </a>
                                </div>
        
                            </div>
                        </div>
                    @endif

                    <div class="nav-item home-nav-item">
                        <a href="/my-messages" class="nav-link" target="_blank" class="nav-link a" >
                            <i class="nav-icon bi bi-chat-dots"></i>
                        </a>
                    </div>
                   
                    <div class="open-top-nav"></div>
                </div>
            </div>
        </div>
    </div>

</div>
