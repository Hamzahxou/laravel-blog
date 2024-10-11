<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        {{-- <div>
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </div> --}}

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
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
        const btnSubmit = document.querySelectorAll('button[type="submit"]');
        if (btnSubmit) {
            btnSubmit.forEach(btn => {
                btn.addEventListener('click', function() {
                    body.insertAdjacentHTML('beforeend', loadingTemplate);
                    setTimeout(() => {
                        removeLoading();
                    }, 5000);
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
                    }, 5000);
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
                    }, 5000);
                });
            });
        }

        function removeLoading() {
            const body = document.body;
            body.removeChild(document.getElementById('loading'));
        }
    </script>

    @stack('scripts')


</body>

</html>
