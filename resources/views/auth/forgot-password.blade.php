<x-guest-layout>
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <h2 class="mb-4 text-center">Forgot Password</h2>

            <x-auth-session-status class="mb-3" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="mb-3">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus />
                    <x-input-error :messages="$errors->get('email')" class="text-danger mt-1" />
                </div>

                <x-primary-button class="btn btn-primary w-100">{{ __('Send Password Reset Link') }}</x-primary-button>
            </form>
        </div>
    </div>
</x-guest-layout>
