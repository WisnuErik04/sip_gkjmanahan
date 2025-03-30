<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Form Permohonan')</title>
    @vite('resources/css/app.css')
    @livewireStyles
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        @yield('content')
    </div>
    @livewireScripts
</body>
</html>
