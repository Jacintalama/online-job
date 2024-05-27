<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report</title>
    <style>
        body {font-family: Arial, sans-serif;}
        table {width: 100%;border-collapse: collapse;margin-top: 20px;}
        th, td {border: 1px solid #dddddd;text-align: left;padding: 8px;}
        th {background-color: #f2f2f2;}
    </style>
</head>
<body>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        h2 {
            text-align: center;
        }
        .logo {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 100px; /* or whatever your desired width is */
        }
        .centered-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    .centered-table th, .centered-table td {
        border: 1px solid #dddddd;
        text-align: center;       /* Center alignment */
        font-weight: bold;        /* Bold font */
        padding: 8px;
    }
    .centered-table th {
        background-color: #f2f2f2;
    }
    .logo {
        width: 70px;             /* Adjust the width as needed */
    }
    .text-center {
    text-align: center;
    }

    </style>


<!-- First Table -->
<table class="centered-table">
    <tr>
        <td rowspan="2">
            <img src="{{ $base64Image }}" alt="Logo" class="logo">
        </td>
        <td class="text-center" colspan="2">Local Government Unit of General Santos City</td>
    </tr>
    <tr>
        <td class="text-center" colspan="2">Human Resource Management and Development Office</td>
    </tr>
</table>


<!-- Second Table -->
<table>
    <tr>
        <td>Posted By:</td>
        <td>
            {{ $job->user ? $job->user->first_name . ' ' . $job->user->middle_initial . '. ' . $job->user->last_name : 'N/A' }}
        </td>
        <td colspan="2">Date: {{ \Carbon\Carbon::parse($job->created_at)->format('d-m-Y') }}</td>

    </tr>

    <tr>
        <td>From Department of:</td>
        <td colspan="2"> {{ $job->department->name }}</td>
    </tr>
    <tr>
        <td>Position Title</td>
        <td colspan="2">{{$job->position_title }} (<strong>)</td>
    </tr>
</table>

<!-- Third Table -->
<h2>Applicants for {{ $job->position_title }}</h2>
<table>
    <thead>
        <tr>
            <th>User Id</th>
            <th>Name</th>
            <th>Matching Score</th>
            <th>Job Created</th>
            <th>Applicant date to hire</th>
     
        </tr>
    </thead>
    <tbody>
        @foreach($sortedApplicants as $applicant)
            <tr>
                <td>{{ $applicant->user_id }}</td>
                <td>{{ $applicant->user->first_name }} {{ $applicant->user->middle_initial }}. {{ $applicant->user->last_name }}</td>
                <td>{{ $applicant->matching_score }}%</td>
                <td>{{ \Carbon\Carbon::parse($job->created_at)->format('d-m-Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($applicant->updated_at)->format('d-m-Y H:i:s') }}</td>

            </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>

