@props(['hideNavigation' => false])
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
    <style>
        [x-cloak] {
            display: none !important
        }

        .disable-transitions * {
            transition: none !important;
            animation: none !important;
        }
    </style>
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900" x-data="{ isNavigating: localStorage.getItem('authRedirect') === '1' }" x-bind:class="isNavigating ? 'disable-transitions' : ''" x-init="window.addEventListener('beforeunload', () => { isNavigating = true }); document.addEventListener('click', (e) => { const a = e.target.closest('a[href]'); if (a && !a.hasAttribute('download') && a.getAttribute('target') !== '_blank' && !a.getAttribute('href')?.startsWith('#')) { isNavigating = true } }); document.addEventListener('submit', () => { isNavigating = true }); window.addEventListener('load', () => { setTimeout(() => { localStorage.removeItem('authRedirect'); isNavigating = false }, 180) })">
        @if (! $hideNavigation)
        @include('layouts.navigation')
        @endif

        <!-- Page Heading -->
        @if (isset($header))
        <header class="bg-white dark:bg-gray-800 shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
        <div x-cloak x-show="isNavigating" class="fixed inset-0 z-[999] flex items-center justify-center">
            <div class="absolute inset-0 bg-black/40 backdrop-blur-sm"></div>
            <div class="relative flex items-center gap-3 px-4 py-3 bg-slate-800 border border-slate-700 rounded-lg shadow-lg">
                <svg class="w-5 h-5 text-indigo-400 animate-spin" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <circle cx="12" cy="12" r="10" stroke-width="4" class="opacity-25"></circle>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M4 12a8 8 0 018-8" class="opacity-75"></path>
                </svg>
                <span class="text-sm text-slate-200">Memuat halaman…</span>
            </div>
        </div>
    </div>
</body>

</html>
