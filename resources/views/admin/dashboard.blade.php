<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
        /* Simple navbar styling */
        nav {
            background: #333;
            padding: 10px;
        }
        nav a {
            color: #fff;
            margin-right: 15px;
            text-decoration: none;
        }
        nav a:hover {
            text-decoration: underline;
        }
        .container {
            padding: 20px;
        }
    </style>
</head>
<body>

<nav>
    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
    <a href="{{ route('tenures.index') }}">Months</a>
    <a href="{{ route('admin.logout') }}">Logout</a>
</nav>

<div class="container">
    @yield('content')
</div>

</body>
</html>