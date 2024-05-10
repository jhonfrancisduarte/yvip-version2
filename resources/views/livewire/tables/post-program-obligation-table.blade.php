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
                            <label for="" class="label" style="margin-top: 5px;">Filter: </label>
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
                                            <td>
                                                <span class="blue">{{ $event->status }}</span>
                                            </td>
                                            <td width="30%">
                                                @php
                                                    $thisEvents = $ppoFiles->where('event_id', $event->id);
                                                @endphp

                                            @foreach($thisEvents as $thisEvent)
                                                @if($thisEvent->file_paths)
                                                    <div class="file-container d-flex justify-content-between align-items-center">
                                                        <p class="mb-0">

                                                            @if(strlen(pathinfo(asset($thisEvent->file_paths), PATHINFO_FILENAME)) > 10)

                                                                {{ substr(pathinfo(asset($thisEvent->file_paths), PATHINFO_FILENAME), 0, 10) }}...
                                                            @else

                                                                {{ pathinfo(asset($thisEvent->file_paths), PATHINFO_FILENAME) }}
                                                            @endif
                                                            .{{ pathinfo(asset($thisEvent->file_paths), PATHINFO_EXTENSION) }}
                                                        </p>
                                                        <div class="anns-buttons">
                                                            <a href="{{ asset($thisEvent->file_paths) }}" download class="btn btn-primary btn-sm mr-2">
                                                                <i class="bi bi-file-earmark-arrow-down"></i>
                                                            </a>
                                                            <button wire:click="deleteFile({{ $thisEvent->id }})" class="btn btn-danger btn-sm">
                                                                <i class="bi bi-trash"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                @elseif($thisEvent->file_links)
                                                    <a href="{{ $thisEvent->file_links }}" target="_blank">
                                                        <p class="p-break">{{ $thisEvent->file_links }}</p>
                                                    </a>
                                                @endif
                                            @endforeach


                                                <div class="ppo-upload-file-container">
                                                    <form class="ppo-upload-file" wire:submit.prevent="uploadPostProgramObligation({{ $event->id }})">
                                                        <input type="file" id="file" wire:model="files" accept=".pdf, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document" multiple required/>

                                                        <button class="btn-submit" type="submit" {{ $files ? '' : 'disabled' }}><i class="bi bi-upload"></i></button>

                                                        @if($thisPpoId === $event->id)
                                                            <div wire:loading wire:target="files" class="loading-container">
                                                                <div class="loading-spinner"></div>
                                                            </div>
                                                        @endif
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
