<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Reports') }}
        </h2>
    </x-slot><br><br>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card border-0 shadow-lg">
                    <div class="card-header bg-primary text-white">{{ __('Admin Reports') }}</div>
    
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Posted By:</th>
                                    <th>From Department of:</th>
                                    <th>Date Job Created</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($jobs as $job)
                                    <tr>
                                        <td>{{ $job->user->first_name }} {{ $job->user->middle_initial }}. {{ $job->user->last_name }}</td>
                                        <td> {{ $job->department->name }}</td>
                                        <td>{{ \Carbon\Carbon::parse($job->created_at)->format('d-m-Y') }}</td>
                                        <td>
                                            <x-button class="btn-primary">
                                                <a href="{{ route('generate.pdf', $job->id) }}" class="text-white text-decoration-none">
                                                    <i class="fas fa-file-pdf"></i> Download Report
                                                </a>
                                            </x-button>
                                            
                                        </td>
                                    </tr>
                                @endforeach
                                {{ $jobs->links() }}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</x-app-layout>
