
<section class="content announcement-content">
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
                                    <a href="#" wire:click.prevent="toggleContent({{ $announcement->id }})">
                                        See less
                                    </a>
                                @else
                                    <p>{{ substr($announcement->content, 0, 300) }}...</p>
                                    <a href="#" wire:click.prevent="toggleContent({{ $announcement->id }})">
                                        See more
                                    </a>
                                @endif
                            @else
                                <p>{{ $announcement->content }}</p>
                            @endif
                        </div>

                        @if($announcement->attached_file)
                            <div class="attached-file">
                                <p>Attached File: <span>{{ pathinfo(asset($announcement->attached_file), PATHINFO_FILENAME) }}.{{ pathinfo(asset($announcement->attached_file), PATHINFO_EXTENSION) }}</span> <i class="nav-icon fas fa-file"></i></p>
                                
                                <div class="anns-buttons">
                                    <a href="{{ asset($announcement->attached_file) }}" download>
                                        <i class="bi bi-file-earmark-arrow-down"></i> Download
                                    </a>
                                    
                                    <!-- Preview button (for image files) -->
                                    @if(pathinfo(asset($announcement->attached_file), PATHINFO_EXTENSION) === 'pdf' ||
                                        pathinfo(asset($announcement->attached_file), PATHINFO_EXTENSION) === 'docx' ||
                                        pathinfo(asset($announcement->attached_file), PATHINFO_EXTENSION) === 'txt' ||
                                        pathinfo(asset($announcement->attached_file), PATHINFO_EXTENSION) === 'csv')
                                        <a href="#" onclick="window.open('{{ asset($announcement->attached_file) }}', '_blank')"><i class="bi bi-eye"></i> Preview</a>
                                    @endif
                                </div>
                            </div>
                        @endif

                        @if($announcement->featured_image)
                            <div class="featured-image" style="background-image: url({{ $announcement->featured_image }})">
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach

        </div>

</section>