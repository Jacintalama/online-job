<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Department Head') }}
        </h2>
    </x-slot><br><br>

    <div class="container">
        @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">


                    <div class="card-body">
 <!-- Above the table or somewhere appropriate -->
 <x-button type="button" class="btn btn-primary bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full" data-bs-toggle="modal" data-bs-target="#addDepartmentHeadModal">
    Add Department Head account
</x-button>

                        <table class="table table-hover">
                            <thead>
                                <tr class="hover-row">
                                    <th>Department Head of:</th>
                                    <th>Email</th>
                                    <th>Date</th>
                                    <th>Action</th> <!-- Add this header for the actions -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($departmentheadUsers as $user)
                                    <tr>
                                        <td>{{ optional($user->department)->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->created_at->format('F j, Y') }}</td>
                                        <td>
                                            <!-- Add this form for the delete action -->
                                            <form action="{{ route('admin.deleteUser', $user->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <x-button type="submit" class="btn btn-danger btn-reject btn-sm" onclick="return confirm('Are you sure you want to delete this user?');"><i class="fas fa-trash-alt  mr-2"></i>
                                                    Delete</x-button>
                                            </form>
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
<!-- Add Department Head Modal -->
<div class="modal fade {{ $errors->any() ? 'show d-block' : '' }}" id="addDepartmentHeadModal" tabindex="-1" aria-labelledby="addDepartmentHeadModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addDepartmentHeadModalLabel">Add Department Head account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/admin/add-departmenthead" method="POST">
                @csrf
                <div class="modal-body">

                    <!-- Existing form fields -->
                    <div class="mb-3">
                        <label for="department_id" class="form-label">Add Department Head for this User</label>
                        <select name="department_id" id="department_id" class="form-control" required>
                            @foreach($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                            @endforeach
                        </select>
                        <label for="departmentheadEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="departmentheadEmail" name="email" required>
                    </div>
 <!-- Fields for the user's name -->
 <div class="mb-3">
    <label for="firstName" class="form-label">First Name</label>
    <input type="text" class="form-control" id="firstName" name="first_name" required>
</div>

<div class="mb-3">
    <label for="middleInitial" class="form-label">Middle Initial</label>
    <input type="text" class="form-control" id="middleInitial" name="middle_initial" maxlength="1">
</div>

<div class="mb-3">
    <label for="lastName" class="form-label">Last Name</label>
    <input type="text" class="form-control" id="lastName" name="last_name" required>
</div>

                    <div class="mb-3">
                        <label for="department_headPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="department_headPassword" name="password" required>
                    </div>
                    <!-- Additional fields as needed -->
                </div>
                <div class="modal-footer">
                    <x-button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</x-button>
                    <x-button type="submit" class="btn btn-primary">Add</x-button>
                </div>
            </form>

        </div>
    </div>
</div>
<script>
    // Check for validation errors and show modal if there are any
    @if ($errors->any())
        $('#addDepartmentHeadModal').modal('show');
    @endif
</script>



</x-app-layout>
