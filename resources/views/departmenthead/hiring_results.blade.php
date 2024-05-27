<x-app-layout>
    <h1>Hiring Results for {{ $job->title }}</h1>

    @if($hiringDecision->isEmpty())
        <p>No applicants matched the criteria.</p>
    @else
        <h2>Applicants to Hire:</h2>
        <ul>
            @foreach($hiringDecision as $applicant)
                <li>{{ $applicant->user->name }} - Score: {{ $applicant->matching_score }}</li>
            @endforeach
        </ul>
    @endif
</x-app-layout>
