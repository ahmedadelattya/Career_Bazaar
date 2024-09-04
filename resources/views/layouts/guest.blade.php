<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Toggle Theme -->
    <script src="/theme-toggle.js" defer></script>
</head>

<body class="font-sans text-zinc-900 antialiased bg-zinc-100 dark:bg-zinc-900">
    <div class="min-h-screen flex flex-col sm:justify-center items-center container mx-auto p-4 ">
        <!-- <div>
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-zinc-500" />
            </a>
        </div> -->

        <!-- <div> -->
        {{ $slot }}
        <!-- </div> -->
    </div>
</body>

</html>