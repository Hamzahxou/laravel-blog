<x-app-layout :headerApp=false title="Resep">


    <script src="https://unpkg.com/flowbite@1.4.7/dist/flowbite.js"></script>
    </div>

    @isset($pembuat)
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-600 leading-tight">
                {{ __("Daftar resep: $pembuat") }}
            </h2>
        </x-slot>
    @endisset
    @if (request()->tag)
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-600 leading-tight">
                {{ __('Tag: ' . request()->tag) }}
            </h2>
        </x-slot>
    @endif
    <!-- component -->
    <div class="flex justify-center items-center py-12 flex-wrap mx-auto gap-2">
        <!-- Centering wrapper -->
        @if (count($getReseps) > 0)
            @foreach ($getReseps as $resep)
                <div
                    class="relative flex flex-col text-gray-700 bg-white shadow-md bg-clip-border rounded-xl w-92 h-92 sm:w-80 sm:h-80">
                    <div class="relative mx-4 mt-4 overflow-hidden text-gray-700 bg-white bg-clip-border rounded-xl">
                        <img src="{{ asset('storage/assets/gambar/' . $resep->gambar) }}"
                            class="object-cover w-full h-full" />
                    </div>
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-2">
                            <p
                                class="block font-sans text-base antialiased font-medium leading-relaxed text-blue-gray-900">
                                {{ $resep->nama_resep }}
                            </p>
                            <p
                                class="block font-sans text-base antialiased font-medium leading-relaxed text-blue-gray-900">

                            </p>
                        </div>
                        <a href="{{ route('resep.view', ['pembuat' => 'hamzahxou', 'id' => $resep->id]) }}">
                            <p
                                class="block font-sans text-sm antialiased font-normal leading-normal text-gray-700 opacity-75">
                                {{ Str::limit($resep->deskripsi, 100) }}
                            </p>
                        </a>

                        <small class="text-gray-500 mt-5 block"><b class="font-bold">{{ $resep->user->username }}</b> |
                            {{ $resep->created_at->isoFormat('dddd, D MMMM YYYY') }}</small>
                    </div>
                </div>
            @endforeach
        @else
            <h1 class="text-slate-600 text-large">Tidak ada resep</h1>
        @endif
    </div>
</x-app-layout>
