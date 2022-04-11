<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ ($title ?? '' ? $title . ' - ' : '') . config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen" id="app">
            <!-- Navigation Bar -->
            <nav class="fixed top-0 left-0 right-0 z-10 h-14 bg-nutrient-low shadow-lg px-3 sm:px-6 flex items-center">
                <h2 class="font-bold text-xl">
                    {{ $title ?? config('app.name', 'Laravel') }}
                </h2>

                <div class="min-w-max ml-auto pl-2 content-center">
                    @auth
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a onclick="event.preventDefault(); this.closest('form').submit();" href="#"
                                class="text-gray-800 border-2 border-gray-800 py-1.5 px-2.5 sm:hover:bg-black sm:hover:bg-opacity-10 focus:ring focus:ring-black focus:ring-opacity-25">
                                Log out
                            </a>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-800 border-2 border-gray-800 py-1.5 px-2.5 sm:hover:bg-black sm:hover:bg-opacity-10 focus:ring focus:ring-black focus:ring-opacity-25">
                            Log in
                        </a>
                    @endauth
                </div>
            </nav>

            <!-- Main Content -->
            <main class="pt-14 mx-2">
                <div class="h-4"></div>
                {{ $slot }}
            </main>

            <!-- Optional Footer -->
            <div class="short:fixed short:bottom-0 short:left-0 short:right-0 mt-4 short:mt-0 bg-white">
                {{ $footer ?? '' }}
            </div>
        </div>
    </body>
</html>
