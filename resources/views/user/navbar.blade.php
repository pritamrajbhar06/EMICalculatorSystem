<nav class="navbar">
    <a href="{{ route('user.dashboard') }}" class="navbar-logo">User Dashboard</a>

    <ul class="navbar-links">
        <li><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
        <li><a href="{{ route('user.profile') }}">Profile</a></li>
        <li><a href="{{ route('user.logout') }}">Logout</a></li>
    </ul>
</nav>
