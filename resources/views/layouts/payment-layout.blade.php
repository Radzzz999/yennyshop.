<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Pembayaran - YennyShop')</title>

    {{-- Bootstrap & FontAwesome --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    {{-- Custom CSS --}}
    <link rel="stylesheet" href="{{ asset('css/payment.css') }}">

    @stack('styles')
    
</head>
<body>
    {{-- Floating Shapes --}}
    <div class="floating-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>

    {{-- JavaScript --}}
    <script src="{{ asset('js/payment.js') }}"></script>
    @stack('scripts')
</body>
</html>
