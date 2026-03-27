<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? config('app.name') }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @livewireStyles
    </head>
    <body class="h-screen flex gap-8 bg-white dark:bg-zinc-900">
        <aside class="min-w-64 h-full bg-zinc-100 dark:bg-zinc-800">

        </aside>
        <main class="flex-1 pt-8 text-zinc-900 dark:text-white">
            {{ $slot }}
        </main>

        @livewireScripts
    </body>
</html>
