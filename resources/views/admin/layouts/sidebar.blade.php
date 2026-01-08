<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CMS Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="bg-gradient-to-b from-slate-800 to-slate-900 text-white w-64 flex flex-col shadow-2xl">
            
            <!-- Profile Section -->
            <div class="p-6 border-b border-slate-700">
                <div class="flex items-center gap-4">
                    <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Admin" 
                         alt="Admin Avatar" 
                         class="w-16 h-16 rounded-full bg-white">
                    <div class="flex-1 min-w-0">
                        <h3 class="font-semibold text-lg truncate">Admin Utama</h3>
                        <p class="text-sm text-slate-400 truncate">admin@cms.com</p>
                    </div>
                </div>
            </div>

            <!-- Menu Section -->
            <nav class="flex-1 p-4">
                <ul class="space-y-2">
                    <!-- Menu Tambah Produk -->
                    <li>
                        <a href="{{ route('admin.products.create') }}" 
                           class="flex items-center gap-4 px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.products.create') ? 'bg-blue-600 text-white shadow-lg' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }}">
                            <i class="fas fa-box text-xl"></i>
                            <span class="font-medium">Tambah Produk</span>
                        </a>
                    </li>

                    <!-- Menu Riwayat Penjualan -->
                    <li>
                        {{-- <a href="{{ route('admin.sales.history') }}" 
                           class="flex items-center gap-4 px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.sales.history') ? 'bg-blue-600 text-white shadow-lg' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }}"> --}}
                            <i class="fas fa-history text-xl"></i>
                            <span class="font-medium">Riwayat Penjualan</span>
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- Footer -->
            <div class="p-4 border-t border-slate-700">
                <p class="text-xs text-slate-500 text-center">CMS Dashboard v1.0</p>
            </div>
        </div>

        <!-- Main Content Area -->
        <div class="flex-1 overflow-auto">
            @yield('content')
        </div>
    </div>
</body>
</html>