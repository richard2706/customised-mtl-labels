<x-guest-layout>
    <div class="pb-28">
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}" id="login-form">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
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
                    @if (Route::has('password.request'))
                        <x-button-secondary href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </x-button-secondary>
                    @endif
        
                    <x-button-primary class="cursor-pointer" onclick="document.getElementById('login-form').submit();">
                        {{ __('Log in') }}
                    </x-button-primary>
                </div>
            </x-slot>
        </form>
    </div>
</x-guest-layout>
