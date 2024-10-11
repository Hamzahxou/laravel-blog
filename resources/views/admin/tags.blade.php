<x-app-layout title="{{ __('Tambah Resep') }}">

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Daftar Tags
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-2xl">
                    <section>
                        @error('nama_tag')
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
                        @enderror

                        <div class="flex justify-between items-center mb-2">
                            <a href="{{ route('dashboard') }}"
                                class="mb-2 inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">{{ __('kembali') }}</a>

                            <form action="{{ route('tags.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="nama_tag">
                                <button type="submit" onclick="tambahTag(event)"
                                    class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    {{ __('tambah') }}
                                </button>
                            </form>
                        </div>
                        <table class="w-full whitespace-no-wrapw-full whitespace-no-wrap table-auto">
                            <thead>
                                <tr class="text-center font-bold">
                                    <td class="border px-6 py-4 w-[50px]">No</td>
                                    <td class="border px-6 py-4">Tags</td>
                                    <td class="border px-6 py-4">Aksi</td>
                                </tr>
                            </thead>
                            <tbody>

                                @if (count($tags) > 0)
                                    @foreach ($tags as $tag)
                                        <tr>
                                            <td class="border px-6 py-4 text-center">{{ $loop->iteration }}</td>
                                            <td class="border px-6 py-4">
                                                {{ $tag->nama_tag }}
                                            </td>
                                            <td class="border px-6 py-4">
                                                <div class="flex justify-center gap-2">
                                                    <form action="{{ route('tags.update', $tag->id) }}" method="post"
                                                        class="flex justify-center align-center">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="tag_id"
                                                            value="{{ $tag->id }}">
                                                        <input type="hidden" name="nama_tag"
                                                            value="{{ $tag->nama_tag }}">
                                                        <button type="submit" class="block" onclick="editTag(event)">
                                                            <div class="w-5 h-5">
                                                                <svg viewBox="0 0 24 24" fill="none"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                                        stroke-linejoin="round"></g>
                                                                    <g id="SVGRepo_iconCarrier">
                                                                        <path
                                                                            d="M10 21.9948C6.58687 21.9658 4.70529 21.7764 3.46447 20.5355C2 19.0711 2 16.714 2 12C2 7.28595 2 4.92893 3.46447 3.46447C4.92893 2 7.28595 2 12 2C16.714 2 19.0711 2 20.5355 3.46447C21.5093 4.43821 21.8356 5.80655 21.9449 8"
                                                                            stroke="rgb(245 158 11)" stroke-width="1.5"
                                                                            stroke-linecap="round"></path>
                                                                        <path
                                                                            d="M2.5 7.25C2.08579 7.25 1.75 7.58579 1.75 8C1.75 8.41421 2.08579 8.75 2.5 8.75V7.25ZM22 7.25H2.5V8.75H22V7.25Z"
                                                                            fill="rgb(245 158 11)"></path>
                                                                        <path d="M10.5 2.5L7 8" stroke="rgb(245 158 11)"
                                                                            stroke-width="1.5" stroke-linecap="round">
                                                                        </path>
                                                                        <path d="M17 2.5L13.5 8"
                                                                            stroke="rgb(245 158 11)" stroke-width="1.5"
                                                                            stroke-linecap="round">
                                                                        </path>
                                                                        <path
                                                                            d="M18.562 13.9354L18.9791 13.5183C19.6702 12.8272 20.7906 12.8272 21.4817 13.5183C22.1728 14.2094 22.1728 15.3298 21.4817 16.0209L21.0646 16.438M18.562 13.9354C18.562 13.9354 18.6142 14.8217 19.3962 15.6038C20.1783 16.3858 21.0646 16.438 21.0646 16.438M18.562 13.9354L14.7275 17.77C14.4677 18.0297 14.3379 18.1595 14.2262 18.3027C14.0945 18.4716 13.9815 18.6544 13.8894 18.8478C13.8112 19.0117 13.7532 19.1859 13.637 19.5344L13.2651 20.65L13.1448 21.0109M21.0646 16.438L17.23 20.2725C16.9703 20.5323 16.8405 20.6621 16.6973 20.7738C16.5284 20.9055 16.3456 21.0185 16.1522 21.1106C15.9883 21.1888 15.8141 21.2468 15.4656 21.363L14.35 21.7349L13.9891 21.8552M13.9891 21.8552L13.6281 21.9755C13.4567 22.0327 13.2676 21.988 13.1398 21.8602C13.012 21.7324 12.9673 21.5433 13.0245 21.3719L13.1448 21.0109M13.9891 21.8552L13.1448 21.0109"
                                                                            stroke="rgb(245 158 11)" stroke-width="1.5">
                                                                        </path>
                                                                    </g>
                                                                </svg>
                                                            </div>
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('tags.destroy', $tag->id) }}" method="post"
                                                        class="flex justify-center align-center">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="block" onclick="confirmDelete()">
                                                            <div class="w-5 h-5">
                                                                <svg viewBox="0 0 24 24"
                                                                    class="text-red-600 hover:text-red-400"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                                        stroke-linejoin="round"></g>
                                                                    <g id="SVGRepo_iconCarrier">
                                                                        <path d="M20.5001 6H3.5" stroke="rgb(220 38 38)"
                                                                            stroke-width="1.5" stroke-linecap="round">
                                                                        </path>
                                                                        <path d="M9.5 11L10 16" stroke="rgb(220 38 38)"
                                                                            stroke-width="1.5" stroke-linecap="round">
                                                                        </path>
                                                                        <path d="M14.5 11L14 16" stroke="rgb(220 38 38)"
                                                                            stroke-width="1.5" stroke-linecap="round">
                                                                        </path>
                                                                        <path
                                                                            d="M6.5 6C6.55588 6 6.58382 6 6.60915 5.99936C7.43259 5.97849 8.15902 5.45491 8.43922 4.68032C8.44784 4.65649 8.45667 4.62999 8.47434 4.57697L8.57143 4.28571C8.65431 4.03708 8.69575 3.91276 8.75071 3.8072C8.97001 3.38607 9.37574 3.09364 9.84461 3.01877C9.96213 3 10.0932 3 10.3553 3H13.6447C13.9068 3 14.0379 3 14.1554 3.01877C14.6243 3.09364 15.03 3.38607 15.2493 3.8072C15.3043 3.91276 15.3457 4.03708 15.4286 4.28571L15.5257 4.57697C15.5433 4.62992 15.5522 4.65651 15.5608 4.68032C15.841 5.45491 16.5674 5.97849 17.3909 5.99936C17.4162 6 17.4441 6 17.5 6"
                                                                            stroke="rgb(220 38 38)" stroke-width="1.5">
                                                                        </path>
                                                                        <path
                                                                            d="M18.3735 15.3991C18.1965 18.054 18.108 19.3815 17.243 20.1907C16.378 21 15.0476 21 12.3868 21H11.6134C8.9526 21 7.6222 21 6.75719 20.1907C5.89218 19.3815 5.80368 18.054 5.62669 15.3991L5.16675 8.5M18.8334 8.5L18.6334 11.5"
                                                                            stroke="rgb(220 38 38)" stroke-width="1.5"
                                                                            stroke-linecap="round"></path>
                                                                    </g>
                                                                </svg>
                                                            </div>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <th colspan="6" class="border px-6 py-4">Tidak ada Tags</th>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </section>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function confirmDelete() {
                event.preventDefault(); // prevent form submit
                var form = event.target.closest('form'); // storing the form

                Swal.fire({
                    title: "Apakah kamu yakin?",
                    text: "ingin menghapus item ini!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#333",
                    cancelButtonColor: "#c3c3c3",
                    confirmButtonText: "Ya, Hapus!",
                    cancelButtonText: "Batal",
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                        // Swal.fire({
                        //     title: "Deleted!",
                        //     text: "Your file has been deleted.",
                        //     icon: "success"
                        // });
                    }
                });
            }


            async function editTag() {
                event.preventDefault();
                let form = event.target.closest('form');
                let comment = form.querySelector("input[name='nama_tag']").value;
                const {
                    value: text
                } = await Swal.fire({
                    input: "textarea",
                    inputLabel: "Ubah Tags",
                    inputValue: comment,
                    inputPlaceholder: "ketik disini...",
                    inputAttributes: {
                        "aria-label": "ketik disini"
                    },
                    showCancelButton: true,
                    cancelButtonText: "Batal",
                    confirmButtonText: "Simpan",
                    cancelButtonColor: "#c3c3c3",
                    confirmButtonColor: "#333",
                    inputValidator: (value) => {
                        if (!value) {
                            return "Tidak boleh kosong!";
                        }
                    }
                });
                if (text) {
                    form.querySelector("input[name='nama_tag']").value = text;
                    form.submit();
                }
            }

            async function tambahTag() {
                event.preventDefault();
                let form = event.target.closest('form');
                let comment = form.querySelector("input[name='nama_tag']").value;
                const {
                    value: text
                } = await Swal.fire({
                    input: "textarea",
                    inputLabel: "Tambah Tags",
                    inputValue: comment,
                    inputPlaceholder: "ketik disini...",
                    inputAttributes: {
                        "aria-label": "ketik disini"
                    },
                    showCancelButton: true,
                    cancelButtonText: "Batal",
                    confirmButtonText: "Simpan",
                    cancelButtonColor: "#c3c3c3",
                    confirmButtonColor: "#333",
                    inputValidator: (value) => {
                        if (!value) {
                            return "Tidak boleh kosong!";
                        }
                    }
                });
                if (text) {
                    form.querySelector("input[name='nama_tag']").value = text;
                    form.submit();
                }
            }
        </script>
    @endpush
</x-app-layout>
