<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="reg-logo-container text-center">
                    <img src="images/yvip_logo.png" width="100"/>
                </div>
                <h3 class="card-title text-center" style="font-weight: bold; font-size: 24px; font-family: Arial, sans-serif;">Youth Volunteer Passport</h3> <!-- Added font-family style -->
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
                            <p class="card-text" style="font-family: Arial, sans-serif;"> <!-- Added font-family style -->
                                Passport No. : {{ auth()->user()->userData->passport_number }} <br>
                                Full Name : {{ auth()->user()->userData->first_name }} {{ auth()->user()->userData->last_name }}<br>
                                Nationality : {{ auth()->user()->userData->nationality }}<br>
                                Address : {{ auth()->user()->userData->p_street_barangay }} , {{ auth()->user()->userData->permanent_selectedCity }} , {{ auth()->user()->userData->permanent_selectedProvince }}<br>
                                Date of Birth : {{ auth()->user()->userData->date_of_birth }}
                            </p>
                        </div>
                        <!-- QR Code Section -->
                        <div class="col-md-3 text-center"> <!-- Added offset-md-7 and text-right classes -->
                            <img src="{{ $qrCodeUrl }}" alt="QR Code" style="max-width: 100px; height: auto;" class="mx-auto"> <!-- Added mx-auto class -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
