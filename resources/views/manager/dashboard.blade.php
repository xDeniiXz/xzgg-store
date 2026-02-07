<x-app-layout>
    <div class="min-h-screen bg-gray-50 dark:bg-gray-950 flex" x-data="{ sidebarOpen: true }">

        <!-- SIDEBAR -->
        <aside class="w-72 bg-slate-900 text-slate-100 flex flex-col border-r border-slate-800 fixed inset-y-0 left-0 h-screen overflow-y-auto z-40 transition-transform duration-300 ease-in-out"
            :class="{ '-translate-x-full': !sidebarOpen }">
            <!-- Logo / Brand -->
            <div class="h-16 flex items-center px-6 border-b border-slate-800 bg-gradient-to-r from-slate-900 to-slate-800">
                <svg class="h-8 w-8 text-indigo-500 mr-3" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                <div>
                    <p class="font-bold text-white text-lg">XZGG Store</p>
                    <p class="text-xs text-slate-400">Manager Panel</p>
                </div>
            </div>

            <!-- Navigation Menu -->
            <nav class="flex-1 px-3 py-8 space-y-2 overflow-y-auto">
                <!-- Dashboard -->
                <a href="{{ route('manager.dashboard') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium {{ request()->routeIs('manager.dashboard') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/50' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }} transition-all duration-200">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span>Dashboard</span>
                </a>

                <!-- Divider -->
                <div class="my-4 border-t border-slate-700"></div>

                <!-- Master Data Section -->
                <p class="px-4 py-2 text-xs font-semibold uppercase text-slate-500 tracking-wide">Master Data</p>

                <!-- Kelola User -->
                <a href="{{ route('manager.users.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm {{ request()->routeIs('manager.users.*') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/50' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }} transition-all duration-200">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <span>Kelola User</span>
                </a>

                <!-- Kelola Barang -->
                <a href="{{ route('manager.barang.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm {{ request()->routeIs('manager.barang.*') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/50' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }} transition-all duration-200">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                    <span>Kelola Barang</span>
                </a>

                <!-- Kelola Diskon -->
                <a href="{{ route('manager.diskon.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm {{ request()->routeIs('manager.diskon.*') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/50' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }} transition-all duration-200">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                    </svg>
                    <span>Kelola Diskon</span>
                </a>

                <!-- Divider -->
                <div class="my-4 border-t border-slate-700"></div>

                <!-- Transactions Section -->
                <p class="px-4 py-2 text-xs font-semibold uppercase text-slate-500 tracking-wide">Transaksi</p>

                <!-- Transaksi Pembelian -->
                <a href="{{ route('manager.pembelian.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm {{ request()->routeIs('manager.pembelian.*') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/50' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }} transition-all duration-200">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <span>Pembelian</span>
                </a>

                <!-- Transaksi Penjualan -->
                <a href="{{ route('manager.penjualan.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm {{ request()->routeIs('manager.penjualan.*') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/50' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }} transition-all duration-200">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <span>Penjualan</span>
                </a>

                <!-- Divider -->
                <div class="my-4 border-t border-slate-700"></div>

                <!-- Reports Section -->
                <p class="px-4 py-2 text-xs font-semibold uppercase text-slate-500 tracking-wide">Laporan</p>

                <!-- Laporan Transaksi -->
                <a href="{{ route('manager.laporan.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm {{ request()->routeIs('manager.laporan.*') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/50' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }} transition-all duration-200">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <span>Laporan Transaksi</span>
                </a>
            </nav>

            <!-- Quick Actions -->
            <div class="px-4 py-6 border-t border-slate-700">
                <p class="px-2 text-xs font-semibold uppercase text-slate-500 tracking-wide mb-4">Quick Actions</p>
                <div class="grid grid-cols-2 gap-2">
                    <a href="{{ route('manager.users.create') }}" class="flex flex-col items-center justify-center p-3 bg-gradient-to-br from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 rounded-lg transition-all duration-200 group shadow-sm hover:shadow-md">
                        <svg class="w-6 h-6 text-white mb-1 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                        <span class="text-xs font-semibold text-white text-center">Tambah User</span>
                    </a>

                    <a href="{{ route('manager.barang.create') }}" class="flex flex-col items-center justify-center p-3 bg-gradient-to-br from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 rounded-lg transition-all duration-200 group shadow-sm hover:shadow-md">
                        <svg class="w-6 h-6 text-white mb-1 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        <span class="text-xs font-semibold text-white text-center">Tambah Barang</span>
                    </a>

                    <a href="{{ route('manager.diskon.create') }}" class="flex flex-col items-center justify-center p-3 bg-gradient-to-br from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 rounded-lg transition-all duration-200 group shadow-sm hover:shadow-md">
                        <svg class="w-6 h-6 text-white mb-1 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                        <span class="text-xs font-semibold text-white text-center">Buat Diskon</span>
                    </a>

                    <a href="{{ route('manager.pembelian.create') }}" class="flex flex-col items-center justify-center p-3 bg-gradient-to-br from-yellow-600 to-yellow-700 hover:from-yellow-700 hover:to-yellow-800 rounded-lg transition-all duration-200 group shadow-sm hover:shadow-md">
                        <svg class="w-6 h-6 text-white mb-1 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <span class="text-xs font-semibold text-white text-center">Input Pembelian</span>
                    </a>
                </div>
            </div>

            <!-- User Info & Logout -->
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

        <!-- MAIN CONTENT -->
        <main class="flex-1 ml-72 transition-all duration-300 ease-in-out" :class="{ 'ml-0': !sidebarOpen }">
            <!-- Overlay for mobile -->
            <div class="fixed inset-0 bg-black/50 z-30 transition-opacity duration-300"
                @click="sidebarOpen = false"
                x-show="sidebarOpen"
                x-transition:enter="ease-in-out duration-300"
                x-transition:leave="ease-in-out duration-300"
                style="display: none;">
            </div>

            <!-- TOP HEADER -->
            <header class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 sticky top-0 z-30">
                <div class="px-6 lg:px-8 py-4 flex justify-between items-center">
                    <div class="flex items-center gap-4">
                        <!-- Sidebar Toggle Button -->
                        <button @click="sidebarOpen = !sidebarOpen" class="p-2 text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>

                        <div>
                            <h2 class="text-3xl font-bold text-gray-900 dark:text-white">
                                Dashboard Manager
                            </h2>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                                Selamat datang kembali, <span class="font-semibold">{{ Auth::user()->name }}</span>!
                            </p>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="flex items-center gap-2">
                        <!-- Notifications -->
                        <button class="p-2.5 text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors relative group">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                            <span class="absolute top-1 right-1 w-3 h-3 bg-red-500 rounded-full"></span>
                        </button>

                        <!-- Profile -->
                        <a href="{{ route('profile.edit') }}" class="p-2.5 text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </a>
                    </div>
                </div>
            </header>

            <!-- DASHBOARD CONTENT -->
            <div class="p-6 lg:p-8 space-y-6 bg-gray-50 dark:bg-gray-950 min-h-screen">
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Total User -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm hover:shadow-md transition-shadow duration-200 p-6 border border-gray-200 dark:border-gray-700">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total User</p>
                                <h4 class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">12</h4>
                                <p class="mt-2 text-xs font-medium text-green-600 dark:text-green-400">
                                    <span class="inline-block mr-1">↑</span>+2 dari bulan lalu
                                </p>
                            </div>
                            <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/40 rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Total Barang -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm hover:shadow-md transition-shadow duration-200 p-6 border border-gray-200 dark:border-gray-700">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Barang</p>
                                <h4 class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">156</h4>
                                <p class="mt-2 text-xs font-medium text-orange-600 dark:text-orange-400">
                                    <span class="inline-block mr-1">⚠</span>23 stok rendah
                                </p>
                            </div>
                            <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900/40 rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Transaksi Hari Ini -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm hover:shadow-md transition-shadow duration-200 p-6 border border-gray-200 dark:border-gray-700">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Transaksi Hari Ini</p>
                                <h4 class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">47</h4>
                                <p class="mt-2 text-xs font-medium text-green-600 dark:text-green-400">
                                    <span class="inline-block mr-1">↑</span>+12% dari kemarin
                                </p>
                            </div>
                            <div class="w-12 h-12 bg-green-100 dark:bg-green-900/40 rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Total Penjualan -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm hover:shadow-md transition-shadow duration-200 p-6 border border-gray-200 dark:border-gray-700">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Penjualan Hari Ini</p>
                                <h4 class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">Rp 5,2M</h4>
                                <p class="mt-2 text-xs font-medium text-green-600 dark:text-green-400">
                                    <span class="inline-block mr-1">↑</span>+8% dari kemarin
                                </p>
                            </div>
                            <div class="w-12 h-12 bg-yellow-100 dark:bg-yellow-900/40 rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity / Chart -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Transaksi Terbaru -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
                        <div class="p-6 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-700">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                                Transaksi Terbaru
                            </h3>
                        </div>
                        <div class="p-6 space-y-4">
                            <!-- Transaction Item -->
                            <div class="flex items-center justify-between pb-4 border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/50 -mx-2 px-2 py-2 rounded transition-colors">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-green-100 dark:bg-green-900/40 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-gray-900 dark:text-white">Penjualan #001234</p>
                                        <p class="text-xs text-gray-600 dark:text-gray-400">Kasir: Budi - 2 jam lalu</p>
                                    </div>
                                </div>
                                <span class="text-sm font-bold text-green-600 dark:text-green-400">+Rp 125.000</span>
                            </div>

                            <div class="flex items-center justify-between pb-4 border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/50 -mx-2 px-2 py-2 rounded transition-colors">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900/40 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-gray-900 dark:text-white">Pembelian #002456</p>
                                        <p class="text-xs text-gray-600 dark:text-gray-400">PT Maju Jaya - 3 jam lalu</p>
                                    </div>
                                </div>
                                <span class="text-sm font-bold text-blue-600 dark:text-blue-400">Rp 2.500.000</span>
                            </div>

                            <div class="flex items-center justify-between pb-4 hover:bg-gray-50 dark:hover:bg-gray-700/50 -mx-2 px-2 py-2 rounded transition-colors">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-green-100 dark:bg-green-900/40 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-gray-900 dark:text-white">Penjualan #001235</p>
                                        <p class="text-xs text-gray-600 dark:text-gray-400">Kasir: Ani - 4 jam lalu</p>
                                    </div>
                                </div>
                                <span class="text-sm font-bold text-green-600 dark:text-green-400">+Rp 87.500</span>
                            </div>

                            <a href="{{ route('manager.laporan.index') }}" class="mt-4 block text-center py-2 text-sm font-semibold text-indigo-600 dark:text-indigo-400 hover:text-indigo-700 dark:hover:text-indigo-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors">
                                Lihat Semua Transaksi →
                            </a>
                        </div>
                    </div>

                    <!-- Stok Menipis -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
                        <div class="p-6 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-700">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                                Stok Menipis
                            </h3>
                        </div>
                        <div class="p-6 space-y-4">
                            <!-- Stock Item -->
                            <div class="flex items-center justify-between pb-4 border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/50 -mx-2 px-2 py-2 rounded transition-colors">
                                <div>
                                    <p class="text-sm font-semibold text-gray-900 dark:text-white">Indomie Goreng</p>
                                    <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Kategori: Makanan</p>
                                </div>
                                <span class="px-3 py-1 text-xs font-bold text-red-600 bg-red-100 dark:bg-red-900/40 dark:text-red-400 rounded-full whitespace-nowrap ml-2">
                                    Stok: 8
                                </span>
                            </div>

                            <div class="flex items-center justify-between pb-4 border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/50 -mx-2 px-2 py-2 rounded transition-colors">
                                <div>
                                    <p class="text-sm font-semibold text-gray-900 dark:text-white">Aqua 600ml</p>
                                    <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Kategori: Minuman</p>
                                </div>
                                <span class="px-3 py-1 text-xs font-bold text-yellow-600 bg-yellow-100 dark:bg-yellow-900/40 dark:text-yellow-400 rounded-full whitespace-nowrap ml-2">
                                    Stok: 15
                                </span>
                            </div>

                            <div class="flex items-center justify-between pb-4 hover:bg-gray-50 dark:hover:bg-gray-700/50 -mx-2 px-2 py-2 rounded transition-colors">
                                <div>
                                    <p class="text-sm font-semibold text-gray-900 dark:text-white">Teh Pucuk 350ml</p>
                                    <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Kategori: Minuman</p>
                                </div>
                                <span class="px-3 py-1 text-xs font-bold text-red-600 bg-red-100 dark:bg-red-900/40 dark:text-red-400 rounded-full whitespace-nowrap ml-2">
                                    Stok: 5
                                </span>
                            </div>

                            <a href="{{ route('manager.barang.index') }}" class="mt-4 block text-center py-2 text-sm font-semibold text-indigo-600 dark:text-indigo-400 hover:text-indigo-700 dark:hover:text-indigo-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors">
                                Lihat Semua Barang →
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </main>

    </div>
</x-app-layout>