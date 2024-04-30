<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Link CSS -->
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body>
    <div class="container">
        <!-- Navbar -->
        <nav class="navbar">
            <div class="navbar-brand">Dashboard</div>
            <ul class="navbar-nav">
                <li class="nav-item">
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
                </form>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link">Logout</a>
                </li>
            </ul>
        </nav>

        <!-- Main Content -->
        <div class="content">
            <p>You're log in</p>
        </div>
    </div>
</body>
</html>