<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            <!-- Navigation Bar -->
            <nav class="bg-nutrient-low shadow-lg max-w-7xl py-5 px-4 sm:px-6 flex items-center">
                <h2 class="font-bold text-xl">
                    {{ $header }}
                </h2>

                <div class="ml-auto content-center">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();"
                            class="text-gray-800 border-2 border-gray-800 p-2 sm:hover:bg-black sm:hover:bg-opacity-10">
                            {{ __('Log Out') }}
                        </a>
                    </form>
                </div>
            </nav>

            <!-- Main Content -->
            <main>
                {{ $slot }}
            </main>

            <div class="fixed bottom-0 left-0 right-0 max-w-7xl py-5 px-4 sm:px-6">
                {{ $footer }}
            </div>
        </div>
    </body>
</html>
