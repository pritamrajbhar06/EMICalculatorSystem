<!DOCTYPE html>
<html>
<head>
    <title>Choose Role</title>
    <style>
        body {
            background: #1e1e1e;
            color: #ddd;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .role-container {
            text-align: center;
            background: #2c2c2c;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 0 8px rgba(0,0,0,0.5);
        }
        .role-container h1 {
            margin-bottom: 30px;
            font-size: 24px;
        }
        .role-container a {
            display: block;
            padding: 12px 20px;
            margin: 10px 0;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            text-decoration: none;
            color: #fff;
        }
        .admin-btn {
            background: #007bff;
        }
        .user-btn {
            background: #28a745;
        }
    </style>
</head>
<body>

<div class="role-container">
    <h1>Who are you?🙋</h1>
    <a href="{{ route('admin.login') }}" class="admin-btn">Admin</a>
    <a href="{{ route('user.form') }}" class="user-btn">User</a>
</div>

</body>
</html>
