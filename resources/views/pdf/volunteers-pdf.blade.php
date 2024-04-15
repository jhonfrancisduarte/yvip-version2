<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
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
                                <center><p>Volunteers' Program</p></center>
                            @elseif($userDetails['user_role'] == "yip")
                                <center><p>International Program</p></center>
                            @endif
                        </th>
                        <th width="33%">
                            <center><img src="{{ $userDetails['profile_picture'] }}" width="100"></center>
                        </th>
                    </tr>
                </thead>
            </table>
            <hr>
            <table style="width: 100%;">
                <tbody>
                    <tr style="border-top: 1px solid gray; border-right: 1px solid gray; border-left: 1px solid gray; background: #eeeeee;">
                        <td style="padding: 10px 5px;">Passport number: {{ $userDetails['passport_number'] }}</td>
                    </tr>
                </tbody>
            </table>

            <table  style="width: 100%;">
                <tbody>
                    <tr style="border-top: 1px solid gray;">
                        <td style="padding: 5px; border-left: 1px solid gray; border-right: 1px solid gray;">Lastname: {{ $userDetails['last_name'] }}</td>
                        <td style="padding: 5px; border-right: 1px solid gray;">Firstname: {{ $userDetails['first_name'] }}</td>
                        <td style="padding: 5px; border-right: 1px solid gray;">Middlename: {{ $userDetails['middle_name'] }}</td>
                    </tr>
                    <tr style="border-top: 1px solid gray;">
                        <td style="padding: 5px; border-left: 1px solid gray; border-right: 1px solid gray;">Nickname: {{ $userDetails['nickname'] }}</td>
                        <td style="padding: 5px; border-right: 1px solid gray;">Date of Birth: {{ $userDetails['date_of_birth'] }}</td>
                        <td style="padding: 5px; border-right: 1px solid gray;">Civil Status: {{ $userDetails['civil_status'] }}</td>
                    </tr>
                    <tr style="border-top: 1px solid gray;">
                        <td style="padding: 5px; border-left: 1px solid gray; border-right: 1px solid gray;">Age: {{ $userDetails['age'] }}</td>
                        <td style="padding: 5px; border-right: 1px solid gray;">Sex at Birth: {{ $userDetails['sex'] }}</td>
                        <td style="padding: 5px; border-right: 1px solid gray;">Nationality: {{ $userDetails['nationality'] }}</td>
                    </tr>
                    <tr style="border-top: 1px solid gray;">
                        <td style="padding: 5px; border-left: 1px solid gray; border-right: 1px solid gray;">Tel Number: {{ $userDetails['tel_number'] }}</td>
                        <td style="padding: 5px; border-right: 1px solid gray;">Mobile Number: {{ $userDetails['mobile_number'] }}</td>
                        <td style="padding: 5px; border-right: 1px solid gray;">Email: {{ $userDetails['email'] }}</td>
                    </tr>
                    <tr style="border-top: 1px solid gray;">
                        <td style="padding: 5px; border-left: 1px solid gray; border-right: 1px solid gray;">Blood Type: {{ $userDetails['blood_type'] }}</td>
                        <td style="padding: 5px; border-right: 1px solid gray;">Educational Background: {{ $userDetails['educational_background'] }}</td>
                        <td style="padding: 5px; border-right: 1px solid gray;">Status: {{ $userDetails['status'] }}</td>
                    </tr>
                </tbody>
            </table>

            <table style="width: 100%;">
                <tbody>
                    <tr style="border-top: 1px solid gray; border-right: 1px solid gray; border-left: 1px solid gray;">
                        <td style="padding: 5px; ">Permanent Address: {{ $userDetails['p_street_barangay'] }} {{ $userDetails['permanent_selectedCity'] }} {{ $userDetails['permanent_selectedProvince'] }}</td>
                    </tr>
                    <tr style="border-top: 1px solid gray; border-right: 1px solid gray; border-left: 1px solid gray;">
                        <td style="padding: 5px; ">Residential Address: {{ $userDetails['r_street_barangay'] }} {{ $userDetails['residential_selectedCity'] }} {{ $userDetails['residential_selectedProvince'] }}</td>
                    </tr>
                </tbody>
            </table>

            <table style="width: 100%;">
                <tbody>
                    @if($userDetails['status'] == "Student")
                        <tr style="border-top: 1px solid gray; border-bottom: 1px solid gray;">
                            <td style="padding: 5px; border-left: 1px solid gray; border-right: 1px solid gray;">School Name: {{ $userDetails['name_of_school'] }}</td>
                            <td style="padding: 5px; border-right: 1px solid gray;">Course: {{ $userDetails['course'] }}</td>
                        </tr>
                    @endif
                    @if($userDetails['status'] == "Professional")
                        <tr style="border-top: 1px solid gray; border-bottom: 1px solid gray;">
                            <td style="padding: 5px; border-left: 1px solid gray; border-right: 1px solid gray;">Nature of Work: {{ $userDetails['nature_of_work'] }}</td>
                            <td style="padding: 5px; border-right: 1px solid gray;">Employer: {{ $userDetails['employer'] }}</td>
                        </tr>
                    @endif
                    @if($userDetails['organization_name'])
                        <tr style="border-top: 1px solid gray; border-bottom: 1px solid gray;">
                            <td style="padding: 5px; border-left: 1px solid gray; border-right: 1px solid gray;">Organization: {{ $userDetails['organization_name'] }}</td>
                            <td style="padding: 5px; border-right: 1px solid gray;">Position: {{ $userDetails['org_position'] }}</td>
                        </tr>
                    @endif
                </tbody>
            </table>

</body>
</html>