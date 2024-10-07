{{-- <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autofocus autocomplete="username" />
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
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}
<x-guest-layout>
    {{-- <x-auth-session-status class="mb-4" :status="session('status')" /> --}}

    <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
        <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
            Masuk ke akun Anda
        </h1>
        <form class="space-y-4 md:space-y-6" method="POST" action="{{ route('login') }}">
            @csrf
            <div>
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email Anda</label>
                <input type="email" name="email" value="{{ old('email') }}" id="email"
                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                    placeholder="name@company.com" required="">
                <x-input-error :messages="$errors->get('email')" class="mt-2" />

            </div>
            <div>
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password Anda</label>
                <input type="password" name="password" id="password" placeholder="••••••••"
                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                    required="">
                <x-input-error :messages="$errors->get('password')" class="mt-2" />

            </div>
            <div class="flex items-center justify-between">
                <div class="flex items-start">
                    <div class="flex items-center h-5">
                        <input id="remember" aria-describedby="remember" type="checkbox"
                            class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300"
                            required="" checked>
                    </div>
                    <div class="ml-3 text-sm">
                        <label for="remember" class="text-gray-500 cursor-pointer">Ingatkan saya</label>
                    </div>
                </div>
                {{-- <a href="#" class="text-sm font-medium text-primary-600 hover:underline">Lupa password?</a> --}}
            </div>
            <x-primary-button class="ms-3">
                {{ __('Masuk') }}
            </x-primary-button>
            <p class="text-sm font-light text-gray-500">
                Belum memiliki akun? <a href="{{ route('register') }}"
                    class="font-medium text-primary-600 hover:underline">Daftar</a>
            </p>
        </form>
    </div>
</x-guest-layout>
