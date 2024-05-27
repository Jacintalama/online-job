<x-app-layout>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Account Rejected') }}</div>
                    <div class="card-body">
                        <p>Your employer account has been rejected. If you believe this is an error, please contact our support team.</p>
                        <!-- Optionally, you can display the reject reason if you have one -->
                        <p><strong>Reason:</strong> {{ Auth::user()->reject_reason }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
