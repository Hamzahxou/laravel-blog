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
    <!-- This is an example component -->
    @if ($getLatestReseps ?? false)

        <div class="w-full mx-auto">
            <div id="default-carousel" class="relative" data-carousel="static">
                <!-- Carousel wrapper -->
                <div class="overflow-hidden relative carousel-wrapper h-96">
                    @foreach ($getLatestReseps as $resepLatest)
                        <div class="hidden duration-700 ease-in-out" data-carousel-item>
                            <img src="{{ asset('storage/assets/gambar/' . $resepLatest->gambar) }}"
                                class="block absolute w-full h-full object-cover object-center" alt="...">

                            <div class="absolute bottom-0 left-0 right-0 flex justify-center items-center">
                                <a class="mb-10 text-center inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150"
                                    href="{{ route('resep.view', ['pembuat' => 'hamzahxou', 'id' => $resepLatest->id]) }}">
                                    Lihat Resep
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- Slider controls -->
                <button type="button"
                    class="flex absolute top-0 left-0 z-30 justify-center items-center px-4 h-full cursor-pointer group focus:outline-none"
                    data-carousel-prev>
                    <span
                        class="inline-flex justify-center items-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30  group-hover:bg-white/50 group-focus:ring-4 group-focus:ring-white group-focus:outline-none">
                        <svg class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                            </path>
                        </svg>
                        <span class="hidden">Previous</span>
                    </span>
                </button>
                <button type="button"
                    class="flex absolute top-0 right-0 z-30 justify-center items-center px-4 h-full cursor-pointer group focus:outline-none"
                    data-carousel-next>
                    <span
                        class="inline-flex justify-center items-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30  group-hover:bg-white/50 group-focus:ring-4 group-focus:ring-white group-focus:outline-none">
                        <svg class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                        <span class="hidden">Next</span>
                    </span>
                </button>
            </div>
        </div>

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
                        <div class="absolute top-1 left-1 flex gap-1">
                            @foreach ($resep->tagItems as $tagItems)
                                <a href="{{ route('resep.tag.view', ['tag' => $tagItems->tag->nama_tag]) }}"
                                    class="bg-gray-300 text-gray-800 text-xs font-medium me-2 px-3 py-1 rounded">{{ $tagItems->tag->nama_tag }}</a>
                            @endforeach
                        </div>
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

                        <small class="text-gray-500 mt-5 block"><a
                                href="{{ route('resep.pembuat.view', ['pembuat' => $resep->user->username]) }}"><b
                                    class="font-bold">{{ $resep->user->username }}</b></a> |
                            {{ $resep->created_at->diffForHumans() }}</small>
                    </div>
                </div>
            @endforeach
        @else
            <h1 class="text-slate-600 text-large">Tidak ada resep</h1>
        @endif
    </div>
</x-app-layout>
