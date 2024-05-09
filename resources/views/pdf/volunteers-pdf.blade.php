<!DOCTYPE html>
<html>
<head>
    <title>Volunteers' PDF</title>
    <style>
        .border-left-right-padding{
            padding: 5px; 
            border-left: 1px solid gray; 
            border-right: 1px solid gray;
        }
        
        .border-right-padding{
            padding: 5px;
            border-right: 1px solid gray;
        }

        .table .border-top{
            border-top: 1px solid gray;
        }

        .table .border{
            border: 1px solid gray;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table .border-top-bottom{
            border-top: 1px solid gray; border-bottom: 1px solid gray;
        }

        .table span{
            font-size: 11px;
            margin-top: -5px;
        }

        .spacer{
            height: 20px;
        }
    </style>
</head>
<body>
            <table style="width: 100%;">
                <thead>
                    <tr>
                        <th width="33%">
                            <center><img src="images/yvip_logo.png" width="100"></center>
                        </th>
                        <th width="34%">
                            <center><h2>The NYC - YVIP</h2></center>
                            @if($userDetails['user_role'] == "yv")
                                <center><span>Volunteers' Program</span></center>
                            @elseif($userDetails['user_role'] == "yip")
                                <center><span>International Program</span></center>
                            @endif
                        </th>
                        <th width="33%">
                            <center><img src="images/nyc-logo_orig.png" width="100"></center>
                        </th>
                    </tr>
                </thead>
            </table>

            <div class="spacer"></div>
    
            <table class="table">
                <tbody>
                    <tr class="border" style="background: #eeeeee;">
                        <td style="padding: 5px; width: 110px;"><img src="{{ $userDetails['profile_picture'] }}" style="width: 100px; height: 100px; border: 1px solid #ccc;"></td>
                        <td style="padding: 10px 5px; text-align:start;">
                            Passport number: {{ $userDetails['passport_number'] }} <br>
                            Firstname: {{ $userDetails['first_name'] }} <br>
                            Middlename: {{ $userDetails['middle_name'] }} <br>
                            Lastname: {{ $userDetails['last_name'] }} <br>
                        </td>
                    </tr>
                </tbody>
            </table>

            <table  class="table">
                <tbody>
                    <tr class="border-top">
                        <td class="border-left-right-padding">
                            <span>Nickname:</span> <br>
                            {{ $userDetails['nickname'] }}
                        </td>
                        <td class="border-right-padding">
                            <span>Date of Birth:</span> <br>
                            {{ $userDetails['date_of_birth'] }}
                        </td>
                        <td class="border-right-padding">
                            <span>Civil Status:</span> <br>
                            {{ $userDetails['civil_status'] }}
                        </td>
                    </tr>
                    <tr class="border-top">
                        <td class="border-left-right-padding">
                            <span>Age:</span> <br>
                            {{ $userDetails['age'] }}
                        </td>
                        <td class="border-right-padding">
                            <span>Sex at Birth:</span> <br>
                            {{ $userDetails['sex'] }}
                        </td>
                        <td class="border-right-padding">
                            <span>Nationality:</span> <br>
                            {{ $userDetails['nationality'] }}
                        </td>
                    </tr>
                    <tr class="border-top">
                        <td class="border-left-right-padding">
                            <span>Tel Number:</span> <br>
                            {{ $userDetails['tel_number'] }}
                        </td>
                        <td class="border-right-padding">
                            <span>Mobile Number:</span> <br>
                            {{ $userDetails['mobile_number'] }}
                        </td>
                        <td class="border-right-padding">
                            <span>Email:</span> <br>
                            {{ $userDetails['email'] }}
                        </td>
                    </tr>
                    <tr class="border-top">
                        <td class="border-left-right-padding">
                            <span>Blood Type:</span> <br>
                            {{ $userDetails['blood_type'] }}
                        </td>
                        <td class="border-right-padding">
                            <span>Educational Background:</span> <br>
                            {{ $userDetails['educational_background'] }}
                        </td>
                        <td class="border-right-padding">
                            <span>Status:</span> <br>
                            {{ $userDetails['status'] }}
                        </td>
                    </tr>
                </tbody>
            </table>

            <table class="table">
                <tbody>
                    <tr class="border">
                        <td class="border-left-right-padding">
                            <span>Permanent Address:</span> <br>
                            {{ $userDetails['p_street_barangay'] }} {{ $userDetails['permanent_selectedCity'] }} {{ $userDetails['permanent_selectedProvince'] }}
                        </td>
                    </tr>
                    <tr class="border">
                        <td class="border-left-right-padding">
                            <span>Residential Address:</span> <br>
                            {{ $userDetails['r_street_barangay'] }} {{ $userDetails['residential_selectedCity'] }} {{ $userDetails['residential_selectedProvince'] }}
                        </td>
                    </tr>
                </tbody>
            </table>

            <table class="table">
                <tbody>
                    @if($userDetails['status'] == "Student")
                        <tr class="border-top-bottom">
                            <td class="border-left-right-padding">
                                <span>School Name:</span> <br>
                                {{ $userDetails['name_of_school'] }}
                            </td>
                            <td class="border-right-padding">
                                <span>Course:</span> <br>
                                {{ $userDetails['course'] }}
                            </td>
                        </tr>
                    @endif
                    @if($userDetails['status'] == "Professional")
                        <tr class="border-top-bottom">
                            <td class="border-left-right-padding">
                                <span>Nature of Work:</span> <br>
                                {{ $userDetails['nature_of_work'] }}
                            </td>
                            <td class="border-right-padding">
                                <span>Employer:</span> <br>
                                {{ $userDetails['employer'] }}
                            </td>
                        </tr>
                    @endif
                    @if($userDetails['organization_name'])
                        <tr class="border-top-bottom">
                            <td class="border-left-right-padding">
                                <span>Organization:</span> <br>
                                {{ $userDetails['organization_name'] }}
                            </td>
                            <td class="border-right-padding">
                                <span>Position:</span> <br>
                                {{ $userDetails['org_position'] }}
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>

</body>
</html>