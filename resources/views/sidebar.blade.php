<!-- Sidebar -->
<div 
    class="fixed top-0 left-0 bg-white shadow-xl h-screen transition-all duration-300 z-50"
    :class="open ? 'w-64' : 'w-16'"
>

    <!-- Logo & Toggle -->
    <div class="flex items-center justify-between px-4 py-4">
        <h1 class="text-xl font-bold" x-show="open">My App</h1>

        <button 
            @click="open = !open"
            class="p-2 bg-gray-200 rounded hover:bg-gray-300"
        >
            ☰
        </button>
    </div>

    <!-- Menu -->
    <nav class="mt-4">
        <a href="#"
            class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-200">
            <span>🏠</span>
            <span x-show="open">Dashboard</span>
        </a>

        <a href="/home"
            class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-200">
            <span>📊</span>
            <span x-show="open">Monitoring</span>
        </a>
        <a href="#"
            class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-200">
            <span>⚙️</span>
            <span x-show="open">Treshold</span>
        </a>
        <a href="{{ route('keuangan.index') }}"
            class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-200">
            <span>💵</span>
            <span x-show="open">Keuangan</span>
        </a>

        
    </nav>
</div>

