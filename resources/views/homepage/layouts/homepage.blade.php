<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Hotel Luce')</title>

    <link rel="stylesheet" href="{{ asset('css/layout/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/layout/menus.css') }}">

    <link rel="stylesheet" href="{{ asset('css/components/titles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/forms.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/buttons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/cards.css') }}">

    @stack('styles')
</head>

<body class="homepage-body">


   <header class="header">
    <h2 class="title1">Hotel Luce ★★★</h2>
    <img 
    class="hotel-image"
    src="{{ asset('storage/images/photo-1517840901100-8179e982acb7.avif') }}"
    alt="Main photo Hotel">
    </header>

    <nav class="menu">
        @include('homepage.partials.menu')
    </nav>

    <main class="main">
        @yield('content')
    </main>

    <footer class="footer">
        <div class="footer-item">
            <span class="info">Telefono:</span> +39 34644544544544
        </div>
        <div class="footer-item">
            <span class="info">Email:</span> hotelluce@example.com
        </div>
        <div class="footer-item">
            <span class="info">Facebook:</span> www.Facebook.example
        </div>
    </footer>


</body>
</html>
