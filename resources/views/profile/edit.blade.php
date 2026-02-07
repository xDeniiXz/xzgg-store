<x-app-layout :hideNavigation="true">
    <div class="min-h-screen bg-slate-900 flex" x-data="{ sidebarOpen: false, isNavigating: false }" x-init="window.addEventListener('beforeunload', () => { isNavigating = true }); document.addEventListener('click', (e) => { const a = e.target.closest('a[href]'); if (a && !a.hasAttribute('download') && a.getAttribute('target') !== '_blank' && !a.getAttribute('href')?.startsWith('#')) { isNavigating = true } })">

        <aside x-cloak class="w-72 bg-slate-900 text-slate-100 flex flex-col border-r border-slate-800 fixed inset-y-0 left-0 h-screen overflow-y-auto z-40 transition-transform duration-300 ease-in-out"
            :class="{ '-translate-x-full': !sidebarOpen, 'pointer-events-none': !sidebarOpen, 'pointer-events-auto': sidebarOpen }">
            <div class="h-16 flex items-center px-6 border-b border-slate-800 bg-gradient-to-r from-slate-900 to-slate-800">
                <svg class="h-8 w-8 text-indigo-500 mr-3" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                <div>
                    <p class="font-bold text-white text-lg">XZGG Store</p>
                    <p class="text-xs text-slate-400">Manager Panel</p>
                </div>
            </div>

            <nav class="flex-1 px-3 py-8 space-y-2 overflow-y-auto">
                <a href="{{ route('manager.dashboard') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium text-slate-300 hover:bg-slate-800 hover:text-white transition-all duration-200">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span>Kembali ke Dashboard</span>
                </a>
                <a href="{{ url('/') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium text-slate-300 hover:bg-slate-800 hover:text-white transition-all duration-200">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span>Halaman Utama</span>
                </a>
            </nav>

            <div class="border-t border-slate-700 bg-slate-800/50 p-4 space-y-3">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-indigo-500 to-indigo-600 flex items-center justify-center text-white font-bold text-sm flex-shrink-0">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <div class="min-w-0 flex-1">
                        <p class="text-sm font-semibold text-white truncate">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-slate-400">Manager</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2 text-sm font-medium text-red-400 hover:text-red-300 hover:bg-slate-700 rounded-lg transition-colors duration-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <main class="flex-1 transition-all duration-300 ease-in-out" :class="sidebarOpen ? 'lg:ml-72' : 'lg:ml-0'">
            <header class="bg-slate-900 border-b border-slate-800 sticky top-0 z-30">
                <div class="px-6 lg:px-8 py-4 flex justify-between items-center">
                    <div class="flex items-center gap-4">
                        <button @click="sidebarOpen = !sidebarOpen" class="p-2 text-gray-400 hover:bg-gray-700 rounded-lg transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                        <div>
                            <h2 class="text-3xl font-bold text-slate-100">Pengaturan Profil</h2>
                            <p class="text-sm text-slate-400 mt-1">Atur informasi akun dan keamanan</p>
                        </div>
                    </div>
                </div>
            </header>

            <div class="p-6 lg:p-8 space-y-6 bg-slate-900 min-h-screen">
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
                <div class="p-6 bg-slate-800 border border-slate-700 rounded-xl shadow-sm">
                    <div class="max-w-xl">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <div class="p-6 bg-slate-800 border border-slate-700 rounded-xl shadow-sm">
                    <div class="max-w-xl">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                <div class="p-6 bg-slate-800 border border-slate-700 rounded-xl shadow-sm">
                    <div class="max-w-xl">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </main>
    </div>
</x-app-layout>
