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

<body class="bg-gray-100">

    @include('layouts.navbar')

    <main class="container mx-auto p-6">
        @yield('content')
    </main>

    <!-- JavaScript -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const openMenu = document.getElementById("openMenu");
            const closeMenu = document.getElementById("closeMenu");
            const mobileMenu = document.getElementById("mobileMenu");
            const backdrop = document.getElementById("backdrop");

            // Buka menu saat tombol burger diklik
            openMenu.addEventListener("click", function() {
                mobileMenu.classList.remove("hidden");
            });

            // Tutup menu saat tombol close diklik
            closeMenu.addEventListener("click", function() {
                mobileMenu.classList.add("hidden");
            });

            // Tutup menu saat backdrop diklik
            backdrop.addEventListener("click", function() {
                mobileMenu.classList.add("hidden");
            });
        });
    </script>

</body>
</html>