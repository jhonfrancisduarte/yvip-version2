<!DOCTYPE html>
<html>
<head>
    <title>Passport PDF</title>
    <style>
        /* Add CSS styles here */
        body {
            font-family: Arial, sans-serif;
        }
        .passport {
            max-width: 800px; /* Adjust the max-width as needed */
            margin: 0 auto;
            border: 2px solid #000;
            padding: 20px;
            border-radius: 10px;
            background-color: #f9f9f9;
            position: relative; /* Relative position for watermark positioning */
        }
        .watermark {
            position: absolute; /* Absolute position to make it a watermark */
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%); /* Center the watermark */
            opacity: 0.1; /* Adjust opacity to make it more subtle */
            pointer-events: none; /* Ensure the watermark doesn't interfere with clicks */
            z-index: -1; /* Send watermark to the back */
        }
        .passport-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .passport-header img {
            width: 80px;
            height: auto;
        }
        .passport-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .passport-table {
            width: 100%; /* Make the table width 100% */
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .passport-table th, .passport-table td {
            border: 1px solid #000;
            padding: 8px;
        }
        @page {
            size: landscape;
        }
        .page-break {
            page-break-before: always;
        }
    </style>
</head>
<body>
    @php

        $passportNumber = auth()->user()->userData->passport_number;
        $fullName = auth()->user()->userData->first_name . ' ' . auth()->user()->userData->last_name;
        $nationality = auth()->user()->userData->nationality;
        $sex = auth()->user()->userData->sex;
        $address = auth()->user()->userData->p_street_barangay . ', ' . auth()->user()->userData->permanent_selectedCity . ', ' . auth()->user()->userData->permanent_selectedProvince;
        $dateOfBirth = auth()->user()->userData->date_of_birth;
    @endphp

    @foreach ($ipEvents->chunk(5) as $chunk)
        <div class="passport">

            <!-- Watermark logo -->
            <img src="images/yvip_logo.png" alt="Logo" class="watermark">

            <div class="passport-header">
                <h2 class="passport-title">Youth Volunteer Passport</h2>
            </div>
            <table class="passport-table">
                <tr>
                    <td rowspan="8"><img src="{{ $profilePictureUrl }}" alt="Profile Picture" style="width: 150px; height: auto"></td>
                    <th>Passport No.</th>
                    <td>{{ $passportNumber }}</td>
                </tr>
                <tr>
                    <th>Full Name</th>
                    <td>{{ $fullName }}</td>
                </tr>
                <tr>
                    <th>Nationality</th>
                    <td>{{ $nationality }}</td>
                </tr>
                <tr>
                    <th>Sex</th>
                    <td>{{ $sex }}</td>
                </tr>
                <tr>
                    <th>Address</th>
                    <td>{{ $address }}</td>
                </tr>
                <tr>
                    <th>Date of Birth</th>
                    <td>{{ $dateOfBirth }}</td>
                </tr>
                <tr>
                    <th>QR Code</th>
                    <td><center><img src="{{ $qrCodeUrl }}" alt="QR Code" style="max-width: 80px; height: auto;"></td></center>
                </tr>
                <tr>
                    <th>Total Volunteering Hours</th>
                    <td>{{ $totalVolunteeringHours }}</td>
                </tr>
            </table>
            <center>
                <h5>Generated As of : {{ now() }}</h5>
            </center>

        </div>
        <div class="page-break"></div>

        <div class="passport">
            <!-- Watermark logo -->
            <img src="images/yvip_logo.png" alt="Logo" class="watermark">

            <h3 class="passport-title">My Volunteer Events and Trainings</h3>
            <table class="passport-table">
                <thead>
                    <tr>
                        <th>Event Name</th>
                        <th>Category</th>
                        <th>Date / Period</th>
                        <th>Hours</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($volunteerEventsAndTrainings as $event)
                    <tr>
                        <td>{{ $event->event_name }}</td>
                        <td>{{ $event->volunteer_category }}</td>
                        <td>{{ $event->start_date }} - {{ $event->end_date }}</td>
                        <td>{{ $event->volunteer_hours }} hrs</td>
                        <td>{{ $event->status }}</td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
            <center>
                <h5>Generated As of : {{ now() }}</h5>
            </center>
        </div>
        <div class="page-break"></div>


        <div class="passport">
            <!-- Watermark logo -->
            <img src="images/yvip_logo.png" alt="Logo" class="watermark">
            <h3 class="passport-title">My IP Events</h3>
            <table class="passport-table">
                <thead>
                    <tr>
                        <th>Name of Exchange Program/Event</th>
                        <th>Organizer / Sponsor</th>
                        <th>Date / Period</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($chunk as $event)
                    <tr>
                        <td>{{ $event->event_name }}</td>
                        <td>{{ $event->organizer_sponsor }}</td>
                        <td>{{ $event->start }} - {{ $event->end }}</td>
                        <td>{{ $event->status }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <center>
                <h5>Generated As of : {{ now() }}</h5>
            </center>
        </div>
        @if (! $loop->last)
            <div class="page-break"></div>
        @endif
    @endforeach
</body>
</html>
