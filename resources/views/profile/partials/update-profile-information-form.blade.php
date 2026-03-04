<div>
    <h5 class="card-title mb-2">{{ __('Profile Information') }}</h5>
    <p class="text-muted small mb-4">{{ __("Update your account's profile information and email address.") }}</p>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}">
        @csrf
        @method('patch')

        <div class="mb-3">
            <label for="name" class="form-label">{{ __('Name') }}</label>
            <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name ?? 'John Doe') }}" placeholder="Full Name" required autofocus autocomplete="name" />
            @error('name')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">{{ __('Email') }}</label>
            <input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email ?? 'john@example.com') }}" placeholder="Email Address" required autocomplete="username" />
            @error('email')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2">
                    <p class="text-muted small mb-2">{{ __('Your email address is unverified.') }}</p>
                    <form id="send-verification" method="post" action="{{ route('verification.send') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-link btn-sm p-0 text-decoration-none">{{ __('Click here to re-send the verification email.') }}</button>
                    </form>

                    @if (session('status') === 'verification-link-sent')
                        <div class="alert alert-success small mt-2 mb-0">{{ __('A new verification link has been sent to your email address.') }}</div>
                    @endif
                </div>
            @endif
        </div>

        <div class="d-flex gap-2 mt-4">
            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
            @if (session('status') === 'profile-updated')
                <span class="text-success small ms-2 d-inline-block" id="saved-message">{{ __('Saved.') }}</span>
                <script>
                    setTimeout(() => {
                        const msg = document.getElementById('saved-message');
                        if(msg) msg.style.display = 'none';
                    }, 2000);
                </script>
            @endif
        </div>
    </form>
</div>
