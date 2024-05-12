<div>

    @foreach($announcements as $announcement)
        <div class="announcement-container">
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

</div>