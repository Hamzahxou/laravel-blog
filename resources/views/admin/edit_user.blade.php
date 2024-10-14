<x-app-layout title="{{ __('Edit User') }}">

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah User
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-2xl">
                    <section>
                        @if ($errors->any())
                            <div class="flex p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
                                <svg class="flex-shrink-0 inline w-4 h-4 me-3 mt-[2px]" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                                </svg>
                                <span class="sr-only">Danger</span>
                                <div>
                                    <span class="font-medium">Ada masalah yang terjadi:</span>
                                    <ul class="mt-1.5 list-disc list-inside">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif

                        <a href="{{ route('admin_users.index') }}"
                            class="mb-2 inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">{{ __('kembali') }}</a>
                        <form method="post" action="{{ route('admin_users.update', $user->id) }}" class="space-y-6"
                            enctype="multipart/form-data" novalidate>
                            @csrf
                            @method('PUT')
                            <div>
                                @isset($user->avatar)
                                    <img class="mr-2 w-32 h-32 rounded-full" id="preview"
                                        src="{{ asset('storage/' . $user->avatar) }}">
                                @else
                                    <img class="mr-2 w-32 h-32 rounded-full" id="preview"
                                        src="{{ asset('storage/profile/default-profile.png') }}">
                                @endisset
                            </div>
                            <div>
                                <x-input-label for="gambar" :value="__('Avatar')" />
                                <x-text-input id="gambar" name="avatar" type="file"
                                    class="mt-1 p-2 block w-full border  border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none focus:border-2"
                                    accept="image/*" onchange="ImgPreview(this)" />
                                <x-input-error class="mt-2" :messages="$errors->get('avatar')" />
                            </div>
                            <div>
                                <x-input-label for="nama" :value="__('Nama')" />
                                <x-text-input id="nama" name="name" type="text" class="mt-1 block w-full"
                                    :value="old('name', $user->name)" required autofocus />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>
                            <div>
                                <x-input-label for="username" :value="__('Username')" />
                                <x-text-input id="username" name="username" type="text"
                                    class="mt-1 block w-full disabled:bg-slate-200" :value="old('username', $user->username)" disabled
                                    required />
                                <x-input-error class="mt-2" :messages="$errors->get('username')" />
                            </div>
                            <div>
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" name="email" type="email"
                                    class="mt-1 block w-full disabled:bg-slate-200" :value="old('email', $user->email)" disabled
                                    required />
                                <x-input-error class="mt-2" :messages="$errors->get('email')" />
                            </div>
                            <div>
                                <x-input-label for="password" :value="__('Password')" />
                                <x-text-input id="password" name="password" type="password" class="mt-1 block w-full"
                                    :value="old('password')" required />
                                <x-input-error class="mt-2" :messages="$errors->get('password')" />
                            </div>
                            <div>
                                <x-primary-button type="submit">
                                    {{ __('Simpan') }}
                                </x-primary-button>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function ImgPreview(e) {
                const blah = document.getElementById('preview')
                const [file] = e.files
                if (file) {
                    blah.src = URL.createObjectURL(file)
                }
            }
        </script>
    @endpush
</x-app-layout>
