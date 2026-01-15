<x-guest-layout>
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5 text-center">
            <h2 class="mb-4">Verify Your Email Address</h2>

            @if (session('status') == 'verification-link-sent')
                <div class="alert alert-success">
                    {{ __('A new verification link has been sent to your email address.') }}
                </div>
            @endif

            <p>Before proceeding, please check your email for a verification link.</p>

            <form method="POST" action="{{ route('verification.send') }}" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-primary mb-2">Resend Verification Email</button>
            </form>

            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-secondary">Logout</button>
            </form>
        </div>
    </div>
</x-guest-layout>
