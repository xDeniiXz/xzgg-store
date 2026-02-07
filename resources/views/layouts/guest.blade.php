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
    </style>
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-slate-900 flex" x-data="{ sidebarOpen: false, isNavigating: false, initialized: false }" x-bind:class="isNavigating ? 'disable-transitions' : ''" x-init="$nextTick(() => { initialized = true }); window.addEventListener('beforeunload', () => { isNavigating = true }); document.addEventListener('click', (e) => { const a = e.target.closest('a[href]'); if (a && !a.hasAttribute('download') && a.getAttribute('target') !== '_blank' && !a.getAttribute('href')?.startsWith('#')) { isNavigating = true } }); document.addEventListener('submit', () => { isNavigating = true })">
        <aside x-cloak class="w-72 bg-slate-900 text-slate-100 flex flex-col border-r border-slate-800 fixed inset-y-0 left-0 h-screen overflow-y-auto z-40" :class="{ '-translate-x-full': !sidebarOpen, 'pointer-events-none': !sidebarOpen, 'pointer-events-auto': sidebarOpen, 'transition-transform duration-300 ease-in-out': initialized }">
            <div class="h-16 flex items-center px-6 border-b border-slate-800 bg-gradient-to-r from-slate-900 to-slate-800">
                <svg class="h-8 w-8 text-indigo-500 mr-3" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                <div>
                    <p class="font-bold text-white text-lg">XZGG Store</p>
                    @php
                    $subtitle = match(true) {
                    request()->routeIs('login') => 'Panel Login',
                    request()->routeIs('register') => 'Panel Register',
                    default => (auth()->check() ? 'Akun' : 'Selamat Datang'),
                    };
                    @endphp
                    <p class="text-xs text-slate-400">{{ $subtitle }}</p>
                </div>
            </div>
            <nav class="flex-1 px-3 py-8 space-y-2 overflow-y-auto">
                @auth
                @php
                $dashboardRoute = match(auth()->user()->role) {
                'super_admin' => route('manager.dashboard'),
                'admin' => route('dashboard.supervisor'),
                'operator' => route('dashboard.kasir'),
                default => route('manager.dashboard'),
                };
                @endphp
                <a href="{{ $dashboardRoute }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium text-slate-300 hover:bg-slate-800 hover:text-white transition-all duration-200">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span>Kembali ke Dashboard</span>
                </a>
                @else
                <a href="{{ url('/') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium text-slate-300 hover:bg-slate-800 hover:text-white transition-all duration-200">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span>Halaman Utama</span>
                </a>
                @endauth
            </nav>
        </aside>

        <main class="flex-1" :class="sidebarOpen ? 'lg:ml-72' : 'lg:ml-0'">
            <div class="px-6 lg:px-8 py-4">
                <button @click="sidebarOpen = !sidebarOpen" class="p-2 text-gray-400 hover:bg-gray-700 rounded-lg transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
            <div class="w-full sm:max-w-md mt-12 mx-auto px-6 py-6 bg-slate-800 border border-slate-700 shadow-md overflow-hidden sm:rounded-lg text-gray-200">
                {{ $slot }}
            </div>
        </main>
    </div>
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
</body>

</html>
