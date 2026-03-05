<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentication</title>
    <link href="{{ asset('css/auth.css') }}" rel="stylesheet">
</head>
<body>
    <nav class="navbar-top">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center">
                <a href="{{ route('index') }}" class="navbar-brand">Dev Blog</a>
                <div>
                    @auth
                        <span class="text-white me-3">{{ Auth::user()->name }}</span>
                        <a href="{{ route('profile.edit') }}" class="text-white me-3">Profile</a>
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-light">Sign Out</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-white me-3">Sign In</a>
                        <a href="{{ route('register') }}" class="text-white">Sign Up</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main>
        <div class="auth-form">
            {{ $slot }}
        </div>
    </main>

    <footer>
        <div class="container-fluid">
            <small>{{ data_get($site, 'site.footer.copyright', 'Copyright © ' . now()->year) }}</small>
        </div>
    </footer>
</body>
</html>
