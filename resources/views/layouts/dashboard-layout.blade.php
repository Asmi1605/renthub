<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'RentHub') }} Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js']) <!-- if using Vite -->
    @stack('styles')
</head>

<body class="bg-gray-100 font-sans antialiased">

    <div class="flex h-screen">

        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-md hidden md:block">
            <div class="h-16 flex items-center justify-center text-2xl font-bold text-indigo-600">
                RentHub
            </div>
            <nav class="mt-6">
                <x-sidebar />
            </nav>
        </aside>

        <!-- Mobile sidebar toggle -->
        <div class="md:hidden bg-white shadow flex justify-between items-center px-4 h-16">
            <div class="text-xl font-bold text-indigo-600">RentHub</div>
            <button id="mobile-menu-button" class="text-gray-600 focus:outline-none">
                ☰
            </button>
        </div>

        <!-- Mobile Sidebar -->
        <div id="mobile-sidebar" class="fixed inset-y-0 left-0 w-64 bg-white shadow transform -translate-x-full transition-transform duration-300 md:hidden">
            <div class="h-16 flex items-center justify-center text-2xl font-bold text-indigo-600">
                RentHub
            </div>
            <nav class="mt-6">
                <x-sidebar />
            </nav>
        </div>

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto p-6">
            @yield('content')  <!-- Correctly yield content here -->
        </main>
    </div>

    <script>
        const btn = document.getElementById('mobile-menu-button');
        const sidebar = document.getElementById('mobile-sidebar');

        btn.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
        });
    </script>
@stack('scripts')

</body>
</html>
