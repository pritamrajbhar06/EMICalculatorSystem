<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>
    <link rel="stylesheet" href="{{ asset('css/admin/navbar.css') }}">
   @stack('styles')
   

</head>
<body>

    @include('admin.navbar')

    <div class="container">
        @yield('content')
    </div>

</body>
</html>
