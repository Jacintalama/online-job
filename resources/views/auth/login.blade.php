<x-guest-layout>
    <x-authentication-card>

        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
{{-- ROLE SELECTOR --}}
<div class="mt-4">
    <label class="block font-medium text-sm text-gray-700">
        Login as:
    </label>
    <div class="role-selection">
        <div class="role" data-role="department_head">
            <i class="fas fa-briefcase "></i>
            <p>DP HEAD</p>
        </div>
        <div class="role" data-role="applicant">
            <i class="fas fa-user"></i>
            <p>Applicant</p>
        </div>
    </div>
    <input type="hidden" name="role" id="role" required>
    <p id="roleError" class="text-red-600 mt-2 hidden">Please select a role.</p>
</div>
<!-- Error Modal -->
<div id="errorModal" class="error-modal hidden">
    <div class="modal-content">
        <span id="closeModal" class="close">&times;</span>
        <p>Please select a role before logging in.</p>
    </div>
</div>

            <div>
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>
            <div class="center-content mt-4 text-center">
                Don't have an account yet? <a href="{{ route('register') }}"><strong>Click here</strong></a> to register.
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif


                <x-button class="ml-4">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>



    </x-authentication-card>
</x-guest-layout>
