<x-app-layout>
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900 flex">

        <!-- SIDEBAR -->
        <aside class="w-64 bg-gray-800 text-gray-100 hidden md:flex flex-col">
            <div class="h-16 flex items-center justify-center text-lg font-semibold border-b border-gray-700">
                Manager Panel
            </div>

            <nav class="flex-1 px-4 py-6 space-y-2">
                <a href="#"
                    class="block px-4 py-2 rounded bg-gray-700 text-white font-medium">
                    Dashboard
                </a>

                <a href="#"
                    class="block px-4 py-2 rounded hover:bg-gray-700 text-gray-300 hover:text-white">
                    Kelola User
                </a>

                <a href="#"
                    class="block px-4 py-2 rounded hover:bg-gray-700 text-gray-300 hover:text-white">
                    Kelola Barang
                </a>

                <a href="#"
                    class="block px-4 py-2 rounded hover:bg-gray-700 text-gray-300 hover:text-white">
                    Supplier
                </a>

                <a href="#"
                    class="block px-4 py-2 rounded hover:bg-gray-700 text-gray-300 hover:text-white">
                    Diskon
                </a>

                <a href="#"
                    class="block px-4 py-2 rounded hover:bg-gray-700 text-gray-300 hover:text-white">
                    Pembelian
                </a>

                <a href="#"
                    class="block px-4 py-2 rounded hover:bg-gray-700 text-gray-300 hover:text-white">
                    Penjualan
                </a>
            </nav>
        </aside>

        <!-- MAIN CONTENT -->
        <main class="flex-1 p-6">

            <!-- HEADER -->
            <div class="mb-6">
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200">
                    Dashboard Manager
                </h2>
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    Ringkasan sistem toko kelontongan
                </p>
            </div>

            <!-- WELCOME CARD -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                    👋 Selamat Datang
                </h3>
                <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                    Anda login sebagai <strong>Manager (Super Admin)</strong>.
                </p>
            </div>

            <!-- STATISTIK -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                    <p class="text-sm text-gray-500 dark:text-gray-400">Total User</p>
                    <h4 class="mt-2 text-2xl font-bold text-gray-900 dark:text-gray-100">
                        12
                    </h4>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                    <p class="text-sm text-gray-500 dark:text-gray-400">Total Barang</p>
                    <h4 class="mt-2 text-2xl font-bold text-gray-900 dark:text-gray-100">
                        120
                    </h4>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                    <p class="text-sm text-gray-500 dark:text-gray-400">Transaksi Hari Ini</p>
                    <h4 class="mt-2 text-2xl font-bold text-gray-900 dark:text-gray-100">
                        34
                    </h4>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                    <p class="text-sm text-gray-500 dark:text-gray-400">Total Penjualan</p>
                    <h4 class="mt-2 text-2xl font-bold text-gray-900 dark:text-gray-100">
                        Rp 5.200.000
                    </h4>
                </div>

            </div>

        </main>
    </div>
</x-app-layout>