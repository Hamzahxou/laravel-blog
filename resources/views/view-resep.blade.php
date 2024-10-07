<x-app-layout title="{{ $getResep->nama_resep }}" :headerApp=false>

    @push('styles')
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

    <!-- component -->
    <section class="flex justify-center items-center py-12 flex-wrap mx-auto gap-2 w-[90%] lg:w-[70%] mx-auto">
        <!-- Centering wrapper -->
        <div class="relative flex flex-col text-gray-700 bg-white shadow-md bg-clip-border rounded-xl w-full">
            <div class="relative mx-4 mt-4 overflow-hidden text-gray-700 bg-white bg-clip-border rounded-xl h-52">
                <img src="{{ asset('storage/assets/gambar/' . $getResep->gambar) }}" class="object-cover w-full h-full" />
            </div>
            <div class="px-6 py-2">
                <small class="text-slate-400"><a
                        href="{{ route('resep.pembuat.view', ['pembuat' => $getResep->user->username]) }}"><b
                            class="font-bold">{{ $getResep->user->username }}</b></a> -
                    {{ $getResep->created_at->isoFormat('dddd, D MMMM YYYY') }}</small>
            </div>
            <div class="p-6 px-10 pt-0">
                <h1 class="text-4xl font-bold text-blue-gray-900 my-4">
                    {{ $getResep->nama_resep }}
                </h1>
                <p>
                    {{ $getResep->deskripsi }}
                </p>
                <div class="trix">
                    {!! $getResep->content !!}
                </div>
            </div>
            <div class="p-6 px-10 pt-0 mt-3">
                <h1 class="text-xl font-bold text-gray-700 mb-2">Tags</h1>
                <div class="flex flex-wrap gap-2 mx-3">
                    @foreach ($getResep->tagItems as $tagItems)
                        <a href="{{ route('resep.tag.view', ['tag' => $tagItems->tag->nama_tag]) }}"
                            class="bg-gray-300 text-gray-800 text-xs font-medium me-2 px-3 py-1 rounded">{{ $tagItems->tag->nama_tag }}</a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>


    <section class=" py-8 lg:py-16 antialiased">
        <div class="max-w-2xl mx-auto px-4">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg lg:text-2xl font-bold text-gray-900">Komentar ({{ $jumlah_komentar }})
                </h2>
            </div>
            @auth
                <form class="mb-6" action="{{ route('comment.store', $getResep->id) }}" method="post">
                    @csrf
                    <div class="py-2 px-4 mb-4 bg-white rounded-lg rounded-t-lg border border-gray-200 ">
                        <label for="comment" class="sr-only">Komentar</label>
                        <textarea id="comment" rows="6"
                            class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none  " placeholder="Komentar..."
                            required name="comment"></textarea>
                    </div>
                    <div class="flex justify-end"> <x-secondary-button
                            type="submit">{{ __('Kirim') }}</x-secondary-button></div>
                </form>
            @endauth
            @foreach ($getResep->comment as $comment)
                <article class="p-6 text-base bg-white rounded-lg mb-4">
                    <div class="flex justify-between items-center mb-1">
                        <div class="flex items-center">
                            <p class="inline-flex items-center mr-3 text-sm text-gray-900 font-semibold">
                                {{-- <img class="mr-2 w-6 h-6 rounded-full"
                                    src="https://flowbite.com/docs/images/people/profile-picture-2.jpg"
                                    alt="Michael Gough"> --}}
                                {{ $comment->user->username }}
                                @if ($comment->user->id == $getResep->user->id)
                                    <span
                                        class="ms-2 bg-slate-800 text-slate-100 text-xs font-medium me-2 px-3 py-1 rounded">Pemilik</span>
                                @endif

                            </p>
                            <p class="text-sm text-gray-600 "><time pubdate datetime="2022-02-08"
                                    title="February 8th, 2022">{{ $comment->created_at->isoFormat('dddd, D MMM YYYY') }}</time>
                            </p>
                        </div>
                        @if (auth()->user() && $comment->user->id == auth()->user()->id)
                            <div x-data="{ dropdownOpen: false }" class="relative">
                                <button @click="dropdownOpen = !dropdownOpen"
                                    class="relative z-10 block items-center p-2 text-sm font-medium text-center text-gray-900  bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50 ">
                                    <svg class="h-6 w-6 text-dark" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z" />
                                    </svg>
                                </button>

                                <div x-show="dropdownOpen" @click="dropdownOpen = false"
                                    class="fixed inset-0 h-full w-full z-10"></div>

                                <div x-show="dropdownOpen"
                                    class="absolute right-0 mt-2 w-48 bg-white rounded-md overflow-hidden shadow-xl z-20">
                                    <form action="{{ route('comment.update', $getResep->id) }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                                        <input type="hidden" name="content" value="{{ $comment->content }}">
                                        <input type="hidden" name="url" value="{{ url()->current() }}">
                                        <button type="submit" onclick="editComment()"
                                            class="block w-full text-start px-4 py-2 text-sm text-gray-800 border-b hover:bg-gray-200">Edit</button>
                                    </form>
                                    <form action="{{ route('comment.delete', $getResep->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                                        <button type="submit"
                                            class="block w-full text-start px-4 py-2 text-sm text-gray-800 border-b hover:bg-gray-200">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        @endif
                    </div>
                    <p class="text-gray-500 ">{{ $comment->content }}</p>
                    @auth
                        <div class="flex items-center mt-4 space-x-4">
                            <button type="button"
                                onclick="reply(this.parentElement.parentElement, '{{ route('comment.reply.store', $getResep->id) }}', '{{ $comment->id }}')"
                                class="flex items-center text-sm text-gray-500 hover:underline font-medium">
                                <svg class="mr-1.5 w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 20 18">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M5 5h5M5 8h2m6-3h2m-5 3h6m2-7H2a1 1 0 0 0-1 1v9a1 1 0 0 0 1 1h3v5l5-5h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1Z" />
                                </svg>
                                Balas
                            </button>
                        </div>
                    @endauth
                </article>
                @foreach ($comment->replies as $reply)
                    <article class="p-6 text-base bg-white rounded-lg mb-4 mb-3 ml-6 lg:ml-12">
                        <div class="flex justify-between items-center mb-1">
                            <div class="flex items-center">
                                <p class="inline-flex items-center mr-3 text-sm text-gray-900 font-semibold">
                                    {{-- <img class="mr-2 w-6 h-6 rounded-full"
                                    src="https://flowbite.com/docs/images/people/profile-picture-2.jpg"
                                    alt="Michael Gough"> --}}
                                    {{ $reply->user->username }}
                                    @if ($reply->user->id == $getResep->user->id)
                                        <span
                                            class="ms-2 bg-slate-800 text-slate-100 text-xs font-medium me-2 px-3 py-1 rounded">Pemilik</span>
                                    @endif

                                </p>
                                <p class="text-sm text-gray-600 "><time pubdate datetime="2022-02-08"
                                        title="February 8th, 2022">{{ $reply->created_at->isoFormat('dddd, D MMM YYYY') }}</time>
                                </p>
                            </div>
                            @if (auth()->user() && $reply->user->id == auth()->user()->id)
                                <div x-data="{ dropdownOpen: false }" class="relative">
                                    <button @click="dropdownOpen = !dropdownOpen"
                                        class="relative z-10 block items-center p-2 text-sm font-medium text-center text-gray-900  bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50 ">
                                        <svg class="h-6 w-6 text-dark" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z" />
                                        </svg>
                                    </button>

                                    <div x-show="dropdownOpen" @click="dropdownOpen = false"
                                        class="fixed inset-0 h-full w-full z-10"></div>

                                    <div x-show="dropdownOpen"
                                        class="absolute right-0 mt-2 w-48 bg-white rounded-md overflow-hidden shadow-xl z-20">
                                        <form action="{{ route('comment.reply.update', $getResep->id) }}"
                                            method="post">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="reply_id" value="{{ $reply->id }}">
                                            <input type="hidden" name="content" value="{{ $reply->content }}">
                                            <input type="hidden" name="url" value="{{ url()->current() }}">
                                            <button type="submit" onclick="editComment()"
                                                class="block w-full text-start px-4 py-2 text-sm text-gray-800 border-b hover:bg-gray-200">Edit</button>
                                        </form>
                                        <form action="{{ route('comment.reply.delete', $getResep->id) }}"
                                            method="post">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="reply_id" value="{{ $reply->id }}">
                                            <button type="submit"
                                                class="block w-full text-start px-4 py-2 text-sm text-gray-800 border-b hover:bg-gray-200">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <p class="text-gray-500 ">{{ $reply->content }}</p>

                    </article>
                @endforeach
            @endforeach
        </div>
    </section>
    @push('scripts')
        <script>
            async function editComment() {
                event.preventDefault();
                let form = event.target.form;
                let comment = form.querySelector("input[name='content']").value;
                const {
                    value: text
                } = await Swal.fire({
                    input: "textarea",
                    inputLabel: "Ubah Komentar",
                    inputValue: comment,
                    inputPlaceholder: "Type your message here...",
                    inputAttributes: {
                        "aria-label": "Type your message here"
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
                    form.querySelector("input[name='content']").value = text;
                    form.submit();
                }
            }

            function templateForm(route, id) {
                return `
                <article id="reply">
                    <form class="mb-6" action="${route}" method="post">
                        @csrf
                        <input type="hidden" name="comment_id" value="${id}"/>
                        <div class="py-2 px-4 mb-4 bg-white rounded-lg rounded-t-lg border border-gray-200 ">
                          <label for="comment" class="sr-only">Komentar</label>
                          <textarea id="comment" rows="6" class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none  " placeholder="Balas Komentar..." required name="comment"></textarea>
                        </div>
                        <div class="flex justify-end gap-2">
                            <x-secondary-button onclick="(this.parentElement.parentElement.parentElement.remove())">Batal</x-secondary-button>
                            <x-primary-button type="submit">{{ __('Kirim') }}</x-primary-button>
                        </div>
                    </form>
                </article>
                `
            }

            function reply(el, route, id) {
                if (document.getElementById("reply")) {
                    document.getElementById("reply").remove();
                }
                el.insertAdjacentHTML("afterend", templateForm(route, id));
            }
        </script>
    @endpush
</x-app-layout>
