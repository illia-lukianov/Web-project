<x-guest-layout>
    <h2>Create Account</h2>
    <p class="subtitle">Join us today</p>

    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="form-group">
            <label for="name" class="form-label">Full Name</label>
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', 'John Doe') }}" placeholder="John Doe" required autofocus />
            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="form-group">
            <label for="email" class="form-label">Email Address</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', 'john@example.com') }}" placeholder="john@example.com" required />
            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="form-group">
            <label for="password" class="form-label">Password</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="password123" placeholder="Enter password" required />
            @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="form-group">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input id="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" value="password123" placeholder="Confirm password" required />
            @error('password_confirmation')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <button type="submit" class="btn btn-primary">Sign Up</button>

        <div class="text-center mt-3">
            <p class="mb-0">Already have an account? <a href="{{ route('login') }}">Sign in</a></p>
        </div>
    </form>
</x-guest-layout>
