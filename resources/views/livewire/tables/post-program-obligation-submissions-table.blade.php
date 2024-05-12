<div>

    <div class="pop-up-message" @if($popup_message)style="position: fixed; top: 100px !important;"@endif>
        <button type="button" class="close" wire:click="closePopup">
            <span aria-hidden="true">&times;</span>
        </button>
        <p>{{ $popup_message }}</p>
    </div>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card" style="border-radius: 20px; overflow: hidden;">

                    <div class="card-header">
                            <h3 class="card-title">Post-Program Obligation File Submissions</h3>
                    </div>

                    <div class="card-header card-header1">
                        <div class="search-bar">
                            <input type="search" class="form-control" wire:model.live="search" placeholder="Search event...">
                        </div>

                        @if(session('user_role') == 'sa' || session('user_role') == 'ips')
                            <div class="divider"></div>

                            <div class="col-md-2">
                                <div class="input-group-radio">
                                    <div class="radio">
                                        <input type="radio" value="start" checked="checked" wire:model.live="filterBy" name="date">
                                        <label>Start date</label>
                                    </div>
                                    <div class="radio">
                                        <input type="radio" value="end" wire:model.live="filterBy" name="date">
                                        <label>End date</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-2 date-pick">
                                <div class="input-group">
                                    <input class="form-control" type="date" wire:model.live="selectedDate" max="{{ now()->format('Y-m') }}">
                                    <div class="reset-date">
                                        <i class="bi bi-arrow-clockwise" wire:click='resetDateFilter'></i>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="card-body scroll-table" id="scroll-table">
                        @foreach($ipEvents as $ipEvent)
                            <div class="bordered">
                                <div class="fitter">
                                    <table class="table-main">
                                        @if($ipEvent->status === "Completed")
                                            <thead>
                                                <tr>
                                                    <th class="th-border-rad">
                                                        <span style="font-size: 11px; font-weight: 400;">Name of Exchange Program/Event</span><br>
                                                        {{ $ipEvent->event_name }}
                                                    </th>
                                                    <th>
                                                        <span style="font-size: 11px; font-weight: 400;">Organizer / Sponsor</span><br>
                                                        {{ $ipEvent->organizer_sponsor }}
                                                    </th>
                                                    <th>
                                                        <span style="font-size: 11px; font-weight: 400;">Date / Period</span><br>
                                                        {{ $ipEvent->start }} - {{ $ipEvent->end }}
                                                    </th>
                                                    <th class="th-action-btn">
                                                        <span style="font-size: 11px; font-weight: 400;">Status</span><br>
                                                        {{ $ipEvent->status }}
                                                    </th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <table class="table-main">
                                                    <tbody>
                                                        <tr style="background: #eeeeee;">
                                                            <td width="15%">
                                                                <button class="btn-submit" wire:click="exportParticipantsList({{ $ipEvent->id }})" wire:loading.attr='disabled'>
                                                                    <span><i class="bi bi-filetype-pdf"></i> Export List</span>
                                                                    <div wire:loading wire:target="exportParticipantsList" class="loading-container">
                                                                        <div class="loading-spinner"></div>
                                                                    </div>
                                                                </button>
                                                            </td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td width="30%"></td>
                                                        </tr>
                                                    </tbody>
                                                    <tbody>
                                                        <tr style="background: #eeeeee;">
                                                            <td>Fullname</td>
                                                            <td>Post-Program Evaluation Report</td>
                                                            <td>Policy Brief</td>
                                                            <td>Group Terminal Report</td>
                                                            <td>Volunteer Work</td>
                                                            <td>Advocacy Plan</td>
                                                            <td width="15%">Files Link</td>
                                                        </tr>
                                                    </tbody>
                                                    <tbody>
                                                        @if(!empty($ipEvent->participantsData))
                                                            @foreach ($ipEvent->participantsData as $event)
                                                                <tr>
                                                                    <td>{{ $event['name'] }}</td>
                                                                    <td>
                                                                        @if($event['post_program_eval_report'])
                                                                            <div class="file-container fit-container">
                                                                                <span>{{ pathinfo(asset($event['post_program_eval_report']), PATHINFO_FILENAME) }}.{{ pathinfo(asset($event['post_program_eval_report']), PATHINFO_EXTENSION) }}</span>
                                                                                <div class="anns-buttons absolute-top-right">
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
                                                                    </td>
                                                                    <td>
                                                                        @if($event['policy_brief'])
                                                                            <div class="file-container fit-container">
                                                                                <span>{{ pathinfo(asset($event['policy_brief']), PATHINFO_FILENAME) }}.{{ pathinfo(asset($event['policy_brief']), PATHINFO_EXTENSION) }}</span>
                                                                                <div class="anns-buttons absolute-top-right">
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
                                                                    </td>
                                                                    <td>
                                                                        @if($event['group_terminal_report'])
                                                                            <div class="file-container fit-container">
                                                                                <span>{{ pathinfo(asset($event['group_terminal_report']), PATHINFO_FILENAME) }}.{{ pathinfo(asset($event['group_terminal_report']), PATHINFO_EXTENSION) }}</span>
                                                                                <div class="anns-buttons absolute-top-right">
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
                                                                    </td>
                                                                    <td>
                                                                        @if($event['volunteer_work'])
                                                                            <div class="file-container fit-container">
                                                                                <span>{{ pathinfo(asset($event['volunteer_work']), PATHINFO_FILENAME) }}.{{ pathinfo(asset($event['volunteer_work']), PATHINFO_EXTENSION) }}</span>
                                                                                <div class="anns-buttons absolute-top-right">
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
                                                                    </td>
                                                                    <td>
                                                                        @if($event['advocacy_plan'])
                                                                            <div class="file-container fit-container">
                                                                                <span>{{ pathinfo(asset($event['advocacy_plan']), PATHINFO_FILENAME) }}.{{ pathinfo(asset($event['advocacy_plan']), PATHINFO_EXTENSION) }}</span>
                                                                                <div class="anns-buttons absolute-top-right">
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
                                                                    </td>
                                                                    <td>
                                                                        @if($event['files_link'])
                                                                            <a href="{{ $event['files_link'] }}" target="_blank"><p class="p-break">{{ $event['files_link'] }}</p></a>
                                                                        @else
                                                                            <span style="color: #ccc;">none</span>
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </tbody>

                                            <tbody>
                                                <div  class="t-foot"></div>
                                            </tbody>
                                        @endif
                                    </table>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="m-3">
                        {{ $ipEvents->links('livewire::bootstrap') }}
                    </div>

                </div>
                <div class="mt-5"></div>
            </div>
        </div>
    </div>

</div>
