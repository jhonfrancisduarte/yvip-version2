<div>

    <div class="announcement-container">
        <div class="announcement-head">
            <p>What's new</p>
        </div>
    </div>

    @foreach($announcements as $announcement)
        <div class="announcement-container" style="padding: 0 10px 0 10px">
            <div class="announcement-box">

                <div class="author">
                    <img src="{{ $announcement->profile_picture }}">
                    <div class="author-info">
                        <h4>{{ $announcement->first_name }} {{ $announcement->last_name }}</h4>
                        <p>{{ $announcement->formatted_created_at }} <i class="bi bi-clock"></i> • {{ $announcement->category }} <i class="bi bi-bookmark"></i></p>
                    </div>
                </div>

                <div class="content">
                    <h3>{{ $announcement->title }}</h3>
                    @if(strlen($announcement->content) > 300)
                        @if($contentIndexes[$announcement->id])
                            <p>{{ $announcement->content }}</p>
                            <a href="#" wire:click.prevent="toggleContent({{ $announcement->id }})" style="color: blue">
                                See less
                            </a>
                        @else
                            <p>{{ substr($announcement->content, 0, 300) }}...</p>
                            <a href="#" wire:click.prevent="toggleContent({{ $announcement->id }})" style="color: blue">
                                See more
                            </a>
                        @endif
                    @else
                        <p>{{ $announcement->content }}</p>
                    @endif
                </div>

                @if($announcement->featured_image)
                    <div class="featured-image" style="background-image: url({{ $announcement->featured_image }})">
                    </div>
                @endif
            </div>
        </div>
    @endforeach
    
    <div class="load-more">
        @if ($announcements->count() >= 10 && $announcements->count() < $totalAnnouncements)
            <a wire:click="load" class="login-button">Load More</a>
        @elseif ($announcements->count() == $totalAnnouncements)
            <p>End of content</p>
        @endif
    </div>

    <div class="footer">
        <div class="contact-info">
            <div class="link-title">
                <h4>Contact Us</h4>
            </div>
            <div class="contacts">
                <p>Email: <span>info@nyc.gov.ph</span></p>
                <p>Address: <span>3F West Insula Bldg. 135 West Avenue Cor. EDSA, Quezon City</span></p>
                <p>Telephone No.: <span>(02) 8426-8479, 371-4603</span></p>
            </div>
        </div>
        <div class="social-links">
            <div class="link-title">
                <h4>Follow Us Online</h4>
            </div>
            <div class="links-1">
                <a href="https://www.facebook.com/nationalyouthcommission" target="_blank"><i class="bi bi-facebook"></i></a>
                <a href="https://www.instagram.com/nycpilipinas/" target="_blank"><i class="bi bi-instagram"></i></a>
                <a href="https://twitter.com/NYCPilipinas" target="_blank"><i class="bi bi-twitter"></i></a>
            </div>
            <div class="links-2">
                <a href="https://www.youtube.com/@nycpilipinas5290" target="_blank"><i class="bi bi-youtube"></i></a>
                <a href="https://www.tiktok.com/@nycpilipinas" target="_blank"><i class="bi bi-tiktok"></i></a>
            </div>
        </div>
    </div>

</div>