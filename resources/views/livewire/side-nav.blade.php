
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="" class="brand-link">
            <img src="images/nyc-logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">YIMS</span>
        </a>

            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                    <img src="../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                    <a href="#" class="d-block">Example User</a>
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
                        <a href="" class="nav-link">
                        <i class="nav-icon fas fa-clock"></i>
                        <p>
                            My Volunteering Hours
                        </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="" class="nav-link">
                        <i class="nav-icon fas fa-award"></i>
                        <p>
                            My Rewards
                        </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="" class="nav-link">
                        <i class="nav-icon fas fa-passport"></i>
                        <p>
                            My Virtual Passport
                        </p>
                        </a>

                    <li class="nav-item">
                        <a href="" class="nav-link">
                        <i class="nav-icon fas fa-book-open"></i>
                        <p>
                            Volunteer Manual
                        </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="" class="nav-link">
                        <i class="nav-icon fas fa-trophy"></i>
                        <p>
                            Leaderboard
                        </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="" class="nav-link">
                        <i class="nav-icon fas fa-envelope"></i>
                        <p>
                            My Messages
                        </p>
                        </a>
                    </li>
                
                    <li class="nav-item">
                        <a href="" class="nav-link">
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