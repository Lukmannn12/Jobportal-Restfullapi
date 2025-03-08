<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 flex">

    <!-- Sidebar & Overlay -->
    <div id="overlay" class="fixed inset-0 bg-black opacity-50 hidden md:hidden" onclick="toggleSidebar()"></div>

    <div id="sidebar" class="bg-gray-800 text-white w-64 h-screen fixed -left-64 transition-all duration-300 md:left-0">
        <div class="p-5 text-center border-b border-gray-700 flex justify-between items-center">
            <h2 class="text-xl font-bold">Admin Panel</h2>
            <button id="closeSidebar" class="md:hidden text-white text-md" onclick="toggleSidebar()">✖</button>
        </div>
        <nav class="mt-4">
            <a href="/dashboard" class="block py-2 px-5 hover:bg-gray-700 {{ request()->routeIs('dashboard') ? 'bg-gray-700 text-white' : '' }}">🏠 Dashboard</a>
            <a href="{{ route('company.index') }}"
                class="block py-2 px-5 hover:bg-gray-700 {{ request()->routeIs('company.*') ? 'bg-gray-700 text-white' : '' }}">
                🏢 Company
            </a>

            <a href="{{ route('jobs.index') }}"
                class="block py-2 px-5 hover:bg-gray-700 {{ request()->routeIs('jobs.*') ? 'bg-gray-700 text-white' : '' }}">
                💼 Job
            </a>

            <a href="{{ route('application.index') }}"
                class="block py-2 px-5 hover:bg-gray-700 {{ request()->routeIs('application.*') ? 'bg-gray-700 text-white' : '' }}">
                📄 Application
            </a>

            <form id="logoutForm" action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="block py-2 px-5 hover:bg-gray-700">
                    🚪 Logout
                </button>
            </form>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="flex-1 min-h-screen transition-all duration-300 md:ml-64">
        <!-- Navbar -->
        <nav class="bg-white shadow-md p-4 flex items-center justify-between">
            <button class="md:hidden text-gray-800 text-2xl" onclick="toggleSidebar()">☰</button>
            <div class="flex items-center space-x-4">
                <p class="text-gray-700">👋 {{ session('user')['name'] }}</p>

            </div>
        </nav>

        <div class="p-6">
            @yield('content')
        </div>
    </div>

    <script>
        function toggleSidebar() {
            let sidebar = document.getElementById("sidebar");
            let overlay = document.getElementById("overlay");

            if (sidebar.classList.contains("-left-64")) {
                sidebar.classList.remove("-left-64");
                sidebar.classList.add("left-0");
                overlay.classList.remove("hidden");
            } else {
                sidebar.classList.add("-left-64");
                sidebar.classList.remove("left-0");
                overlay.classList.add("hidden");
            }
        }
    </script>

</body>

</html>