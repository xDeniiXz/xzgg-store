<x-app-layout :hideNavigation="true">
    <div class="min-h-screen bg-slate-900 flex" x-data="{ sidebarOpen: false, confirmOpen: false, confirmFormId: null, isNavigating: false }" x-init="window.addEventListener('beforeunload', () => { isNavigating = true }); document.addEventListener('click', (e) => { const a = e.target.closest('a[href]'); if (a && !a.hasAttribute('download') && a.getAttribute('target') !== '_blank' && !a.getAttribute('href')?.startsWith('#')) { isNavigating = true } })">
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
                <a href="{{ route('manager.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium text-slate-300 hover:bg-slate-800 hover:text-white transition-all duration-200">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span>Dashboard</span>
                </a>
                <a href="{{ url('/') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium text-slate-300 hover:bg-slate-800 hover:text-white transition-all duration-200">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span>Halaman Utama</span>
                </a>
                <a href="{{ route('manager.users.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium bg-indigo-600 text-white shadow-lg shadow-indigo-600/50 transition-all duration-200">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <span>Kelola User</span>
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
                            <h2 class="text-3xl font-bold text-slate-100">Kelola User</h2>
                            <p class="text-sm text-slate-400 mt-1">Tambah, ubah, dan hapus akun pengguna</p>
                        </div>
                    </div>
                    <a href="{{ route('manager.users.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-lg transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Tambah User
                    </a>
                </div>
            </header>

            <div class="p-6 lg:p-8 space-y-6 bg-slate-900 min-h-screen">
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

                <div class="bg-slate-800 border border-slate-700 rounded-xl overflow-hidden shadow-sm">
                    <div class="px-6 py-4 border-b border-slate-700 space-y-3">
                        <div class="flex items-center justify-between">
                            <p class="text-sm font-semibold text-slate-200">Daftar User</p>
                            <span class="text-xs text-slate-400">Total: {{ $users->total() }}</span>
                        </div>
                        <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-2">
                            <div>
                                <label class="block text-xs text-slate-400 mb-1">Urut berdasarkan</label>
                                <select name="sort_field" class="w-full rounded-md border-slate-700 bg-slate-900 text-slate-200 text-sm">
                                    @php
                                    $sf = request('sort_field', 'name');
                                    @endphp
                                    <option value="name" {{ $sf==='name' ? 'selected' : '' }}>Nama</option>
                                    <option value="email" {{ $sf==='email' ? 'selected' : '' }}>Email</option>
                                    <option value="role" {{ $sf==='role' ? 'selected' : '' }}>Role</option>
                                    <option value="created_at" {{ $sf==='created_at' ? 'selected' : '' }}>Dibuat</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs text-slate-400 mb-1">Arah</label>
                                <select name="sort_dir" class="w-full rounded-md border-slate-700 bg-slate-900 text-slate-200 text-sm">
                                    @php
                                    $sd = request('sort_dir', 'asc');
                                    @endphp
                                    <option value="asc" {{ $sd==='asc' ? 'selected' : '' }}>ASC</option>
                                    <option value="desc" {{ $sd==='desc' ? 'selected' : '' }}>DESC</option>
                                </select>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-xs text-slate-400 mb-1">Cari</label>
                                <input type="text" name="q" value="{{ request('q') }}" placeholder="Nama/Email"
                                    class="w-full rounded-md border-slate-700 bg-slate-900 text-slate-200 text-sm px-3 py-2" />
                            </div>
                            <div class="md:col-span-4 flex items-center gap-2">
                                <button type="submit" class="px-4 py-2 text-sm font-semibold rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white">
                                    Terapkan
                                </button>
                                <a href="{{ route('manager.users.index') }}" class="px-4 py-2 text-sm font-semibold rounded-lg bg-slate-700 hover:bg-slate-600 text-slate-100">
                                    Reset
                                </a>
                            </div>
                        </form>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-slate-700">
                            <thead class="bg-slate-800">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-400 uppercase">No</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-400 uppercase">Nama</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-400 uppercase">Email</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-400 uppercase">Role</th>
                                    <th class="px-6 py-3 text-right text-xs font-semibold text-slate-400 uppercase">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-700 bg-slate-900">
                                @foreach ($users as $user)
                                <tr class="hover:bg-slate-800/50">
                                    <td class="px-6 py-4 text-sm text-slate-400">{{ $users->firstItem() + $loop->index }}</td>
                                    <td class="px-6 py-4 text-sm text-slate-200">{{ $user->name }}</td>
                                    <td class="px-6 py-4 text-sm text-slate-200">{{ $user->email }}</td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-1 text-xs rounded-full
                                                @if($user->role === 'super_admin') bg-indigo-900/40 text-indigo-300 border border-indigo-700 @endif
                                                @if($user->role === 'admin') bg-amber-900/40 text-amber-300 border border-amber-700 @endif
                                                @if($user->role === 'operator') bg-emerald-900/40 text-emerald-300 border border-emerald-700 @endif">
                                            {{ strtoupper(str_replace('_',' ',$user->role)) }}
                                        </span>
                                        @if($user->id === auth()->id())
                                        <span class="ml-2 px-2 py-1 text-xs rounded-full bg-slate-800 text-slate-300 border border-slate-700">Akun Anda</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center justify-end gap-2">
                                            <a href="{{ route('manager.users.show', $user) }}" class="px-3 py-1.5 text-xs font-semibold rounded-lg bg-slate-700 hover:bg-slate-600 text-slate-100">Detail</a>
                                            @if($user->id !== auth()->id())
                                            <a href="{{ route('manager.users.edit', $user) }}" class="px-3 py-1.5 text-xs font-semibold rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white">Edit</a>
                                            <form id="del-{{ $user->id }}" action="{{ route('manager.users.destroy', $user) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" @click="confirmOpen = true; confirmFormId = 'del-{{ $user->id }}'" class="px-3 py-1.5 text-xs font-semibold rounded-lg bg-red-600 hover:bg-red-700 text-white">Hapus</button>
                                            </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="px-6 py-4 border-t border-slate-700">
                        {{ $users->appends(request()->query())->links() }}
                    </div>
                </div>

                <div x-show="confirmOpen" class="fixed inset-0 z-50 flex items-center justify-center">
                    <div class="absolute inset-0 bg-black/50" @click="confirmOpen = false"></div>
                    <div class="relative w-full max-w-sm mx-auto bg-slate-800 border border-slate-700 rounded-xl shadow-lg p-6">
                        <p class="text-slate-200 text-sm mb-4">Hapus user ini? Tindakan ini tidak dapat dibatalkan.</p>
                        <div class="flex justify-end gap-2">
                            <button @click="confirmOpen = false" class="px-4 py-2 text-sm font-semibold rounded-lg bg-slate-700 hover:bg-slate-600 text-slate-100">Batal</button>
                            <button @click="document.getElementById(confirmFormId).submit()" class="px-4 py-2 text-sm font-semibold rounded-lg bg-red-600 hover:bg-red-700 text-white">Hapus</button>
                        </div>
                    </div>
                </div>
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
        </main>
    </div>
</x-app-layout>
