<x-guest-layout>
    <h2>Welcome Back</h2>
    <p class="subtitle">Sign in to your account</p>

    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group">
            <label for="email" class="form-label">Email Address</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', 'test@example.com') }}" placeholder="test@example.com" required autofocus />
            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="form-group">
            <label for="password" class="form-label">Password</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="password123" placeholder="Enter your password" required />
            @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
            <label class="form-check-label" for="remember_me">Remember me</label>
        </div>

        <button type="submit" class="btn btn-primary">Sign In</button>

        <div class="text-center mt-3">
            <p class="mb-0">Don't have an account? <a href="{{ route('register') }}">Sign up</a></p>
            @if (Route::has('password.request'))
                <p class="mb-0 mt-2"><a href="{{ route('password.request') }}">Forgot password?</a></p>
            @endif
        </div>
    </form>
</x-guest-layout>
