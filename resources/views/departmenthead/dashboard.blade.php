<x-app-layout>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>

@endif
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ $departmentName }} Dashboard
    </h2>
</x-slot>


    <div class="shadow-lg overflow-hidden border-b border-gray-200 sm:rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Position Title</th>
                    <th class="px-6 py-3 bg-gray-50">Status</th>
                    <th class="px-6 py-3 bg-gray-50">Posted On</th>
                    <th class="px-6 py-1 bg-gray-50">Applicants</th>
                    <th class="px-6 py-3 bg-gray-50">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($jobs as $job)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $job->position_title }}</td>
                    <td class="px-6 py-4">
                        @if ($job->is_closed)
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-200 text-gray-800">
                                Job Closed
                            </span>
                        @elseif($job->status === 'published')
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-200 text-green-800">
                                Published
                            </span>
                        @elseif($job->status === 'pending')
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-200 text-yellow-800">
                                Pending
                            </span>
                        @elseif($job->status === 'rejected')
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-200 text-red-800">
                                Rejected
                            </span>
                        @else
                            {{ ucfirst($job->status) }}
                        @endif
                    </td>
                    <td class="px-6 py-4">{{ $job->created_at->format('d-m-Y') }}</td>
                    <td class="px-6 py-4">
                        Applicants: {{ $job->applications->count() }}
                    </td>
                    <td class="px-6 py-4">
                        <a href="{{ route('departmenthead.jobs.edit', $job->id) }}" class="text-yellow-600 hover:text-yellow-900">Edit</a> |
                        <a href="{{ route('departmenthead.jobs.applicants', ['job' => $job->id]) }}" class="text-blue-600 hover:text-blue-900">View Applicants</a> |
                        <form action="{{ route('jobs.destroy', $job->id) }}" method="POST" onsubmit="return confirmDelete();">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
        <!-- Pagination Links -->
        <div class="mt-4">
             {{ $jobs->links() }}
        </div>

        <!-- You can add more content specific to the employer here -->
    </div>
    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this?");
        }
    </script>
</x-app-layout>
