<x-app-layout title="Daftar Resep Anda">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Resep Anda') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg overflow-x-auto">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form class="w-full">
                        <div class="flex gap-2 items-center">
                            <div class="relative w-full">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                    </svg>
                                </div>
                                <input type="search" name="q" id="default-search"
                                    class="block w-full p-3 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 "
                                    placeholder="Cari resep" value="{{ request()->q }}" />
                            </div>
                            <select
                                name="status"class="border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 ">
                                <option value="" {{ request()->status == '' ? 'selected' : '' }}>
                                    Semua</option>
                                <option value="draft" {{ request()->status == 'draft' ? 'selected' : '' }}>
                                    Draft</option>
                                <option value="publish" {{ request()->status == 'publish' ? 'selected' : '' }}>
                                    publish</option>
                            </select>
                            <x-primary-button type="submit">cari</x-primary-button>
                        </div>
                    </form>

                    <hr class="border-b-2 border-taupeGray mt-4 mb-4 block" />
                    <table class="w-full whitespace-no-wrapw-full whitespace-no-wrap table-auto">
                        <thead>
                            <tr class="text-center font-bold">
                                <td class="border px-6 py-4 w-[80px]">No</td>
                                <td class="border px-6 py-4 lg:w-[250px] hidden lg:table-cell">Gambar</td>
                                <td class="border px-6 py-4 lg:w-[250px]">Judul</td>
                                <td class="border px-6 py-4 lg:w-[250px] hidden lg:table-cell">Tanggal</td>
                                <td class="border px-6 py-4 lg:w-[100px] hidden lg:table-cell">Status</td>
                                <td class="border px-6 py-4  w-[100px]">Aksi</td>
                            </tr>
                        </thead>
                        <tbody>

                            @if (count($getReseps) > 0)
                                @foreach ($getReseps as $resep)
                                    <tr>
                                        <td class="border px-6 py-4 text-center">
                                            {{ $getReseps->firstItem() + $loop->index }}</td>
                                        <td class="border px-6 py-4 hidden lg:table-cell">
                                            <div class="w-32 h-20 mx-auto">
                                                <img src="{{ asset('storage/assets/gambar/' . $resep->gambar) }}"
                                                    class="w-full h-full md:w-32 max-w-full max-h-full"
                                                    alt="nasi goreng rendang">
                                            </div>
                                        </td>
                                        <td class="border px-6 py-4">
                                            {{ $resep->nama_resep }}
                                            <div class="block lg:hidden text-sm text-gray-500">
                                                {{ $resep->status }} |
                                                {{ $resep->created_at->isoFormat('dddd, D MMMM YYYY') }}
                                            </div>
                                        </td>
                                        <td
                                            class="border px-6 py-4 text-center text-gray-500 text-sm hidden lg:table-cell">
                                            {{ $resep->created_at->isoFormat('dddd, D MMMM YYYY') }}</td>
                                        <td class="border px-6 py-4 text-center text-sm hidden lg:table-cell">
                                            <form action="{{ route('resep.status.update', $resep->id) }}"
                                                method="post">
                                                @csrf
                                                @method('PUT')
                                                <select name="status" onchange="form.submit()"
                                                    class="border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 loadingOther ">
                                                    <option value="draft"
                                                        {{ $resep->status == 'draft' ? 'selected' : '' }}>Draft
                                                    </option>
                                                    <option value="publish"
                                                        {{ $resep->status == 'publish' ? 'selected' : '' }}>publish
                                                    </option>
                                                </select>
                                            </form>
                                        </td>
                                        <td class="border px-6 py-4">
                                            <div class="flex justify-center gap-2">
                                                <a href='{{ route('resep.edit', $resep->id) }}'
                                                    class="block text-blue-600 hover:text-blue-400">
                                                    <div class="w-5 h-5">
                                                        <svg viewBox="0 0 24 24" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                                stroke-linejoin="round"></g>
                                                            <g id="SVGRepo_iconCarrier">
                                                                <path
                                                                    d="M2 12.5001L3.75159 10.9675C4.66286 10.1702 6.03628 10.2159 6.89249 11.0721L11.1822 15.3618C11.8694 16.0491 12.9512 16.1428 13.7464 15.5839L14.0446 15.3744C15.1888 14.5702 16.7369 14.6634 17.7765 15.599L21 18.5001"
                                                                    stroke="rgb(245 158 11)" stroke-width="1.5"
                                                                    stroke-linecap="round"></path>
                                                                <path
                                                                    d="M18.562 2.9354L18.9791 2.5183C19.6702 1.82723 20.7906 1.82723 21.4817 2.5183C22.1728 3.20937 22.1728 4.32981 21.4817 5.02087L21.0646 5.43797M18.562 2.9354C18.562 2.9354 18.6142 3.82172 19.3962 4.60378C20.1783 5.38583 21.0646 5.43797 21.0646 5.43797M18.562 2.9354L14.7275 6.76995C14.4677 7.02968 14.3379 7.15954 14.2262 7.30273C14.0945 7.47163 13.9815 7.65439 13.8894 7.84776C13.8112 8.01169 13.7532 8.18591 13.637 8.53437L13.2651 9.65M21.0646 5.43797L17.23 9.27253C16.9703 9.53225 16.8405 9.66211 16.6973 9.7738C16.5284 9.90554 16.3456 10.0185 16.1522 10.1106C15.9883 10.1888 15.8141 10.2468 15.4656 10.363L14.35 10.7349M14.35 10.7349L13.6281 10.9755C13.4567 11.0327 13.2676 10.988 13.1398 10.8602C13.012 10.7324 12.9673 10.5433 13.0245 10.3719L13.2651 9.65M14.35 10.7349L13.2651 9.65"
                                                                    stroke="rgb(245 158 11)" stroke-width="1.5"></path>
                                                                <path
                                                                    d="M22 12C22 16.714 22 19.0711 20.5355 20.5355C19.0711 22 16.714 22 12 22C7.28595 22 4.92893 22 3.46447 20.5355C2 19.0711 2 16.714 2 12C2 10.8717 2 9.87835 2.02008 9M12 2C7.28595 2 4.92893 2 3.46447 3.46447C3.03965 3.88929 2.73806 4.38921 2.52396 5"
                                                                    stroke="rgb(245 158 11)" stroke-width="1.5"
                                                                    stroke-linecap="round"></path>
                                                            </g>
                                                        </svg>
                                                    </div>
                                                </a>
                                                <a href='{{ route('resep.view', ['pembuat' => auth()->user()->username, 'id' => $resep->id]) }}'
                                                    class="block text-blue-600 hover:text-blue-400">
                                                    <div class="w-5 h-5">
                                                        <svg viewBox="0 0 24 24" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                                stroke-linejoin="round"></g>
                                                            <g id="SVGRepo_iconCarrier">
                                                                <path d="M13 11L22 2M22 2H16.6562M22 2V7.34375"
                                                                    stroke="rgb(22 163 74)" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round">
                                                                </path>
                                                                <path
                                                                    d="M2 12C2 7.28595 2 4.92893 3.46447 3.46447C4.92893 2 7.28595 2 12 2M22 12C22 16.714 22 19.0711 20.5355 20.5355C19.0711 22 16.714 22 12 22C7.28595 22 4.92893 22 3.46447 20.5355C2.49073 19.5618 2.16444 18.1934 2.0551 16"
                                                                    stroke="rgb(22 163 74)" stroke-width="1.5"
                                                                    stroke-linecap="round"></path>
                                                            </g>
                                                        </svg>
                                                    </div>
                                                </a>
                                                <form action="{{ route('resep.destroy', $resep->id) }}" method="post"
                                                    class="flex justify-center align-center">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="block"
                                                        onclick="confirmDelete(event)">
                                                        <div class="w-5 h-5">
                                                            <svg viewBox="0 0 24 24"
                                                                class="text-red-600 hover:text-red-400" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
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
                                                <form action="{{ route('copy.resep', $resep->id) }}" method="post"
                                                    class="flex justify-center align-center">
                                                    @csrf
                                                    <button type="submit" class="block" onclick="confirmCopy()">
                                                        <div class="w-5 h-5">
                                                            <svg viewBox="0 0 24 24" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                                    stroke-linejoin="round"></g>
                                                                <g id="SVGRepo_iconCarrier">
                                                                    <path
                                                                        d="M6 11C6 8.17157 6 6.75736 6.87868 5.87868C7.75736 5 9.17157 5 12 5H15C17.8284 5 19.2426 5 20.1213 5.87868C21 6.75736 21 8.17157 21 11V16C21 18.8284 21 20.2426 20.1213 21.1213C19.2426 22 17.8284 22 15 22H12C9.17157 22 7.75736 22 6.87868 21.1213C6 20.2426 6 18.8284 6 16V11Z"
                                                                        stroke="rgb(51 65 85)" stroke-width="1.5">
                                                                    </path>
                                                                    <path
                                                                        d="M6 19C4.34315 19 3 17.6569 3 16V10C3 6.22876 3 4.34315 4.17157 3.17157C5.34315 2 7.22876 2 11 2H15C16.6569 2 18 3.34315 18 5"
                                                                        stroke="rgb(51 65 85)" stroke-width="1.5">
                                                                    </path>
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
                                    <th colspan="6" class="border px-6 py-4">Tidak ada resep</th>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    <div class="my-3">
                        {{ $getReseps->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function confirmDelete(event) {
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
                        loadingFunction()
                        form.submit();
                        // Swal.fire({
                        //     title: "Deleted!",
                        //     text: "Your file has been deleted.",
                        //     icon: "success"
                        // });
                    }
                });
            }

            function confirmCopy() {
                event.preventDefault(); // prevent form submit
                let form = event.target.closest('form'); // storing the form
                Swal.fire({
                    title: "Apakah kamu yakin?",
                    text: "ingin mengcopy item ini!",
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonColor: "#333",
                    cancelButtonColor: "#c3c3c3",
                    confirmButtonText: "Ya, Copy!",
                    cancelButtonText: "Batal",
                }).then((result) => {
                    if (result.isConfirmed) {
                        loadingFunction()
                        form.submit();
                        // Swal.fire({
                        //     title: "Deleted!",
                        //     text: "Your file has been deleted.",
                        //     icon: "success"
                        // });
                    }
                });
            }
        </script>
    @endpush
</x-app-layout>
