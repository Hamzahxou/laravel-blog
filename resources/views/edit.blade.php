<x-app-layout>

    @push('styles')
        <style>
            .tagify {
                width: 100%;
                max-width: 700px;
            }

            .tags-look .tagify__dropdown__item {
                display: inline-block;
                border-radius: 3px;
                padding: .3em .5em;
                border: 1px solid #CCC;
                background: #F3F3F3;
                margin: .2em;
                font-size: .85em;
                color: black;
                transition: 0s;
            }

            .tags-look .tagify__dropdown__item--active {
                color: black;
            }

            .tags-look .tagify__dropdown__item:hover {
                background: lightyellow;
                border-color: gold;
            }
        </style>

        <style>
            .trix ul {
                list-style-type: disc !important;
                padding-left: 2.5rem;
            }

            .trix ol {
                list-style-type: decimal !important;
                padding-left: 2.5rem;
            }
        </style>
    @endpush

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Perbarui Resep
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-2xl">
                    <section>
                        <a href="{{ route('dashboard') }}"
                            class="mb-2 inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">{{ __('kembali') }}</a>
                        <form method="post" action="{{ route('resep.update', $getResep->id) }}" class="space-y-6"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div>
                                <img src="{{ asset('storage/assets/gambar/' . $getResep->gambar) }}" class="mr-2"
                                    id="preview">
                            </div>
                            <input type="hidden" name="old_gambar" value="{{ $getResep->gambar }}">
                            <div>
                                <x-input-label for="gambar" :value="__('Gambar')" />
                                <x-text-input id="gambar" name="gambar" type="file"
                                    class="mt-1 p-2 block w-full border  border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none focus:border-2"
                                    accept="image/*" onchange="ImgPreview(this)" />
                                <x-input-error class="mt-2" :messages="$errors->get('gambar')" />
                            </div>
                            <div>
                                <x-input-label for="nama_resep" :value="__('Nama Resep')" />
                                <x-text-input id="nama_resep" name="nama_resep" type="text" class="mt-1 block w-full"
                                    :value="old('nama_resep', $getResep->nama_resep)" required autofocus />
                                <x-input-error class="mt-2" :messages="$errors->get('nama_resep')" />
                            </div>
                            <div>
                                <x-input-label for="deskripsi" :value="__('Deskripsi')" />
                                <textarea id="deskripsi" name="deskripsi" type="text"
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    required rows="5" />{{ old('deskripsi', $getResep->deskripsi) }}</textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('deskripsi')" />
                            </div>
                            <div class="trix">
                                <x-input-label for="x" :value="__('Bahan & Cara Buat')" />
                                <input id="x" type="hidden" value="{{ old('content', $getResep->content) }}"
                                    name="content">
                                <trix-editor input="x"
                                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm min-h-[350px]"></trix-editor>
                                <x-input-error class="mt-2" :messages="$errors->get('content')" />
                            </div>
                            <div>
                                <x-input-label for="status" :value="__('Status')" />
                                <select name="status" id="status"
                                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="draft" {{ $getResep->status == 'draft' ? 'selected' : '' }}>Draft
                                    </option>
                                    <option value="publish" {{ $getResep->status == 'publish' ? 'selected' : '' }}>
                                        publish</option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('status')" />
                            </div>
                            <div>
                                <input name='tags' class='some_class_name' placeholder='berikan tags untuk resep ini'
                                    value='{{ $getResep->tagItems->pluck('tag.nama_tag')->implode(',') }}'>
                                <x-input-error class="mt-2" :messages="$errors->get('tags')" />
                            </div>
                            <div>
                                <x-primary-button type="submit">
                                    {{ __('Ubah') }}
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
            var input = document.querySelector('input[name="tags"]');

            var whitelist = @json($tags);

            var tagify = new Tagify(input, {
                whitelist: whitelist,
                // maxTags: 10,
                dropdown: {
                    maxItems: 20,
                    classname: "tags-look",
                    enabled: 0,
                    closeOnSelect: false
                }
            })
        </script>
    @endpush
</x-app-layout>
