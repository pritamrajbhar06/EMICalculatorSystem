<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link rel="stylesheet" href="{{ asset('css/user/register.css') }}">
</head>
<body>


<div class="login-container"> <!-- use same container class as login for same styling -->
    <h1>User Registration</h1>

    <form method="POST" action="{{ route('user.register.post') }}">
        @csrf

        <label for="name">Full Name:</label>
        <input type="text" id="name" name="name"  value="{{ old('name') }}">
        @error('name')
            <div class="error-message"><p style="margin: 0;">{{ $message }}</p></div>
        @enderror

        <label for="email">Email Address:</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}">
        @error('email')
            <div class="error-message"><p style="margin: 0;">{{ $message }}</p></div>
        @enderror

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" value="{{ old('password') }}">
        @error('password')
            <div class="error-message"><p style="margin: 0;">{{ $message }}</p></div>
        @enderror

        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone" value="{{ old('phone') }}">
        @error('phone')
            <div class="error-message"><p style="margin: 0;">{{ $message }}</p></div>
        @enderror

        <button type="submit">Register</button>

        <p style="color: white">Already have an account? <a href="{{ route('user.form') }}" style="color: rgb(131, 167, 201)">Login here</a></p>
    </form>

    @if (session('error'))
        <div class="error-message">
            <p style="margin: 0;">{{ session('error') }}</p>
        </div>
    @endif
</div>

</body>
</html>
