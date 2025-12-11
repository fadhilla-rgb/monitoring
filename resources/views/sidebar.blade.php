<!DOCTYPE html>
<html lang="en" x-data="{ open: true }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar Tailwind + Alpine</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
   @vite('resources/css/app.css')
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100 flex">

    <!-- Sidebar -->
    <div class="bg-white shadow-xl h-screen transition-all duration-300"
        :class="open ? 'w-64' : 'w-16'">

        <!-- Logo & Toggle Button -->
        <div class="flex items-center justify-between px-4 py-4">
            <h1 class="text-xl font-bold" x-show="open">My App</h1>

            <button @click="open = !open"
                class="p-2 bg-gray-200 rounded hover:bg-gray-300">
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
                <span x-show="open">Settings</span>
            </a>
        </nav>
    </div>

    <!-- Content -->
    <main class="flex-1 p-10">
        <h1 class="text-3xl font-bold mb-6">Dashboard</h1>

        <p class="text-gray-600">
            Ini adalah area konten menggunakan Tailwind CSS.
        </p>
    </main>

</body>
</html>
