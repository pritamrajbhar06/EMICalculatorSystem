<!DOCTYPE html>
<html>
<head>
    <title>User Login</title>
    <link rel="stylesheet" href="{{ asset('css/admin/login.css') }}">
</head>
<body>

<div class="login-container">
    <h1>User Login</h1>

    <form method="POST" action="{{ route('user.login') }}">
        @csrf
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>

        <button type="submit">Login</button>
        <p style="color: white">Don't have an account? <a href="{{ route('user.register') }}" style="color: rgb(131, 167, 201)">Register here</a></p>
    </form>

    @if (session('error'))
        <div class="error-message">
            <p style="margin: 0;">{{ session('error') }}</p>
        </div>
    @endif
</div>

</body>
</html>
