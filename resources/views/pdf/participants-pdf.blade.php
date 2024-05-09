<!DOCTYPE html>
<html>
<head>
    <title>Passport PDF</title>
    <style>
        .page-break {
            page-break-before: always;
        }

        .width-100{
            width: 100%;
        }

        .header{
            border-top: 1px solid gray; 
            border-right: 1px solid gray; 
            border-left: 1px solid gray; 
            background: #ccc;
        }

        .header td{
            padding: 8px 5px 8px;
        }

        .align-left{
            text-align: start;
        }

        .align-center{
            text-align: center;
        }

        .bold{
            font-weight: bold;
        }

        td{
            padding: 5px;
        }

        .border-bottom{
            border-bottom: 1px solid #ccc;
        }

        .spacer{
            height: 20px;
        }
    </style>
</head>
<body>

    <table class="width-100">
        <thead>
            <tr>
                <th width="33%">
                    <center><img src="images/yvip_logo.png" width="100"></center>
                </th>
                <th width="34%">
                    <center><h2>The NYC - YVIP</h2></center>
                    @if($eventData['participant_type'] === "yv")
                        <center><span>YV Events and Trainings</span></center>
                    @elseif($eventData['participant_type'] === "ip")
                        <center><span>IP Events</span></center>
                    @endif
                </th>
                <th width="33%">
                    <center><img src="images/nyc-logo_orig.png" width="100"></center>
                </th>
            </tr>
        </thead>
    </table>

    <div class="spacer"></div>
    <hr>

    <table class="width-100">
        <tbody>
            <tr>
                <td>Event Name: {{ $eventData['event_name'] }}</td>
            </tr>
            @if($eventData['event_type'])
                <tr>
                    <td>Type: {{ $eventData['event_type'] }}</td>
                </tr>
            @endif
            <tr>
                @if($eventData['participant_type'] === "yv")
                    <td>Organizer/Facilitator: {{ $eventData['organizer_facilitator'] }}</td>
                @else
                    <td>Organizer/Sponsor: {{ $eventData['organizer_facilitator'] }}</td>
                @endif
            </tr>
            <tr>
                <td>Date/Period: {{ $eventData['event_start'] }} - {{ $eventData['event_end'] }}</td>
            </tr>
            @if($eventData['hours'])
                <tr>
                    <td>Voulunteering Hours: {{ $eventData['hours'] }}</td>
                </tr>
            @endif
        </tbody>
    </table>

    <hr>

    <table class="width-100">
        <tbody>
            <tr>
                <td>Participants</td>
            </tr>
        </tbody>
    </table>

    <table class="width-100">
        <tbody>
            <tr class="header">
                <td width="5%"></td>
                <td width="25%" class="align-left bold">Passport Number</td>
                <td width="70%" class="align-left bold">Name</td>
            </tr>
        </tbody>
        <tbody>
            @php
                $count = 1;
            @endphp
            @foreach ($participantData as $data)
                <tr>
                    <td class="border-bottom align-center">{{ $count }}</td>
                    <td class="border-bottom">{{ $data['passport_number'] }}</td>
                    <td class="border-bottom">{{ $data['name'] }}</td>
                </tr>
                @php
                    $count ++;
                @endphp
            @endforeach
        </tbody>
    </table>

</body>
</html>
