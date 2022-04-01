<x-guest-layout>
    <x-slot name="title">Reset Password</x-slot>

    <div class="flex flex-col items-center short:pb-16">
        <!-- Validation Errors -->
        <x-auth-validation-errors :errors="$errors" />

        <form method="POST" action="{{ route('password.update') }}" id="reset-password-form" class="flex flex-col items-center mt-2 w-full max-w-sm">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div class="w-full max-w-sm">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus />
            </div>

            <!-- Password -->
            <div class="w-full max-w-sm mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required />
            </div>

            <!-- Confirm Password -->
            <div class="w-full max-w-sm mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                    type="password"
                                    name="password_confirmation" required />
            </div>

            <x-slot>
                <div class="flex flex-col items-center space-y-2 p-2">
                    <x-button-submit form="reset-password-form">
                        {{ __('Reset Password') }}
                    </x-button-submit>
                </div>
            </x-slot>
        </form>
    </div>
</x-guest-layout>
