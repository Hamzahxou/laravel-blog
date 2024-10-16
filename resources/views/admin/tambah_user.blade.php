<x-app-layout title="{{ __('Tambah User') }}">

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
                        <a href="{{ route('admin_users.index') }}"
                            class="mb-2 inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">{{ __('kembali') }}</a>
                        <form method="post" action="{{ route('admin_users.store') }}" class="space-y-6"
                            enctype="multipart/form-data" novalidate>
                            @csrf
                            <div>
                                <img class="mr-2 w-32 h-32 rounded-full" id="preview">
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
                                    :value="old('name')" required autofocus />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>
                            <div>
                                <x-input-label for="username" :value="__('Username')" />
                                <x-text-input id="username" name="username" type="text" class="mt-1 block w-full"
                                    :value="old('username')" oninput="checkUsername(this.value)" required autofocus />
                                <x-input-error class="mt-2" :messages="$errors->get('username')" />
                                <small id="view_alert"></small>
                            </div>
                            <div>
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                                    :value="old('email')" required autofocus />
                                <x-input-error class="mt-2" :messages="$errors->get('email')" />
                            </div>
                            <div>
                                <x-input-label for="password" :value="__('Password')" />
                                <x-text-input id="password" name="password" type="password" class="mt-1 block w-full"
                                    :value="old('password')" required autofocus />
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

        <script>
            const usernames = @json($get_all_username);
            const users = usernames.map(user => user.username.toLowerCase());

            function checkUsername(value) {

                const view_alert = document.getElementById('view_alert')
                if (value.length > 0) {
                    if (users.includes(value.toLowerCase().trim())) {
                        console.table(usernames)
                        console.log(value, users.includes(value.toLowerCase().trim()));
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
</x-app-layout>
