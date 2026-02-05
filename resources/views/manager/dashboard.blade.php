<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Dashboard Manager
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100 dark:bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- WELCOME -->
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                        👋 Selamat Datang, Manager
                    </h3>
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                        Anda memiliki akses penuh untuk mengelola sistem toko kelontongan.
                    </p>
                </div>
            </div>

            <!-- MENU GRID -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <!-- USER -->
                <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
                    <h4 class="font-semibold text-gray-900 dark:text-gray-100">
                        👤 Kelola User
                    </h4>
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                        Manajemen akun kasir dan supervisor.
                    </p>
                </div>

                <!-- BARANG -->
                <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
                    <h4 class="font-semibold text-gray-900 dark:text-gray-100">
                        📦 Kelola Barang
                    </h4>
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                        Tambah, ubah, dan hapus data barang.
                    </p>
                </div>

                <!-- SUPPLIER -->
                <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
                    <h4 class="font-semibold text-gray-900 dark:text-gray-100">
                        🚚 Supplier
                    </h4>
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                        Kelola data supplier toko.
                    </p>
                </div>

                <!-- DISKON -->
                <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
                    <h4 class="font-semibold text-gray-900 dark:text-gray-100">
                        🏷️ Diskon
                    </h4>
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                        Atur diskon dan promo.
                    </p>
                </div>

                <!-- PEMBELIAN -->
                <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
                    <h4 class="font-semibold text-gray-900 dark:text-gray-100">
                        🧾 Pembelian
                    </h4>
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                        Catat transaksi pembelian barang.
                    </p>
                </div>

                <!-- PENJUALAN -->
                <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
                    <h4 class="font-semibold text-gray-900 dark:text-gray-100">
                        💰 Penjualan
                    </h4>
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                        Monitor transaksi penjualan.
                    </p>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>