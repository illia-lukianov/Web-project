<div>
    <h5 class="card-title mb-2">{{ __('Update Password') }}</h5>
    <p class="text-muted small mb-4">{{ __('Ensure your account is using a long, random password to stay secure.') }}</p>

    <form method="post" action="{{ route('password.update') }}">
        @csrf
        @method('put')

        <div class="mb-3">
            <label for="update_password_current_password" class="form-label">{{ __('Current Password') }}</label>
            <input id="update_password_current_password" name="current_password" type="password" class="form-control @error('current_password', 'updatePassword') is-invalid @enderror" autocomplete="current-password" />
            @error('current_password', 'updatePassword')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label for="update_password_password" class="form-label">{{ __('New Password') }}</label>
            <input id="update_password_password" name="password" type="password" class="form-control @error('password', 'updatePassword') is-invalid @enderror" autocomplete="new-password" />
            @error('password', 'updatePassword')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label for="update_password_password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="form-control @error('password_confirmation', 'updatePassword') is-invalid @enderror" autocomplete="new-password" />
            @error('password_confirmation', 'updatePassword')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
        </div>

        <div class="d-flex gap-2 mt-4">
            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
            @if (session('status') === 'password-updated')
                <span class="text-success small ms-2 d-inline-block" id="password-saved">{{ __('Saved.') }}</span>
                <script>
                    setTimeout(() => {
                        const msg = document.getElementById('password-saved');
                        if(msg) msg.style.display = 'none';
                    }, 2000);
                </script>
            @endif
        </div>
    </form>
</div>
