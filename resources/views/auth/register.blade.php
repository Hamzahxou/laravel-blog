{{-- <x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Username -->
        <div class="mt-4">
            <x-input-label for="username" :value="__('Username')" />
            <x-text-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')"
                required autofocus autocomplete="username" oninput="checkUsername(this.value)" />
            <x-input-error :messages="$errors->get('username')" class="mt-2" />
            <small id="view_alert"></small>
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required autocomplete="email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4" id="register">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}


<x-guest-layout>
    {{-- <x-auth-session-status class="mb-4" :status="session('status')" /> --}}

    <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
        <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
            Buat akun baru
        </h1>
        <form class="space-y-4 md:space-y-6" method="POST" action="{{ route('login') }}">
            @csrf
            <div>
                <label for="username" class="block mb-2 text-sm font-medium text-gray-900">Username Anda</label>
                <input type="text" name="username" value="{{ old('username') }}" id="username"
                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                    placeholder="" required="" oninput="checkUsername(this.value)" autofocus>
                <x-input-error :messages="$errors->get('username')" class="mt-2" />
                <small id="view_alert"></small>
            </div>
            <div>
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Nama Anda</label>
                <input type="text" name="name" value="{{ old('name') }}" id="name"
                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                    placeholder="" required="">
                <x-input-error :messages="$errors->get('name')" class="mt-2" />

            </div>
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
            <div>
                <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900">Confirmasi
                    Password
                    Anda</label>
                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="••••••••"
                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                    required="" autocomplete="new-password">
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />

            </div>
            <x-primary-button class="ms-3">
                {{ __('Daftar') }}
            </x-primary-button>
            <p class="text-sm font-light text-gray-500">
                sudah memiliki akun? <a href="{{ route('login') }}"
                    class="font-medium text-primary-600 hover:underline">Masuk</a>
            </p>
        </form>
    </div>

    @push('scripts')
        <script>
            const usernames = @json($get_all_username);
            const users = usernames.map(user => user.username.toLowerCase());

            function checkUsername(value) {
                const view_alert = document.getElementById('view_alert')
                if (value.length > 0) {
                    if (users.includes(value.toLowerCase().trim())) {
                        view_alert.innerHTML =
                            "<i class='text-sm text-red-600 space-y-1'>Username Tidak Tersedia</i>"
                    } else {
                        view_alert.innerHTML = "<i class='text-sm text-green-600 space-y-1'>Username Tersedia</i>"
                    }

                } else {
                    view_alert.innerHTML = ""
                }
            }
        </script>
    @endpush
</x-guest-layout>
