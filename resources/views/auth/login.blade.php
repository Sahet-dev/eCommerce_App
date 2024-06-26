<x-app-layout>


    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form action="{{ route('login') }}" method="POST" class="w-[400px] mx-auto p-6 my-16">
        @csrf
        <h2 class="text-2xl font-semibold text-center mb-5">Login to your account</h2>
        <p class="text-center text-gray-500 mb-6">
            or
            <a href="{{ route('register') }}" class="text-sm text-purple-700 hover:text-purple-600">create new account</a>
        </p>

        <x-input-error :messages="$errors->get('email')" class="mt-2" />
        <div class="mb-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
                          class="border-gray-300 focus:border-purple-500 focus:outline-none focus:ring-purple-500 rounded-md w-full" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mb-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full"
                          type="password" name="password" required autocomplete="current-password"
                          class="border-gray-300 focus:border-purple-500 focus:outline-none focus:ring-purple-500 rounded-md w-full" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex justify-between items-center mb-5">
            <div class="flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-purple-500 focus:ring-purple-500 mr-3" name="remember">
                <label for="remember_me" class="text-sm text-gray-600">{{ __('Remember Me') }}</label>
            </div>
            @if (Route::has('password.request'))
                <a class="underline text-sm text-purple-700 hover:text-purple-600" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>

        <x-primary-button class="w-full items-center bg-emerald-500 hover:bg-emerald-600 active:bg-emerald-700 text-center">
            {{ __('Log in') }}
        </x-primary-button>
    </form>











    <!-- Session Status -->

</x-app-layout>
