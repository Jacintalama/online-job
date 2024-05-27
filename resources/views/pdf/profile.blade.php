<!DOCTYPE html>
<html>
<head>
    <title>Applicant Profile</title>
    <style>
        body {
            display: flex;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .sidebar {
            flex: 1;
            background-color: #f0f0f0;
            padding: 20px;
        }
        .content {
            flex: 2;
            padding: 20px;
        }
        img {
            width: 100px;
            border-radius: 50%;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h1>{{ $user->name }}'s Profile</h1>
        <!-- Profile Photo -->
        @if($user->profile_photo_path)
            <img src="{{ public_path('storage/' . $user->profile_photo_path) }}" alt="{{ $user->name }}">
        @else
            <p>No profile photo available</p>
        @endif
        <p>Email: {{ $user->email }}</p>

        @if($user->role == 'applicant')
            <p>First Name: {{ $user->first_name }}</p>
            <p>Middle Initial: {{ $user->middle_initial }}</p>
            <p>Last Name: {{ $user->last_name }}</p>
            <p>Date of Birth: {{ $user->dob }}</p>
            <p>Gender: {{ ucfirst($user->gender) }}</p>
            <p>Address: {{ $user->street_no }}, {{ $user->barangay }}, {{ $user->municipality }}, {{ $user->province }}, {{ $user->city }}</p>
        @endif
    </div>
    <div class="content">
        <h2>Education</h2>
        <p>Highest Education: {{ $user->highest_education }}</p>
        <p>School Location: {{ $user->school_location }}</p>
        <p>Degree: {{ $user->degree }}</p>


        <h2>Experience</h2>
        <p>Job Experience: {{ $user->job_experience }}</p>
        <p>Job Location: {{ $user->job_location }}</p>
        <p>Company Name: {{ $user->company_name }}</p>

        <h2>Qualification</h2>

        <p>Achievements: {{ $user->achievements }}</p>
        <p>Certifications: {{ $user->certifications }}</p>
        <p>Eligibility: {{ $user->eligibility }}</p>
        <p>Skills: {{ $user->skills }}</p>

    </div>
</body>
</html>
