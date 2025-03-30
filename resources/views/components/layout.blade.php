<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    {{-- <title>{{ $title ?? 'SIP' }}</title> --}}
  
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js" defer></script>
    <title>{{ $menu }} - {{ config('app.name') }}</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Readex+Pro:400,500,600,700&amp;subset=latin" />
    <link href="https://fonts.googleapis.com/css2?family=Figtree:ital,wght@0,300..900;1,300..900&amp;display=swap"
        rel="stylesheet" />
    {{-- <link rel="stylesheet" href="css/tailwind/tailwind.min.css"/> --}}
    @vite(['resources/css/app.css'])
    @livewireStyles
    @filepondScripts
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon.png') }}" />
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js" defer="defer"></script>
</head>

<body class="antialiased bg-body text-body font-body">
    <div>
        <x-navbar>{{ $menu }}</x-navbar> <!-- Include Navbar sebagai Komponen -->
        <main>
            {{ $slot }} <!-- Konten Utama -->
        </main>
        <x-footer /> <!-- Include Footer sebagai Komponen -->
    </div>

    @livewireScripts
</body>

</html>
