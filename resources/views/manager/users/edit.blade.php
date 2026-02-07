<x-app-layout :hideNavigation="true">
    <div class="min-h-screen bg-slate-900 flex" x-data="{ sidebarOpen: false, isNavigating: false }" x-init="window.addEventListener('beforeunload', () => { isNavigating = true }); document.addEventListener('click', (e) => { const a = e.target.closest('a[href]'); if (a && !a.hasAttribute('download') && a.getAttribute('target') !== '_blank' && !a.getAttribute('href')?.startsWith('#')) { isNavigating = true } })">
        <aside x-cloak class="w-72 bg-slate-900 text-slate-100 flex flex-col border-r border-slate-800 fixed inset-y-0 left-0 h-screen overflow-y-auto z-40 transition-transform duration-300 ease-in-out" :class="{ '-translate-x-full': !sidebarOpen, 'pointer-events-none': !sidebarOpen, 'pointer-events-auto': sidebarOpen }">
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
                <a href="{{ route('manager.users.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium text-slate-300 hover:bg-slate-800 hover:text-white transition-all duration-200">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <span>Kelola User</span>
                </a>
                <a href="{{ url('/') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium text-slate-300 hover:bg-slate-800 hover:text-white transition-all duration-200">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span>Halaman Utama</span>
                </a>
            </nav>
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
                            <h2 class="text-3xl font-bold text-slate-100">Edit User</h2>
                            <p class="text-sm text-slate-400 mt-1">Perbarui informasi akun dan role</p>
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
                @if(session('success'))
                <div class="p-3 rounded-lg border border-green-700 bg-green-900/30 text-green-300 text-sm">
                    {{ session('success') }}
                </div>
                @endif
                @if(session('error'))
                <div class="p-3 rounded-lg border border-red-700 bg-red-900/30 text-red-300 text-sm">
                    {{ session('error') }}
                </div>
                @endif

                <div class="p-6 bg-slate-800 border border-slate-700 rounded-xl shadow-sm max-w-xl">
                    <form method="POST" action="{{ route('manager.users.update', $user) }}" class="space-y-6">
                        @csrf
                        @method('PUT')
                        <div>
                            <x-input-label for="name" :value="__('Nama')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>
                        <div>
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
                            <x-input-error class="mt-2" :messages="$errors->get('email')" />
                        </div>
                        <div>
                            <x-input-label for="role" :value="__('Role')" />
                            <select id="role" name="role" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600">
                                <option value="operator" {{ old('role', $user->role) === 'operator' ? 'selected' : '' }}>Operator</option>
                                <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="super_admin" {{ old('role', $user->role) === 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('role')" />
                        </div>
                        <div>
                            <x-input-label for="password" :value="__('Password (opsional)')" />
                            <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
                            <x-input-error class="mt-2" :messages="$errors->get('password')" />
                        </div>
                        <div>
                            <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" />
                            <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
                        </div>
                        <div class="flex items-center gap-3">
                            <x-primary-button>Simpan</x-primary-button>
                            <a href="{{ route('manager.users.index') }}" class="px-4 py-2 text-sm font-semibold rounded-lg bg-slate-700 hover:bg-slate-600 text-slate-100">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</x-app-layout>
