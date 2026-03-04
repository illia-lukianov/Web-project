<x-guest-layout>
    <h2>Reset Password</h2>
    <p class="subtitle">Create a new password for your account</p>

    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('password.store') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div class="form-group">
            <label for="email" class="form-label">Email Address</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $request->email ?? 'test@example.com') }}" placeholder="test@example.com" required autofocus />
            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="form-group">
            <label for="password" class="form-label">New Password</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="newpass123" placeholder="Enter new password" required />
            @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="form-group">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input id="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" value="newpass123" placeholder="Confirm new password" required />
            @error('password_confirmation')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <button type="submit" class="btn btn-primary">Reset Password</button>
    </form>
</x-guest-layout>
