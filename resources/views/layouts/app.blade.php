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
        <div class="min-h-screen">
            <!-- Navigation Bar -->
            <nav class="fixed top-0 left-0 right-0 h-14 bg-nutrient-low shadow-lg px-4 sm:px-6 flex items-center">
                <h2 class="font-bold text-xl">
                    {{ $header }}
                </h2>

                <div class="ml-auto content-center">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();"
                            class="text-gray-800 border-2 border-gray-800 py-1 px-2 sm:hover:bg-black sm:hover:bg-opacity-10">
                            {{ __('Log Out') }}
                        </a>
                    </form>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="pt-16 px-2">
                {{ $slot }}
            </main>

            <!-- Optional Footer -->
            <div class="fixed bottom-0 left-0 right-0 bg-white">
                {{ $footer ?? '' }}
            </div>
        </div>
    </body>
</html>
