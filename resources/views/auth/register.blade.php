<x-guest-layout>
    <x-slot name="title">Create Account</x-slot>

    <div class="flex flex-col items-center pb-32">
        
        <!-- Validation Errors -->
        @if ($errors->any() == 0)
            <p class="text-center">Please enter your details to create an account.</p>
        @else
            <x-auth-validation-errors :errors="$errors" />
        @endif

        <form method="POST" action="{{ route('register') }}" id="register-form" class="flex flex-col items-center mt-2 w-full max-w-sm">
            @csrf

            <!-- Name -->
            <div class="w-full">
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4 w-full">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4 w-full">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4 w-full">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <x-slot name="footer">
                <div class="flex flex-col items-center space-y-2 p-2">
                    <x-button-secondary href="{{ route('login') }}">Login</x-button-secondary>
    
                    <x-button-submit form="register-form">Create Account</x-button-submit>
                </div>
            </x-slot>
        </form>
    </div>
</x-guest-layout>
