<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                requimain-emphasis autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-main-emphasis shadow-sm focus:ring-main-emphasis/20"
                    name="remember">
                <span class="ms-2 text-sm text-main-contrast/50">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex flex-col md:flex-row items-center justify-end mt-4 gap-y-3">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-main-contrast/50 hover:text-main-emphasis/70 rounded-md focus:text-main-emphasis"
                    href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <a href="{{ route('register') }}"
                class="ms-3 inline-block px-5 py-1.5 text-main-contrast/70 hover:text-main-contrast border border-transparent hover:border-main-emphasis/20  rounded-md text-sm leading-normal">
                Registrati
            </a>

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
