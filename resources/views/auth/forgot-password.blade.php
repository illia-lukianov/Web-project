<x-guest-layout>
    <h2>Forgot Password?</h2>
    <p class="subtitle">No problem. Just let us know your email address</p>

    <div class="alert alert-info mb-4" role="alert">
        We'll send you a password reset link via email.
    </div>

    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="form-group">
            <label for="email" class="form-label">Email Address</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', 'test@example.com') }}" placeholder="test@example.com" required autofocus />
            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <button type="submit" class="btn btn-primary">Send Reset Link</button>

        <div class="text-center mt-3">
            <p class="mb-0"><a href="{{ route('login') }}">Back to login</a></p>
        </div>
    </form>
</x-guest-layout>
