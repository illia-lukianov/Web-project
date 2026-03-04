<x-guest-layout>
    <h2>Confirm Your Password</h2>
    <p class="subtitle">Please confirm your password to continue</p>

    <div class="alert alert-warning mb-4" role="alert">
        This is a secure area. Please confirm your password before continuing.
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

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required />
            @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <button type="submit" class="btn btn-primary">Confirm</button>
    </form>
</x-guest-layout>
