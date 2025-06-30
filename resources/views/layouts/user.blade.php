<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'User Panel')</title>
    <link rel="stylesheet" href="{{ asset('css/user/navbar.css') }}">
    @stack('styles')
</head>
<body>

    @include('user.navbar') <!-- This loads your navbar.blade.php -->

    <div class="container">
        @yield('content') <!-- Main content will be injected here -->
    </div>

    @stack('scripts')
</body>
</html>
