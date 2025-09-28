<!-- NOTE: Plantilla predeterminada sobre el diseño de la web-->
<!-- NOTE: layouts.web-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="icon" href="{{ asset('costManager.png')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>CostManager - @yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @include('includes.alerts')
</head>
<body>
    @include('includes.header')
    @include('includes.delete')
    <main>
        <div class="container">
            <div class="container-content">
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

                <!--Modal-->
                @include('includes.filter')
            </div>
        </div>
    </main>
    @include('includes.footer')
</body>
</html>
