<div class="main-contents">

    <div class="pop-up-message" @if($popup_message)style="transform: scale(1) !important"@endif>
        <button type="button" class="close" wire:click="closePopup">
            <span>&times;</span>
        </button>
        <p>{{ $popup_message }}</p>
    </div>


    <div class="table-wrapper">
        <div class="table-container">

            <div class="table-header bordered-bottom">
                <h3 class="table-title">Post-Program Obligation File Submissions</h3> 
            </div>

            <div class="table-header justify-left">
                <div class="col-md-4">
                    <input type="search" class="panel-input-1 w" wire:model.live="search" placeholder="Search event...">
                </div>
                <div class="v-spacer"></div>
                @if(session('user_role') == 'sa' || session('user_role') == 'ips') 
                    <div class="date-filter margin-top-mobile">   
                        <div class="col-md-4">
                            <div class="input-group-radio">
                                <div class="radio">
                                    <input type="radio" value="start" checked="checked" wire:model.live="filterBy" name="date">
                                    <span>Start date</span>
                                </div>
                                <div class="radio">
                                    <input type="radio" value="end" wire:model.live="filterBy" name="date">
                                    <span>End date</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6" style="margin-top: -3px; padding-right: 0; width: 230px">
                            <div class="input-group">
                                <input class="panel-input-1 w shadowed-left" type="date" wire:model.live="selectedDate" max="{{ now()->format('Y-m') }}">
                                <div class="reset-date on-desktop">
                                    <i class="bi bi-arrow-clockwise" wire:click='resetDateFilter'></i>
                                </div>
                            </div>
                        </div>
                        <div class="reset-date on-mobile">
                            <i class="bi bi-arrow-clockwise" wire:click='resetDateFilter'></i>
                        </div>
                    </div>  
                @endif
                
            </div>


            <div class="table-table" id="table-table">
                <div class="table">
                    @foreach($ipEvents as $ipEvent)
                        <div class="table-tr-3">
                            <div class="table-overlay"></div>
                            <div class="tr" style="z-index: 1">
                                @if($ipEvent->status === "Completed")

                                    <div class="event-details">
                                        <div>
                                            <span style="font-size: 11px; font-weight: 400;">Event Name</span><br>
                                            <b>{{ $ipEvent->event_name }}</b>
                                        </div>
                                        <div>
                                            <span style="font-size: 11px; font-weight: 400;">Organizer / Sponsor</span><br>
                                            <b>{{ $ipEvent->organizer_sponsor }}</b>
                                        </div>
                                        <div>
                                            <span style="font-size: 11px; font-weight: 400;">Date / Period</span><br>
                                            <b>{{ $ipEvent->start }} - {{ $ipEvent->end }}</b>
                                        </div>
                                        <div>
                                            <span style="font-size: 11px; font-weight: 400;">Status</span><br>
                                            <b>{{ $ipEvent->status }}</b>
                                        </div>
                                        <div class="export-btn">
                                            <button class="table-button" wire:click="exportParticipantsList({{ $ipEvent->id }})" wire:loading.attr='disabled'>
                                                <span><i class="bi bi-filetype-pdf"></i> Export List</span>
                                                <div wire:loading wire:target="exportParticipantsList" class="loading-container" style="margin-left: 5px">
                                                    <div class="loading-spinner"></div>
                                                </div>
                                            </button>
                                        </div>
                                    </div>

                                    {{-- <div class="body-header">
                                        <div class="col-md-4">
                                            <input type="search" class="panel-input-1 w" wire:model.live="search" placeholder="Search name...">
                                        </div>
                                    </div> --}}

                                    <div class="ppo-body">
                 
                                        <div class="submissions">

                                            <div class="scroll-list">
                                                @if(!empty($ipEvent->participantsData))
                                                    @foreach ($ipEvent->participantsData as $event)
                                                        <div class="user-box">

                                                            <div class="name"><b>{{ $event['name'] }}</b></div>

                                                            <div class="file m-top-on-mobile">
                                                                <span class="file-for">Post-Program Eval Report: </span>
                                                                @if($event['post_program_eval_report'])
                                                                    <div class="file-container">
                                                                        <span>{{ pathinfo(asset($event['post_program_eval_report']), PATHINFO_FILENAME) }}.{{ pathinfo(asset($event['post_program_eval_report']), PATHINFO_EXTENSION) }}</span>
                                                                        <div class="file-buttons">
                                                                            <a href="{{ asset($event['post_program_eval_report']) }}" download>
                                                                                <i class="bi bi-file-earmark-arrow-down"></i>
                                                                            </a>
                                                                            <div class="mx-2"></div>
                                                                            @if(pathinfo(asset($event['post_program_eval_report']), PATHINFO_EXTENSION) === 'pdf' ||
                                                                                pathinfo(asset($event['post_program_eval_report']), PATHINFO_EXTENSION) === 'docx' ||
                                                                                pathinfo(asset($event['post_program_eval_report']), PATHINFO_EXTENSION) === 'txt' ||
                                                                                pathinfo(asset($event['post_program_eval_report']), PATHINFO_EXTENSION) === 'csv')
                                                                                <a href="#" onclick="window.open('{{ asset($event['post_program_eval_report']) }}', '_blank')"><i class="bi bi-eye"></i></a>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                @else
                                                                    <span style="color: #ccc;">none</span>
                                                                @endif
                                                            </div>

                                                            <div class="file">
                                                                <span class="file-for">Policy Brief: </span>
                                                                @if($event['policy_brief'])
                                                                    <div class="file-container">
                                                                        <span>{{ pathinfo(asset($event['policy_brief']), PATHINFO_FILENAME) }}.{{ pathinfo(asset($event['policy_brief']), PATHINFO_EXTENSION) }}</span>
                                                                        <div class="file-buttons">
                                                                            <a href="{{ asset($event['policy_brief']) }}" download>
                                                                                <i class="bi bi-file-earmark-arrow-down"></i>
                                                                            </a>
                                                                            <div class="mx-2"></div>
                                                                            @if(pathinfo(asset($event['policy_brief']), PATHINFO_EXTENSION) === 'pdf' ||
                                                                                pathinfo(asset($event['policy_brief']), PATHINFO_EXTENSION) === 'docx' ||
                                                                                pathinfo(asset($event['policy_brief']), PATHINFO_EXTENSION) === 'txt' ||
                                                                                pathinfo(asset($event['policy_brief']), PATHINFO_EXTENSION) === 'csv')
                                                                                <a href="#" onclick="window.open('{{ asset($event['policy_brief']) }}', '_blank')"><i class="bi bi-eye"></i></a>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                @else
                                                                    <span style="color: #ccc;">none</span>
                                                                @endif
                                                            </div>

                                                            <div class="file">
                                                                <span class="file-for">Group Terminal Report: </span>
                                                                @if($event['group_terminal_report'])
                                                                    <div class="file-container">
                                                                        <span>{{ pathinfo(asset($event['group_terminal_report']), PATHINFO_FILENAME) }}.{{ pathinfo(asset($event['group_terminal_report']), PATHINFO_EXTENSION) }}</span>
                                                                        <div class="file-buttons">
                                                                            <a href="{{ asset($event['group_terminal_report']) }}" download>
                                                                                <i class="bi bi-file-earmark-arrow-down"></i>
                                                                            </a>
                                                                            <div class="mx-2"></div>
                                                                            @if(pathinfo(asset($event['group_terminal_report']), PATHINFO_EXTENSION) === 'pdf' ||
                                                                                pathinfo(asset($event['group_terminal_report']), PATHINFO_EXTENSION) === 'docx' ||
                                                                                pathinfo(asset($event['group_terminal_report']), PATHINFO_EXTENSION) === 'txt' ||
                                                                                pathinfo(asset($event['group_terminal_report']), PATHINFO_EXTENSION) === 'csv')
                                                                                <a href="#" onclick="window.open('{{ asset($event['group_terminal_report']) }}', '_blank')"><i class="bi bi-eye"></i></a>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                @else
                                                                    <span style="color: #ccc;">none</span>
                                                                @endif
                                                            </div>

                                                            <div class="file">
                                                                <span class="file-for">Volunteer Work: </span>
                                                                @if($event['volunteer_work'])
                                                                    <div class="file-container">
                                                                        <span>{{ pathinfo(asset($event['volunteer_work']), PATHINFO_FILENAME) }}.{{ pathinfo(asset($event['volunteer_work']), PATHINFO_EXTENSION) }}</span>
                                                                        <div class="file-buttons">
                                                                            <a href="{{ asset($event['volunteer_work']) }}" download>
                                                                                <i class="bi bi-file-earmark-arrow-down"></i>
                                                                            </a>
                                                                            <div class="mx-2"></div>
                                                                            @if(pathinfo(asset($event['volunteer_work']), PATHINFO_EXTENSION) === 'pdf' ||
                                                                                pathinfo(asset($event['volunteer_work']), PATHINFO_EXTENSION) === 'docx' ||
                                                                                pathinfo(asset($event['volunteer_work']), PATHINFO_EXTENSION) === 'txt' ||
                                                                                pathinfo(asset($event['volunteer_work']), PATHINFO_EXTENSION) === 'csv')
                                                                                <a href="#" onclick="window.open('{{ asset($event['volunteer_work']) }}', '_blank')"><i class="bi bi-eye"></i></a>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                @else
                                                                    <span style="color: #ccc;">none</span>
                                                                @endif
                                                            </div>

                                                            <div class="file">
                                                                <span class="file-for">Advocacy Plan: </span>
                                                                @if($event['advocacy_plan'])
                                                                    <div class="file-container">
                                                                        <span>{{ pathinfo(asset($event['advocacy_plan']), PATHINFO_FILENAME) }}.{{ pathinfo(asset($event['advocacy_plan']), PATHINFO_EXTENSION) }}</span>
                                                                        <div class="file-buttons">
                                                                            <a href="{{ asset($event['advocacy_plan']) }}" download>
                                                                                <i class="bi bi-file-earmark-arrow-down"></i>
                                                                            </a>
                                                                            <div class="mx-2"></div>
                                                                            @if(pathinfo(asset($event['advocacy_plan']), PATHINFO_EXTENSION) === 'pdf' ||
                                                                                pathinfo(asset($event['advocacy_plan']), PATHINFO_EXTENSION) === 'docx' ||
                                                                                pathinfo(asset($event['advocacy_plan']), PATHINFO_EXTENSION) === 'txt' ||
                                                                                pathinfo(asset($event['advocacy_plan']), PATHINFO_EXTENSION) === 'csv')
                                                                                <a href="#" onclick="window.open('{{ asset($event['advocacy_plan']) }}', '_blank')"><i class="bi bi-eye"></i></a>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                @else
                                                                    <span style="color: #ccc;">none</span>
                                                                @endif
                                                            </div>

                                                            <div class="file">
                                                                <span class="file-for">Files' Link: </span>
                                                                @if($event['files_link'])
                                                                    <a href="{{ $event['files_link'] }}" target="_blank"><p class="p-break">{{ $event['files_link'] }}</p></a>
                                                                @else
                                                                    <span style="color: #ccc;">none</span>
                                                                @endif
                                                            </div>

                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                               
                                    </div>

                                    <tbody>
                                        <div  class="t-foot"></div>
                                    </tbody>

                                @endif 
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="m-3">
                {{ $ipEvents->links('livewire::bootstrap') }}
            </div>

        </div>
        <div class="mt-5"></div>
    </div>

</div>
