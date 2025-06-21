<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <link rel="stylesheet" href="{{ asset('css/admin/login.css') }}">
</head>
<body>

<div class="login-container">
    <h1>Admin Login</h1>

    <form method="POST" action="{{ route('admin.login') }}">
        @csrf
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>

        <button type="submit">Login</button>
    </form>

    @if ($errors->any())
        <div class="error-message">
            @foreach ($errors->all() as $error)
                <p style="margin: 0;">{{ $error }}</p>
            @endforeach
        </div>
    @endif
</div>

</body>
</html>
