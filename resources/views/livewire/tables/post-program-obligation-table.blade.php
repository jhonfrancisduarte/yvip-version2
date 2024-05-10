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
                            <h3 class="card-title">International Program Events List</h3>
                    </div>

                    <div class="card-header card-header1">
                        <div class="search-bar">
                            <input type="search" class="form-control" wire:model.live="search" placeholder="Search...">
                        </div>
                    </div>

                    <div class="card-body scroll-table" id="scroll-table">
                        <table id="thisUserDetailss-table" class="table-main">
                            <thead>
                                <tr>
                                    <th class="th-border-rad">Name of Exchange Program/Event</th>
                                    <th>Organizer / Sponsor</th>
                                    <th>Date / Period</th>
                                    <th>Status</th>
                                    <th width="30%" class="th-action-btn">Post-Program Obligation</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($ipEvents as $event)
                                    <tr>
                                        @if($event->approved && $event->status === "Completed")
                                            <td>{{ $event->event_name }}</td>
                                            <td>{{ $event->organizer_sponsor }}</td>
                                            <td>{{ $event->start }} - {{ $event->end }} </td>
                                            <td><span class="blue">{{ $event->status }}</span></td>
                                            <td width="30%">
                                                @php
                                                    $thisEvent = null;
                                                @endphp

                                                @foreach($ppoFiles as $file)
                                                    @if($file->event_id === $event->id)
                                                        @php
                                                            $thisEvent = $file;
                                                        @endphp
                                                    @endif
                                                @endforeach

                                                @if($thisEvent)

                                                    @if(!$thisEvent->files_link)

                                                        @if($thisEvent->post_program_eval_report)
                                                            <form>
                                                                <fieldset class="fieldset">
                                                                    <span class="file-for-label">Post-Program Evaluation Report</span>
                                                                    <div class="file-container">
                                                                        <span>{{ pathinfo(asset($thisEvent->post_program_eval_report), PATHINFO_FILENAME) }}.{{ pathinfo(asset($thisEvent->post_program_eval_report), PATHINFO_EXTENSION) }}</span>
                                                                        <div class="anns-buttons">
                                                                            <a href="{{ asset($thisEvent->post_program_eval_report) }}" download>
                                                                                <i class="bi bi-file-earmark-arrow-down"></i>
                                                                            </a>
                                                                            
                                                                            @if(pathinfo(asset($thisEvent->post_program_eval_report), PATHINFO_EXTENSION) === 'pdf' ||
                                                                                pathinfo(asset($thisEvent->post_program_eval_report), PATHINFO_EXTENSION) === 'docx' ||
                                                                                pathinfo(asset($thisEvent->post_program_eval_report), PATHINFO_EXTENSION) === 'txt' ||
                                                                                pathinfo(asset($thisEvent->post_program_eval_report), PATHINFO_EXTENSION) === 'csv')
                                                                                <a href="#" onclick="window.open('{{ asset($thisEvent->post_program_eval_report) }}', '_blank')"><i class="bi bi-eye"></i></a>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </fieldset>
                                                            </form>
                                                        @endif

                                                        @if($thisEvent->policy_brief)
                                                            <form class="margin-top">
                                                                <fieldset class="fieldset">
                                                                    <span class="file-for-label">Policy Brief</span>
                                                                    <div class="file-container">
                                                                        <span>{{ pathinfo(asset($thisEvent->policy_brief), PATHINFO_FILENAME) }}.{{ pathinfo(asset($thisEvent->policy_brief), PATHINFO_EXTENSION) }}</span>
                                                                        <div class="anns-buttons">
                                                                            <a href="{{ asset($thisEvent->policy_brief) }}" download>
                                                                                <i class="bi bi-file-earmark-arrow-down"></i>
                                                                            </a>
                                                                            
                                                                            @if(pathinfo(asset($thisEvent->policy_brief), PATHINFO_EXTENSION) === 'pdf' ||
                                                                                pathinfo(asset($thisEvent->policy_brief), PATHINFO_EXTENSION) === 'docx' ||
                                                                                pathinfo(asset($thisEvent->policy_brief), PATHINFO_EXTENSION) === 'txt' ||
                                                                                pathinfo(asset($thisEvent->policy_brief), PATHINFO_EXTENSION) === 'csv')
                                                                                <a href="#" onclick="window.open('{{ asset($thisEvent->policy_brief) }}', '_blank')"><i class="bi bi-eye"></i></a>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </fieldset>
                                                            </form>
                                                        @endif

                                                        @if($thisEvent->group_terminal_report)
                                                            <form class="margin-top">
                                                                <fieldset class="fieldset">
                                                                    <span class="file-for-label">Group Terminal Report</span>
                                                                    <div class="file-container">
                                                                        <span>{{ pathinfo(asset($thisEvent->group_terminal_report), PATHINFO_FILENAME) }}.{{ pathinfo(asset($thisEvent->group_terminal_report), PATHINFO_EXTENSION) }}</span>
                                                                        <div class="anns-buttons">
                                                                            <a href="{{ asset($thisEvent->group_terminal_report) }}" download>
                                                                                <i class="bi bi-file-earmark-arrow-down"></i>
                                                                            </a>
                                                                            
                                                                            @if(pathinfo(asset($thisEvent->group_terminal_report), PATHINFO_EXTENSION) === 'pdf' ||
                                                                                pathinfo(asset($thisEvent->group_terminal_report), PATHINFO_EXTENSION) === 'docx' ||
                                                                                pathinfo(asset($thisEvent->group_terminal_report), PATHINFO_EXTENSION) === 'txt' ||
                                                                                pathinfo(asset($thisEvent->group_terminal_report), PATHINFO_EXTENSION) === 'csv')
                                                                                <a href="#" onclick="window.open('{{ asset($thisEvent->group_terminal_report) }}', '_blank')"><i class="bi bi-eye"></i></a>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </fieldset>
                                                            </form>
                                                        @endif

                                                        @if($thisEvent->volunteer_work)
                                                            <form class="margin-top">
                                                                <fieldset class="fieldset">
                                                                    <span class="file-for-label">Volunteer Work</span>
                                                                    <div class="file-container">
                                                                        <span>{{ pathinfo(asset($thisEvent->volunteer_work), PATHINFO_FILENAME) }}.{{ pathinfo(asset($thisEvent->volunteer_work), PATHINFO_EXTENSION) }}</span>
                                                                        <div class="anns-buttons">
                                                                            <a href="{{ asset($thisEvent->volunteer_work) }}" download>
                                                                                <i class="bi bi-file-earmark-arrow-down"></i>
                                                                            </a>
                                                                            
                                                                            @if(pathinfo(asset($thisEvent->volunteer_work), PATHINFO_EXTENSION) === 'pdf' ||
                                                                                pathinfo(asset($thisEvent->volunteer_work), PATHINFO_EXTENSION) === 'docx' ||
                                                                                pathinfo(asset($thisEvent->volunteer_work), PATHINFO_EXTENSION) === 'txt' ||
                                                                                pathinfo(asset($thisEvent->volunteer_work), PATHINFO_EXTENSION) === 'csv')
                                                                                <a href="#" onclick="window.open('{{ asset($thisEvent->volunteer_work) }}', '_blank')"><i class="bi bi-eye"></i></a>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </fieldset>
                                                            </form>
                                                        @endif

                                                        @if($thisEvent->advocacy_plan)
                                                            <form class="margin-top">
                                                                <fieldset class="fieldset">
                                                                    <span class="file-for-label">Advocacy Plan</span>
                                                                    <div class="file-container">
                                                                        <span>{{ pathinfo(asset($thisEvent->advocacy_plan), PATHINFO_FILENAME) }}.{{ pathinfo(asset($thisEvent->advocacy_plan), PATHINFO_EXTENSION) }}</span>
                                                                        <div class="anns-buttons">
                                                                            <a href="{{ asset($thisEvent->advocacy_plan) }}" download>
                                                                                <i class="bi bi-file-earmark-arrow-down"></i>
                                                                            </a>
                                                                            
                                                                            @if(pathinfo(asset($thisEvent->advocacy_plan), PATHINFO_EXTENSION) === 'pdf' ||
                                                                                pathinfo(asset($thisEvent->advocacy_plan), PATHINFO_EXTENSION) === 'docx' ||
                                                                                pathinfo(asset($thisEvent->advocacy_plan), PATHINFO_EXTENSION) === 'txt' ||
                                                                                pathinfo(asset($thisEvent->advocacy_plan), PATHINFO_EXTENSION) === 'csv')
                                                                                <a href="#" onclick="window.open('{{ asset($thisEvent->advocacy_plan) }}', '_blank')"><i class="bi bi-eye"></i></a>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </fieldset>
                                                            </form>
                                                        @endif

                                                    @else
                                                        <a href="{{ $thisEvent->files_link }}" target="_blank"><p class="p-break">{{ $thisEvent->files_link }}</p></a>
                                                    @endif

                                                    @if(!$isHasUploadedFile && !$thisEvent->files_link)
                                                        <div class="file-for">
                                                            <select id="city" class="form-control" wire:model.live="file_for.{{ $event->id }}">
                                                                <option selected value="">File for...</option>
                                                                <option value="pper">Post-Program Evaluation Report</option>
                                                                <option value="pb">Policy Brief</option>
                                                                <option value="gtr">Group Terminal Report</option>
                                                                <option value="vw">Volunteer Work</option>
                                                                <option value="ap">Advocacy Plan</option>
                                                            </select>
                                                        </div>

                                                        <div class="ppo-upload-file-container">
                                                            <form class="ppo-upload-file" wire:submit.prevent="uploadPostProgramObligation({{ $event->id }})">
                                                                <input type="file" id="file" wire:model.live='file' accept=".pdf, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document" required/>
                                                                <button class="btn-submit" type="submit" {{ $file ? '' : 'disabled' }}>
                                                                    <i class="bi bi-upload"></i>
                                                                    @if($thisPpoId === $event->id)
                                                                        <div wire:loading wire:target="file" class="loading-container">
                                                                            <div class="loading-spinner"></div>
                                                                        </div>
                                                                    @endif
                                                                </button>
                                                                
                                                            </form>
                                                        </div>
                                                    @endif

                                                    @if($isHasUploadedFile)
                                                        Or
                                                        <div class="ppo-upload-file-container">
                                                            <form class="ppo-upload-file" wire:submit.prevent="uploadPostProgramObligation({{ $event->id }})">
                                                                <input style="height: 35px;" class="form-control" type="text" id="file" wire:model.live='link' placeholder="Paste here the link of the files" required/>
                                                                <button class="btn-submit" type="submit"><i class="bi bi-upload"></i></button>
                                                            </form>
                                                        </div>
                                                    @endif

                                                    @error('file_for.' . $event->id)
                                                        <span class="text-danger small" style="color: red;">{{ $message }}</span>
                                                    @enderror

                                                @else

                                                    <div class="file-for">
                                                        <select id="city" class="form-control" wire:model.live="file_for.{{ $event->id }}" required>
                                                            <option selected value="">File for...</option>
                                                            <option value="pper">Post-Program Evaluation Report</option>
                                                            <option value="pb">Policy Brief</option>
                                                            <option value="gtr">Group Terminal Report</option>
                                                            <option value="vw">Volunteer Work</option>
                                                            <option value="ap">Advocacy Plan</option>
                                                        </select>
                                                    </div>

                                                    <div class="ppo-upload-file-container">
                                                        <form class="ppo-upload-file" wire:submit.prevent="uploadPostProgramObligation({{ $event->id }})">
                                                            <input type="file" id="file" wire:model.live='file' accept=".pdf, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document" required/>
                                                            <button class="btn-submit" type="submit" {{ $file ? '' : 'disabled' }}>
                                                                <i class="bi bi-upload"></i>
                                                                @if($thisPpoId === $event->id)
                                                                    <div wire:loading wire:target="file" class="loading-container">
                                                                        <div class="loading-spinner"></div>
                                                                    </div>
                                                                @endif
                                                            </button>  
                                                        </form>
                                                    </div>

                                                    Or

                                                    <div class="ppo-upload-file-container">
                                                        <form class="ppo-upload-file" wire:submit.prevent="uploadPostProgramObligation({{ $event->id }})">
                                                            <input style="height: 35px;" class="form-control" type="text" id="file" wire:model.live='link' placeholder="Paste here the link of the files" required/>
                                                            <button class="btn-submit" type="submit"><i class="bi bi-upload"></i></button>
                                                        </form>
                                                    </div>

                                                    @error('file_for.' . $event->id)
                                                        <span class="text-danger small" style="color: red;">{{ $message }}</span>
                                                    @enderror

                                                @endif

                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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
