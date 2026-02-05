<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Manager Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">
    <div class="flex min-h-screen">

        <!-- SIDEBAR -->
        <aside class="w-64 bg-gray-900 text-white">
            <div class="p-4 text-lg font-bold border-b border-gray-700">
                🛒 Manager Panel
            </div>

            <nav class="p-4 space-y-2">
                <a href="{{ route('manager.dashboard') }}" class="block px-3 py-2 rounded hover:bg-gray-700">
                    Dashboard
                </a>

                {{--
                <li>
                <a href="{{ route('manager.users.index') }}">Kelola User</a>
                </li>
                --}}


                <a href="#" class="block px-3 py-2 rounded hover:bg-gray-700">Kelola Diskon</a>
                <a href="#" class="block px-3 py-2 rounded hover:bg-gray-700">Kelola Barang</a>
                <a href="#" class="block px-3 py-2 rounded hover:bg-gray-700">Supplier</a>
                <a href="#" class="block px-3 py-2 rounded hover:bg-gray-700">Pembelian</a>
                <a href="#" class="block px-3 py-2 rounded hover:bg-gray-700">Penjualan</a>
                <a href="#" class="block px-3 py-2 rounded hover:bg-gray-700">Kelola Transaksi</a>
            </nav>
        </aside>

        <!-- CONTENT -->
        <main class="flex-1 p-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-xl font-semibold">@yield('title')</h1>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="text-sm text-red-600 hover:underline">Logout</button>
                </form>
            </div>

            @yield('content')
        </main>

    </div>
</body>

</html>