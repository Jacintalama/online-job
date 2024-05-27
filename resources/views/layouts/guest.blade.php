<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
  <!-- Favicons -->
  <link href="assets/img/gsc.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
<!-- Include Choices.js CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css">

<!-- Include Choices.js script -->
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
<!-- Include FontAwesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body>
        <div class="font-sans text-gray-900 antialiased">
            {{ $slot }}
        </div>

        @livewireScripts
        <script>
            document.querySelectorAll('.role').forEach(function(role) {
                role.addEventListener('click', function() {
                console.log('Role clicked:', role.getAttribute('data-role')); // Add this line
                document.querySelectorAll('.role').forEach(function(r) {
                r.classList.remove('active');
        });
        role.classList.add('active');
        document.getElementById('role').value = role.getAttribute('data-role');
             });
            });

        </script>
    </body>
</html>
