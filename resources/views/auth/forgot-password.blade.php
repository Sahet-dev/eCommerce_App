<x-app-layout>
    <div class="w-[400px] mx-auto p-6 my-16">
        <h2 class="text-2xl font-semibold text-center mb-5">
            Enter your Email to reset password
        </h2>

        <p class="text-center text-gray-500 mb-6">
            or
            <a href="{{ route('login') }}" class="text-purple-600 hover:text-purple-500">
                login with existing account
            </a>
        </p>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div class="mb-3">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" type="email"
                              name="email" class="border-gray-300 focus:border-purple-500 focus:outline-none focus:ring-purple-500
                              rounded-md w-full" placeholder="Your email address" :value="old('email')" required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <button class="btn-primary bg-emerald-500 hover:bg-emerald-600 active:bg-emerald-700 w-full">
                {{ __('Email Password Reset Link') }}
            </button>
        </form>
    </div>

</x-app-layout>
