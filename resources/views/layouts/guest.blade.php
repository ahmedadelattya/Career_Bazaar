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

<body class="font-sans relative  text-zinc-900 antialiased bg-zinc-100 dark:bg-zinc-900 min-h-screen">
    <div class="container mx-auto p-4">
        <div class="gradient-bg  text-zinc-950 dark:text-zinc-950 ">
        </div>
        <style>
            .gradient-bg {
                position: absolute;
                inset: 0;
                z-index: -100;
                background: radial-gradient(ellipse at bottom,
                        color-mix(in lab, currentColor 46%, white 9%),
                        color-mix(in lab, currentColor 44%, transparent 89%))
            }

            /* Optional: Transition effect when switching between light and dark mode */
            @media (prefers-color-scheme: dark) {
                .gradient-bg {
                    transition: background 0.3s ease-in-out;
                }
            }
        </style>
        {{ $slot }}
    </div>
</body>

</html>