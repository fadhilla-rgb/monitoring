<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitoring Tambak Bandeng</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-gray-100" x-data="{ open: true }">

    <div class="flex">
        
        <aside 
            class="fixed top-0 left-0 bg-white shadow-xl h-screen transition-all duration-300 z-50 overflow-hidden"
            :class="open ? 'w-64' : 'w-20'"
        >
            <div class="flex items-center justify-between px-4 py-6 border-b">
                <h1 class="text-xl font-bold text-blue-600" x-show="open" x-transition>BandengApp</h1>
                <button @click="open = !open" class="p-2 bg-gray-100 rounded-lg hover:bg-gray-200">
                    <span x-text="open ? '◀' : '▶'"></span>
                </button>
            </div>

            <nav class="mt-6 space-y-2">
                <a href="{{ route('home') }}" class="flex items-center gap-4 px-6 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition">
                    <span class="text-xl">🏠</span>
                    <span x-show="open" class="font-medium">Dashboard</span>
                </a>

                <a href="#" class="flex items-center gap-4 px-6 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition">
                    <span class="text-xl">⚙️</span>
                    <span x-show="open" class="font-medium">Threshold</span>
                </a>

                <a href="{{ route('keuangan.index') }}" class="flex items-center gap-4 px-6 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition">
                    <span class="text-xl">💵</span>
                    <span x-show="open" class="font-medium">Keuangan</span>
                </a>

                
            </nav>
        </aside>

        <main 
            class="flex-1 transition-all duration-300 min-h-screen"
            :class="open ? 'ml-64' : 'ml-20'"
        >
            <header class="bg-white shadow-sm py-4 px-8 flex justify-end items-center">
                <div class="flex items-center gap-3">
                    <span class="text-sm font-medium text-gray-600">Admin Tambak</span>
                    <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center text-white font-bold">A</div>
                </div>
            </header>

            <div class="p-4">
                @yield('content')
            </div>
        </main>

    </div>

    @stack('scripts')
</body>
</html>