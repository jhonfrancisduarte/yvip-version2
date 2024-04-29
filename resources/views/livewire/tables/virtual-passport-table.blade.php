<div>
    <!-- QR Code Modal -->
    <div class="modal fade" id="qrCodeModal" tabindex="-1" aria-labelledby="qrCodeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="width: 500px">
                <div class="modal-header">
                    <h5 class="modal-title" id="qrCodeModalLabel">QR Code</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <img src="{{ $qrCodeUrl }}" alt="QR Code" style="max-width: 300px; height: auto;">
                </div>
            </div>
        </div>
    </div>

    <!-- Your content goes here -->
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card" style="border-radius: 20px; overflow: hidden;">
                    <div class="reg-logo-container text-center">
                        <img src="images/yvip_logo.png" width="100"/>
                    </div>
                    <h3 class="card-title text-center fw-bold fs-4">Youth Volunteer Passport</h3>
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-body">
                                        <img src="{{ asset(auth()->user()->userData->profile_picture) }}" class="card-img-top" alt="Passport Image" style="max-width: 100%; height: auto; display: block;">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <p class="card-text" style="font-family: Arial, sans-serif;">
                                    Passport No. : {{ auth()->user()->userData->passport_number }} <br>
                                    Full Name : {{ auth()->user()->userData->first_name }} {{ auth()->user()->userData->last_name }}
                                    <br>
                                    Nationality : {{ auth()->user()->userData->nationality }}
                                    <br>
                                    Sex : {{ auth()->user()->userData->sex }}
                                    <br>
                                    Address : {{ auth()->user()->userData->p_street_barangay }}, {{ auth()->user()->userData->permanent_selectedCity }}, {{ auth()->user()->userData->permanent_selectedProvince }}
                                    <br>
                                    Date of Birth : {{ auth()->user()->userData->date_of_birth }}
                                </p>
                            </div>
                            <!-- QR Code Section -->
                            <div class="col-md-3 text-center">
                                <a href="#" data-toggle="modal" data-target="#qrCodeModal">
                                    <img src="{{ $qrCodeUrl }}" alt="QR Code" style="max-width: 100px; height: auto;" class="mx-auto">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- My IP Events -->
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card" style="border-radius: 20px; overflow: hidden;">
                    <h3 class="card-title text-center fw-bold fs-4 mt-4">My IP Events</h3>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Name of Exchange Program/Event</th>
                                        <th>Organizer / Sponsor</th>
                                        <th>Date / Period</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($ipEvents as $event)
                                    @if($event->approved)
                                    <tr>
                                        <td>{{ $event->event_name }}</td>
                                        <td>{{ $event->organizer_sponsor }}</td>
                                        <td>{{ $event->start }} - {{ $event->end }}</td>
                                        <td>
                                            <span class="badge bg-{{ $event->status === 'Ongoing' ? 'success' : ($event->status === 'Completed' ? 'primary' : 'warning') }}">
                                                {{ $event->status }}
                                            </span>
                                        </td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <!-- Pagination -->
                    <div class="m-3">
                        {{ $ipEvents->links('livewire::bootstrap') }}
                    </div>
                </div>
                <div class="mt-5"></div>
            </div>
        </div>
    </div>
</div>
