<!-- NOTE: Plantilla predeterminada sobre el diseño de la web-->
<!-- NOTE: layouts.web-->
<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <link rel="icon" href="{{ asset('costManager.png')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>CostManager - @yield('title')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @include('includes.alerts')
</head>
<body class="flex flex-col min-h-full">
    <!--Modales-->
    @include('includes.filter')
    @include('includes.delete')

    <x-header />

    <main class="flex-grow p-6">
        <!--Balances-->
        @yield('content-main')
        <!--Categories-->
        @yield('content-category')
        @yield('content-create-category')

        <!--Expenses-->
        @yield('content-expense')
        @yield('content-create-expense')

        <!--Revenues-->
        @yield('content-revenue')
        @yield('content-create-revenue')

        <!--Records-->
        @yield('content-record')
    </main>

    <x-footer />
</body>
</html>
