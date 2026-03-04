<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Monitoring</title>

    @vite('resources/css/app.css')

    <!-- Alpine -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body x-data="{ open: true }" class="bg-gray-100">

    {{-- Sidebar (fixed) --}}
    @include('sidebar')

    {{-- Konten kanan --}}
    <main
        class="p-8 transition-all duration-300"
        :class="open ? 'ml-64' : 'ml-16'"
    >
        @yield('content')
    </main>

</body>
</html>
