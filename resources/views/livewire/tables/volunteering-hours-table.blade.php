<div>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card" style="border-radius: 20px; overflow: hidden;">

                    {{-- <div class="card-header">
                        <div class="col-md-3 search-2">
                            <input type="search" class="form-control float-right" wire:model="search" placeholder="Search...">
                        </div>
                    </div> --}}

                    <div class="card-header card-header1 display-flex">
                        <div class="total-hours">
                            <div class="badge-header">
                                <span class="t-1">Level</span>
                            </div>
                            <div class="badge-body">
                                <span class="t-2">
                                    @php 
                                        $myLevel = 0; 
                                    @endphp
                                    @if($rewardMatrix)
                                        @foreach($rewardMatrix as $hours)
                                            @if($totalHours >= $hours)
                                                @php $myLevel++; @endphp
                                            @endif
                                        @endforeach
                                        
                                        @if ($myLevel > count($rewardMatrix))
                                            {{ count($rewardMatrix) }}
                                        @else
                                            {{ $myLevel }}
                                        @endif
                                    @else
                                        None
                                    @endif
                                </span>
                            </div>                            
                        </div>
                        <div class="total-hours">
                            <div class="badge-header">
                                <span class="t-1">Completed Hours</span>
                            </div>    
                            <div class="badge-body">
                                <span class="t-2">{{ $totalHours }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="card-body scroll-table" id="scroll-table">
                        <table id="thisUserDetailss-table" class="table-main table-full-width">
                            <thead>
                                <tr>
                                    <th class="th-border-rad">Event Name</th>
                                    <th style="text-align: center;">Volunteering Hours <br><span style="font-weight: 400;">( Completed )</span></th>
                                    <th style="text-align: center;">Volunteering Hours <br><span style="font-weight: 400;">( Ongoing )</span></th>
                                    <th style="text-align: center;" class="th-action-btn">Volunteering Hours <br><span style="font-weight: 400;">( Upcoming )</span></th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($volunteerEventsAndTrainings as $event)
                                    <tr>
                                        @if($event->approved)
                                            <td>{{ $event->event_name }}</td>
                                            <td style="text-align: center;">
                                                @if($event->status === "Completed")
                                                    {{ $event->volunteer_hours }}
                                                @else
                                                    <span style="color: #ccc;">N/A</span>
                                                @endif
                                            </td>
                                            <td style="text-align: center;">
                                                @if($event->status === "Ongoing")
                                                    {{ $event->volunteer_hours }}
                                                @else
                                                    <span style="color: #ccc;">N/A</span>
                                                @endif
                                            </td>
                                            <td style="text-align: center;">
                                                @if($event->status === "Upcoming")
                                                    {{ $event->volunteer_hours }}
                                                @else
                                                    <span style="color: #ccc;">N/A</span>
                                                @endif
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="m-3">
                        {{ $volunteerEventsAndTrainings->links('livewire::bootstrap') }}
                    </div>

                </div>
                <div class="mt-5"></div>
            </div>
        </div>
    </div>
</div>
