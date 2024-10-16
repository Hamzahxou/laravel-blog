<x-app-layout title="Daftar User">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg overflow-x-auto">
                <div class="p-6 bg-white border-b border-gray-200">

                    <div class="flex justify-end items-center mb-2">

                        <a href="{{ route('admin_users.create') }}"
                            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            {{ __('tambah user') }}
                        </a>
                    </div>
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
                                    placeholder="Cari user" value="{{ request()->q }}" />
                            </div>
                            <x-primary-button type="submit">cari</x-primary-button>
                        </div>
                    </form>

                    <hr class="border-b-2 border-taupeGray mt-4 mb-4 block" />
                    <table class="w-full whitespace-no-wrapw-full whitespace-no-wrap table-auto">
                        <thead>
                            <tr class="text-center font-bold">
                                <td class="border px-6 py-4 w-[80px]">No</td>
                                <td class="border px-6 py-4 lg:w-[250px] hidden lg:table-cell">Avatar</td>
                                <td class="border px-6 py-4">username</td>
                                <td class="border px-6 py-4">Role</td>
                                <td class="border px-6 py-4 lg:w-[250px] hidden lg:table-cell">Tanggal Daftar</td>
                                <td class="border px-6 py-4 lg:w-[250px] w-[100px]">Aksi</td>
                            </tr>
                        </thead>
                        <tbody>

                            @if (count($users) > 0)
                                @foreach ($users as $user)
                                    <tr>
                                        <td class="border px-6 py-4 text-center">{{ $loop->iteration }}</td>
                                        <td class="border px-6 py-4 hidden lg:table-cell">
                                            <div class="w-32 mx-auto">
                                                @isset($user->avatar)
                                                    <img src="{{ asset('storage/' . $user->avatar) }}"
                                                        class="w-full md:w-32 max-w-full max-h-full" alt="">
                                                @else
                                                    <img src="{{ asset('storage/profile/default-profile.png') }}"
                                                        class="w-full md:w-32 max-w-full max-h-full" alt="">
                                                @endisset
                                            </div>
                                        </td>
                                        <td class="border px-6 py-4">
                                            {{ $user->username }}
                                        </td>
                                        <td class="border px-6 py-4 text-center">
                                            @if ($user->role == 'admin')
                                                <div
                                                    class="inline-flex items-center px-3 py-1 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest">
                                                    Admin</div>
                                            @else
                                                <div
                                                    class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm">
                                                    Chef</div>
                                            @endif

                                        </td>
                                        <td
                                            class="border px-6 py-4 text-center text-gray-500 text-sm hidden lg:table-cell">
                                            {{ $user->created_at->isoFormat('dddd, D MMMM YYYY') }}</td>

                                        <td class="border px-6 py-4">
                                            <div class="flex justify-center gap-2">
                                                <a href='{{ route('admin_users.edit', $user->id) }}'
                                                    class="block text-blue-600 hover:text-blue-400">
                                                    <div class="w-5 h-5">
                                                        <svg viewBox="0 0 24 24" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                                stroke-linejoin="round"></g>
                                                            <g id="SVGRepo_iconCarrier">
                                                                <path d="M4 22H20" stroke="rgb(245 158 11)"
                                                                    stroke-width="1.5" stroke-linecap="round"></path>
                                                                <path
                                                                    d="M13.8881 3.66293L14.6296 2.92142C15.8581 1.69286 17.85 1.69286 19.0786 2.92142C20.3071 4.14999 20.3071 6.14188 19.0786 7.37044L18.3371 8.11195M13.8881 3.66293C13.8881 3.66293 13.9807 5.23862 15.3711 6.62894C16.7614 8.01926 18.3371 8.11195 18.3371 8.11195M13.8881 3.66293L7.07106 10.4799C6.60933 10.9416 6.37846 11.1725 6.17992 11.4271C5.94571 11.7273 5.74491 12.0522 5.58107 12.396C5.44219 12.6874 5.33894 12.9972 5.13245 13.6167L4.25745 16.2417M18.3371 8.11195L11.5201 14.9289C11.0584 15.3907 10.8275 15.6215 10.5729 15.8201C10.2727 16.0543 9.94775 16.2551 9.60398 16.4189C9.31256 16.5578 9.00282 16.6611 8.38334 16.8675L5.75834 17.7426M5.75834 17.7426L5.11667 17.9564C4.81182 18.0581 4.47573 17.9787 4.2485 17.7515C4.02128 17.5243 3.94194 17.1882 4.04356 16.8833L4.25745 16.2417M5.75834 17.7426L4.25745 16.2417"
                                                                    stroke="rgb(245 158 11)" stroke-width="1.5"></path>
                                                            </g>
                                                        </svg>
                                                    </div>
                                                </a>
                                                <a href='{{ route('resep.pembuat.view', ['pembuat' => $user->username]) }}'
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
                                                @if ($user->role != 'admin')
                                                    <form action="{{ route('admin_users.destroy', $user->id) }}"
                                                        method="post" class="flex justify-center align-center">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="block"
                                                            onclick="confirmDelete(event)">
                                                            <div class="w-5 h-5">
                                                                <svg viewBox="0 0 24 24"
                                                                    class="text-red-600 hover:text-red-400"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                                    <g id="SVGRepo_tracerCarrier"
                                                                        stroke-linecap="round"
                                                                        stroke-linejoin="round"></g>
                                                                    <g id="SVGRepo_iconCarrier">
                                                                        <path d="M20.5001 6H3.5"
                                                                            stroke="rgb(220 38 38)" stroke-width="1.5"
                                                                            stroke-linecap="round">
                                                                        </path>
                                                                        <path d="M9.5 11L10 16" stroke="rgb(220 38 38)"
                                                                            stroke-width="1.5" stroke-linecap="round">
                                                                        </path>
                                                                        <path d="M14.5 11L14 16"
                                                                            stroke="rgb(220 38 38)" stroke-width="1.5"
                                                                            stroke-linecap="round">
                                                                        </path>
                                                                        <path
                                                                            d="M6.5 6C6.55588 6 6.58382 6 6.60915 5.99936C7.43259 5.97849 8.15902 5.45491 8.43922 4.68032C8.44784 4.65649 8.45667 4.62999 8.47434 4.57697L8.57143 4.28571C8.65431 4.03708 8.69575 3.91276 8.75071 3.8072C8.97001 3.38607 9.37574 3.09364 9.84461 3.01877C9.96213 3 10.0932 3 10.3553 3H13.6447C13.9068 3 14.0379 3 14.1554 3.01877C14.6243 3.09364 15.03 3.38607 15.2493 3.8072C15.3043 3.91276 15.3457 4.03708 15.4286 4.28571L15.5257 4.57697C15.5433 4.62992 15.5522 4.65651 15.5608 4.68032C15.841 5.45491 16.5674 5.97849 17.3909 5.99936C17.4162 6 17.4441 6 17.5 6"
                                                                            stroke="rgb(220 38 38)"
                                                                            stroke-width="1.5">
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
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <th colspan="6" class="border px-6 py-4">Tidak ada user</th>
                                </tr>
                            @endif
                        </tbody>
                    </table>

                    <div class="my-4">
                        {{ $users->appends(request()->query())->links() }}
                    </div>
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
        </script>
    @endpush
</x-app-layout>
