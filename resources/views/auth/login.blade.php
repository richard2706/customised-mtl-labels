<x-guest-layout>
    <x-slot name="title">Log In</x-slot>

    <div class="flex flex-col items-center pb-44">
        <!-- Session Status -->
        <x-auth-session-status :status="session('status')" />

        <!-- Validation Errors -->
        @if ($errors->any() == 0)
            <p class="text-center">Please enter your login details.</p>
        @else
            <x-auth-validation-errors :errors="$errors" />
        @endif

        <form method="POST" action="{{ route('login') }}" id="login-form" class="flex flex-col items-center mt-2 w-full max-w-sm">
            @csrf

            <!-- Email Address -->
            <div class="w-full">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4 w-full">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="text-nutrient-med focus:border-nutrient-med focus:ring focus:ring-nutrient-med focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm">{{ __('Remember me') }}</span>
                </label>
            </div>

            <x-slot name="footer">
                <div class="flex flex-col items-center space-y-2 p-2">
                    <x-button-secondary href="{{ route('register') }}">Create an Account</x-button-secondary>

                    @if (Route::has('password.request'))
                        <x-button-secondary href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </x-button-secondary>
                    @endif
        
                    <x-button-submit form="login-form">
                        {{ __('Log in') }}
                    </x-button-submit>
                </div>
            </x-slot>
        </form>
    </div>
</x-guest-layout>
