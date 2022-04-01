<x-guest-layout>
    <x-slot name="title">Reset Password</x-slot>
    
    <div class="flex flex-col items-center short:pb-16">

        <p class="test-center text-sm my-2">
            This is a secure area of the application. Please confirm your password before continuing.
        </p>

        <!-- Validation Errors -->
        <x-auth-validation-errors :errors="$errors" />

        <form method="POST" action="{{ route('password.confirm') }}" id="confirm-password-form" class="flex flex-col items-center mt-2 w-full max-w-sm">
            @csrf

            <!-- Password -->
            <div class="w-full max-w-sm">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
            </div>

            <x-slot name="footer">
                <div class="flex flex-col items-center space-y-2 p-2">
                    <x-button-submit form="confirm-password-form">
                        {{ __('Confirm') }}
                    </x-button-submit>
                </div>
            </x-slot>
        </form>
    </div>
</x-guest-layout>
