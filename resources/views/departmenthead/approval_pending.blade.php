<x-app-layout>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card">
            <div class="card-header">
                @if(auth()->user()->is_rejected)
                    Account Rejected
                @else
                    Approval Pending
                @endif
            </div>
            <div class="card-body alert-box">
                @if(auth()->user()->is_rejected)
                    <div class="alert alert-danger">
                        <strong>Account Rejected:</strong> Your account has been rejected by the admin. Please contact support for more information.
                    </div>
                @else
                    <div class="alert alert-warning">
                        <strong>Approval Pending:</strong> Your account is pending approval by the admin. Please wait or contact support for more information.
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
