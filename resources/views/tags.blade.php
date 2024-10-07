<x-app-layout title="Tags" :headerApp=false>

    <div class="min-h-screen">
        <div class="m-6 p-4 border rounded-md bg-white">

            <h3 class="text-2xl font-bold my-3">Daftar Tags</h3>
            <div class="flex flex-wrap gap-3 justify-center">

                <div class="flex items-center w-full">
                    <span class="flex-grow bg-gray-200 rounded h-0.5"></span>
                    <span class="mx-3 text-lg font-medium">Populer</span>
                    <span class="flex-grow bg-gray-200 rounded h-0.5"></span>
                </div>

                @foreach ($tags as $tag)
                    <a href="{{ route('resep.tag.view', ['tag' => $tag->nama_tag]) }}"
                        class="bg-gray-300 text-gray-800 text-xs font-medium me-2 px-3 py-1 rounded">{{ $tag->nama_tag }}</a>
                @endforeach


            </div>

        </div>
    </div>


</x-app-layout>
