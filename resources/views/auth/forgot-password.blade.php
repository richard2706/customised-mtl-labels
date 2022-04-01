<x-guest-layout>
    <x-slot name="title">Forgot Password</x-slot>

    <div class="flex flex-col items-center short:pb-32">
        <p class="text-center text-sm mb-2">
            If you have forgotten your password, please enter your email address to recieve a password reset link.
        </p>

        <!-- Session Status -->
        <x-auth-session-status :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors :errors="$errors" />

        <form method="POST" action="{{ route('password.email') }}" id="forgot-password-form" class="flex flex-col items-center mt-2 w-full max-w-sm">
            @csrf

            <!-- Email Address -->
            <div class="w-full max-w-sm">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <x-slot name="footer">
                <div class="flex flex-col items-center space-y-2 p-2">
                    <x-button-secondary href="{{ route('login') }}">Back to Login</x-button-secondary>
                    <x-button-submit form="forgot-password-form">
                        {{ __('Email Password Reset Link') }}
                    </x-button-submit>
                </div>
            </x-slot>
        </form>
    </div>
</x-guest-layout>
