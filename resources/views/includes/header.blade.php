<style>
    .logo {
        font-family: "Dancing Script", cursive;
        font-optical-sizing: auto;
        font-weight: 700;
        font-style: normal;
        font-size: 39px;
    }

</style>

<nav class="bg-white border-gray-200 border-b-2">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
            <h1 class="self-center text-2xl text-blue-500 font-semibold whitespace-nowrap logo">Evento</h1>
        </a>
        <div class="flex">
            {{-- Search --}}
            <div class="flex md:order-2 mx-6">
                <div class="relative hidden md:block">
                    <div
                        class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                        <span class="sr-only">Search icon</span>
                    </div>
                    <input type="text" id="search-input"
                           class="block w-full p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="Search...">
                </div>
            </div>

            {{-- Settingd --}}
            <div class="flex items-center md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
                @if(\Illuminate\Support\Facades\Auth::check())

                    <button type="button"
                            class="flex text-sm bg-gray-800 rounded-full md:me-0 focus:ring-4 focus:ring-gray-300"
                            id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown"
                            data-dropdown-placement="bottom">
                        <span class="sr-only">Open user menu</span>
                        <img class="w-8 h-8 rounded-full" src="{{getPicUrl(getUser()->picture, 'pictures/profiles')}}"
                             alt="user photo"></button>
                    <!-- Dropdown menu -->
                    <div
                        class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow"
                        id="user-dropdown">
                        <div class="px-4 py-3">
                            <span class="block text-sm text-gray-900">{{getUser()->name}}</span>
                            <span class="block text-sm  text-gray-500 truncate">{{getUser()->email}}</span>
                        </div>
                        <ul class="py-2" aria-labelledby="user-menu-button">
                            <li>
                                <a href="/dashboard" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100e">Dashboard</a>
                            </li>
                            <li>
                                <a href="/myTickets"
                                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Tickets</a>
                            </li>
                            <li>
                                <a href="/myReservation"
                                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Reservations</a>
                            </li>
                            <li>

                                <a href="/logout" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Sign
                                    out
                                </a>
                            </li>
                        </ul>
                    </div>
                @else
                    <a href="{{route('login')}}"
                       class="text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                        Login
                    </a>
                @endif
            </div>
        </div>
    </div>
</nav>
<script src="{{ url('/js/search.js') }}"></script>
