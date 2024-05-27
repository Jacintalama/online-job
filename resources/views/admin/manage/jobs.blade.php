<x-app-layout>

<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Manage Jobs') }}
    </h2>
</x-slot><br><br>
@if(session('danger'))
    <div class="alert alert-danger">
        {{ session('danger') }}
    </div>
@endif

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('All Posted Jobs') }}</div>

                <div class="card-body">

                    <table class="table table-striped"> <!-- Added table-striped for zebra-striping -->
                        <thead>
                            <tr>
                                <th>Position Title</th>
                                <th>Department</th>
                                <th>Posted By</th>

                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($jobs as $job)
                            {{-- Dump the job data to debug --}}
                           
                            <tr>
                                <td><strong>{{$job->position_title }}</strong></td>
                                <td>
                                    {{ $job->department->name ?? 'Department not set' }}
                                </td>

                                <td>{{ optional($job->user)->email ?? 'N/A' }}</td>



                                <td>
                                    @if($job->status === 'published')
                                        <!-- Unpublish Form -->
                                        <form action="{{ route('jobs.unpublish', $job->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            <x-button type="submit" class="btn btn-warning btn-sm btn-unpublish">
                                                <i class="fas fa-eye-slash  mr-2"></i> Unpublish
                                            </x-button>
                                        </form>
                                    @elseif($job->status === 'pending' || $job->status === 'unpublished')
                                        <!-- Publish Form -->
                                        <form action="{{ route('jobs.publish', $job->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            <x-button type="submit" class="btn btn-success btn-sm"><i class="fas fa-eye  mr-2"></i> Publish</x-button>
                                        </form>
                                        <!-- Reject Form -->
                                        <form action="{{ route('jobs.reject', $job->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            <x-button type="submit" class="btn btn-danger btn-reject btn-sm">
                                                <i class="fas fa-times  mr-2"></i> Reject
                                            </x-button>
                                        </form>
                                    @elseif($job->status === 'rejected')
                                        <span class="text-danger">Rejected</span>
                                    @else
                                        {{ ucfirst($job->status) }}
                                    @endif
                                    <x-button class="btn-primary btn-sm">
                                        <a href="{{ route('admin.jobs.edit', $job->id) }}" class="text-white text-decoration-none">
                                            <i class="fas fa-edit  mr-2"></i> Edit
                                        </a>
                                    </x-button>


                                </td>



                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>




</x-app-layout>
