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
        <div class="min-h-screen">
            <!-- Navigation Bar -->
            <nav class="fixed top-0 left-0 right-0 h-14 bg-nutrient-low shadow-lg px-4 sm:px-6 flex items-center">
                <h2 class="font-bold text-xl">
                    {{ $title ?? config('app.name', 'Laravel') }}
                </h2>
                {{ $navigation ?? '' }}
            </nav>

            <!-- Main Content -->
            <main class="pt-14 mx-2">
                <div class="h-4"></div>
                {{ $slot }}
            </main>

            <!-- Optional Footer -->
            <div class="fixed bottom-0 left-0 right-0 bg-white">
                {{ $footer ?? '' }}
            </div>
        </div>
    </body>
</html>
