<x-guest-layout>
    <h2>Verify Your Email</h2>
    <p class="subtitle">We've sent you a verification link</p>

    <div class="alert alert-info mb-4" role="alert">
        Thanks for signing up! Please click the link in the email we sent you to verify your account.
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="alert alert-success mb-4" role="alert">
            A new verification link has been sent to your email address.
        </div>
    @endif

    <form method="POST" action="{{ route('verification.send') }}" class="mb-3">
        @csrf
        <button type="submit" class="btn btn-primary w-100">Resend Verification Email</button>
    </form>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="btn btn-link btn-sm w-100">Sign Out</button>
    </form>
</x-guest-layout>
