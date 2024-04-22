<div class="container mt-4">
    <div class="row">
        <div class="col-md-3" > <!-- Adjusted to col-md-3 -->
            <div class="card">
                <img src="{{ asset(auth()->user()->userData->profile_picture) }}" class="card-img-top" alt="Passport Image" style="max-width: 100%; height: auto;">
                <div class="card-body text-center">
                    <h5 class="card-title">{{ auth()->user()->userData->nickname }}</h5>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title" style="font-weight: bold; font-size: 24px;">Passport Details</h3>
                    <p class="card-text">
                        <strong>Passport No.: </strong>{{ auth()->user()->userData->passport_number }}<br>
                        <strong>Name:</strong> {{ auth()->user()->userData->first_name }} {{ auth()->user()->userData->last_name }}<br>
                        <strong>Nationality:</strong> {{ auth()->user()->userData->nationality }}<br>
                        <strong>Date of Birth:</strong> {{ auth()->user()->userData->date_of_birth }} <br>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <img src="{{ $qrCodeUrl }}" alt="QR Code" style="max-width: 100px; height: auto;">
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-4"></div>
        <div class="col-md-8"></div>
    </div>
</div>
