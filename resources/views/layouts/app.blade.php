@props(['title', 'headerApp' => true])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('storage/assets/logo/logo.png') }}">

    <title>{{ $title ?? config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('storage/assets/css/trix.css') }}">
    <script type="text/javascript" src="{{ asset('storage/assets/js/trix.umd.min.js') }}"></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <script src="{{ asset('storage/assets/js/sweetalert2@11.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')

    {{-- <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" /> --}}
</head>

<body class="font-sans antialiased">
    @if ($headerApp)
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')
        @else
            <div class="bg-gray-100">
                <x-header-view-resep />
    @endif

    <!-- Page Heading -->
    @isset($header)
        <div class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </div>
    @endisset

    <!-- Page Content -->
    <main>
        {{ $slot }}
    </main>
    </div>

    <script>
        const loadingTemplate = `
   <div id="loading"
        class="bg-gray-100 fixed top-0 left-0 right-0 bottom-0 z-50 flex items-center justify-center space-x-2 event-none select-none">
        <div class="w-4 h-4 rounded-full animate-pulse bg-gray-800"></div>
        <div class="w-4 h-4 rounded-full animate-pulse bg-gray-800"></div>
        <div class="w-4 h-4 rounded-full animate-pulse bg-gray-800"></div>
    </div>`

        const body = document.body
        body.insertAdjacentHTML('beforeend', loadingTemplate);
        window.addEventListener('load', function() {
            removeLoading();
        });
        const btnSubmit = Array.from(document.querySelectorAll('button[type="submit"]')).filter(btn => !btn
            .hasAttribute('onclick'));
        if (btnSubmit) {
            btnSubmit.forEach(btn => {
                btn.addEventListener('click', function() {
                    body.insertAdjacentHTML('beforeend', loadingTemplate);
                    setTimeout(() => {
                        removeLoading();
                    }, 3000);
                });
            });
        }

        const listLink = document.querySelectorAll('a');
        if (listLink) {
            listLink.forEach(link => {
                link.addEventListener('click', function() {
                    body.insertAdjacentHTML('beforeend', loadingTemplate);
                    setTimeout(() => {
                        removeLoading();
                    }, 3000);
                });
            });
        }

        const loadingOther = document.querySelectorAll('.loadingOther');
        if (loadingOther) {
            loadingOther.forEach(el => {
                el.addEventListener('change', function() {
                    body.insertAdjacentHTML('beforeend', loadingTemplate);
                    setTimeout(() => {
                        removeLoading();
                    }, 3000);
                });
            });
        }

        function removeLoading() {
            const body = document.body;
            body.removeChild(document.getElementById('loading'));
        }
    </script>

    @if (session('success'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: "success",
                title: "{{ session('success') }}"
            });
        </script>
    @endif

    @stack('scripts')
    {{-- <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script> --}}
</body>

</html>
