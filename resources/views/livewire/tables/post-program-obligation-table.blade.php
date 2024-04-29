<section class="content thisUserDetailss-table-content">
    <div class="pop-up-message" @if($popup_message)style="position: absolute; top: 100px !important;"@endif>
        <button type="button" class="close" wire:click="closePopup">
            <span aria-hidden="true">&times;</span>
        </button>
        <p>{{ $popup_message }}</p>
    </div>
    <div class="container-fluid">
        <div class="row thisUserDetails-row">
            <div class="col-12 table-contain">
                <div class="card">
                    @if(session('user_role') == 'sa' || session('user_role') == 'ips')
                        <div class="card-header">
                                <h3 class="card-title">International Program Events Management</h3> 
                                <button type="button" class="btn btn-success btn-sm btn-add-event" wire:click="openAddForm">Add Event</button>
                        </div>
                    @endif

                    <div class="card-header card-header1">
                        <div class="search-bar">
                            <label for="" class="label" style="margin-top: 5px;">Filter: </label>
                            <input type="search" class="form-control" wire:model.live="search" placeholder="Search...">
                        </div>
                    </div>

                    <div class="card-body scroll-table" id="scroll-table">
                        <table id="thisUserDetailss-table" class="table-main table-full-width">
                            <thead>
                                <tr>
                                    <th>Name of Exchange Program/Event</th>
                                    <th>Organizer / Sponsor</th>
                                    <th>Date / Period</th>
                                    <th>Status</th>
                                    <th width="30%">Post-Program Obligation</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($ipEvents as $event)
                                    <tr>
                                        @if($event->approved && $event->status === "Completed")
                                            <td>{{ $event->event_name }}</td>
                                            <td>{{ $event->organizer_sponsor }}</td>
                                            <td>{{ $event->start }} - {{ $event->end }} </td>
                                            <td>
                                                <span class="blue">{{ $event->status }}</span>
                                            </td>
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
                                                    @if($thisEvent->file_paths)
                                                        <p>{{ pathinfo(asset($thisEvent->file_paths), PATHINFO_FILENAME) }}.{{ pathinfo(asset($thisEvent->file_paths), PATHINFO_EXTENSION) }}</p>
                                                        <div class="anns-buttons">
                                                            <a href="{{ asset($thisEvent->file_paths) }}" download>
                                                                <i class="bi bi-file-earmark-arrow-down"></i> Download
                                                            </a>
                                                            
                                                            @if(pathinfo(asset($thisEvent->file_paths), PATHINFO_EXTENSION) === 'pdf' ||
                                                                pathinfo(asset($thisEvent->file_paths), PATHINFO_EXTENSION) === 'docx' ||
                                                                pathinfo(asset($thisEvent->file_paths), PATHINFO_EXTENSION) === 'txt' ||
                                                                pathinfo(asset($thisEvent->file_paths), PATHINFO_EXTENSION) === 'csv')
                                                                <a href="#" onclick="window.open('{{ asset($thisEvent->file_paths) }}', '_blank')"><i class="bi bi-eye"></i> Preview</a>
                                                            @endif
                                                        </div>
                                                    @else
                                                        <a href="{{ $thisEvent->file_links }}" target="_blank"><p class="p-break">{{ $thisEvent->file_links }}</p></a>
                                                    @endif
                                                @else
                                                    <div class="ppo-upload-file-container">
                                                        <form class="ppo-upload-file" wire:submit.prevent="uploadPostProgramObligation({{ $event->id }})">
                                                            <input type="file" id="file" wire:model.live='file' accept=".pdf, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document" required/>
                                                            <button class="btn-submit" type="submit"><i class="bi bi-upload"></i></button>
                                                        </form>
                                                    </div>
                                                    Or
                                                    <div class="ppo-upload-file-container">
                                                        <form class="ppo-upload-file" wire:submit.prevent="uploadPostProgramObligation({{ $event->id }})">
                                                            <input class="form-control" type="text" id="file" wire:model.live='link' placeholder="Paste file link here" required/>
                                                            <button class="btn-submit" type="submit"><i class="bi bi-upload"></i></button>
                                                        </form>
                                                    </div>
                                                    @error('chooseOne')
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
                </div>
            </div>
        </div>
    </div>

</section>
