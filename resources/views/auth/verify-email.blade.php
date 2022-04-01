<x-guest-layout>
    <x-slot name="title">Verify Email</x-slot>

    <div class="flex flex-col items-center short:pb-32">
        <p class="text-center">Thank you for signing up! Please verify your email address by clicking on the link sent to your email. If you didn't receive the email, please click the button below to have the email resent.</p>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-2 text-sm text-nutrient-low">
                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
            </div>
        @endif

        <div class="mt-4 flex items-center justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div>
                    <x-button>
                        {{ __('Resend Verification Email') }}
                    </x-button>
                </div>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900">
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>
    </div>
</x-guest-layout>
