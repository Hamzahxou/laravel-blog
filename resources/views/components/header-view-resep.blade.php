<header>
    <nav class="bg-white border-gray-200 px-4 lg:px-6 py-2.5">
        <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
            <a href="{{ route('resep.beranda') }}" class="flex items-center">
                <img src="{{ asset('storage/assets/logo/logo.png') }}" class="mr-3 h-6 sm:h-9" alt="Reseps Logo" />
            </a>

            <div class="flex justify-center items-center w-64 md:w-96">
                <form class="w-full" action="{{ route('resep.beranda') }}">
                    <div class="flex gap-2 items-center justify-center">
                        <div class="relative w-full">
                            <input type="search" name="q" id="default-search"
                                class="block w-full ps-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 "
                                placeholder="Cari resep" value="{{ request()->q }}" />
                        </div>
                        <x-secondary-button type="submit"> <svg class="w-4 h-4 text-gray-500 dark:text-gray-400"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg></x-secondary-button>
                    </div>
                </form>
            </div>

            <div class="flex items-center lg:order-2">
                @auth
                    <a href="{{ route('dashboard') }}"
                        class="hidden md:block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 focus:outline-none">Dashboard</a>
                @else
                    <a href="{{ route('register') }}"
                        class="text-gray-800 hover:bg-gray-50 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 focus:outline-none">Register</a>
                    <a href="{{ route('login') }}"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 focus:outline-none">Log
                        in</a>
                @endauth
                <button data-collapse-toggle="mobile-menu-2" type="button"
                    class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
                    aria-controls="mobile-menu-2" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <svg class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>

            <div class="hidden justify-between items-center w-full lg:flex lg:w-auto lg:order-1" id="mobile-menu-2">
                <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">

                    <li>
                        <a href="{{ route('resep.beranda') }}"
                            class="block py-2 pr-4 pl-3 @if (request()->routeIs('resep.beranda')) text-white rounded bg-blue-700 lg:bg-transparent lg:text-blue-700 lg:p-0
                                @else
                                text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-blue-700 lg:p-0 @endif ">Reseps</a>
                    </li>
                    <li>
                        <a href="{{ route('resep.tags.view') }}"
                            class="block py-2 pr-4 pl-3 @if (request()->routeIs('resep.tags.view')) text-white rounded bg-blue-700 lg:bg-transparent lg:text-blue-700 lg:p-0
                                @else
                                text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-blue-700 lg:p-0 @endif ">Tags</a>
                    </li>
                    @auth
                        <li>
                            <a href="{{ route('dashboard') }}"
                                class="block md:hidden py-2 pr-4 pl-3 @if (request()->routeIs('dashboard')) text-white rounded bg-blue-700 lg:bg-transparent lg:text-blue-700 lg:p-0
                                @else
                                text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-blue-700 lg:p-0 @endif ">Dashboard</a>
                        </li>
                    @endauth
                </ul>
            </div>


        </div>
    </nav>
</header>
