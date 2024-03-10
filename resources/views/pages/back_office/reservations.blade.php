<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="{{ url('/css/dashboard.css') }}">


<div x-data="setup()" :class="{ 'dark': isDark }">
    <div
        class="min-h-screen flex flex-col flex-auto flex-shrink-0 antialiased bg-white dark:bg-gray-700 text-black dark:text-white">

        <x-dashboard.headerdash/>

        <x-dashboard.sidebardash/>

        <div class="h-full ml-14 mt-14 mb-10 md:ml-64">
            @if (session('success'))
                <div class="max-w-4xl mx-auto px-4">
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4" role="alert">
                        <p class="font-bold">Success</p>
                        <p>{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-1 xl:grid-cols-1 gap-4 text-black dark:text-white">
                <div class="mt-4 mx-4">
                    <div class="flex justify-end px-6">
                            <button
                                id="event-request-btn"
                                class="relative middle none center rounded-lg bg-gray-500 mb-10 py-3 px-6 font-sans text-xs font-bold uppercase text-white shadow-md shadow-red-500/20 transition-all hover:shadow-lg hover:shadow-red-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">

                                <span class="inline-block">
                                    Reservation Request
                                </span>
                                <span
                                    class="absolute top-0 right-0 bg-red-500 text-white rounded-full px-2 py-1 text-xs font-bold">
                                    {{count($reservationsRequest)}}
                            </span>

                            </button>

                            <button
                                id="event-list-btn"
                                class="hidden relative middle none center rounded-lg bg-gray-500 mb-10 py-3 px-6 font-sans text-xs font-bold uppercase text-white shadow-md shadow-red-500/20 transition-all hover:shadow-lg hover:shadow-red-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                                <span class="inline-block">
                                    Reservations List
                                </span>

                            </button>

                    </div>

                    {{--  Event List  --}}
                     <div
                         id="event-list"
                         class="w-full overflow-hidden rounded-lg shadow-xs">
                         <div class="w-full overflow-x-auto">
                             <table class="w-full">
                                 <thead>
                                 <tr
                                     class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                     <th class="px-4 py-3">Event Title</th>
                                     <th class="px-4 py-3">Description</th>
                                     <th class="px-4 py-3">Category</th>
                                     <th class="px-4 py-3">Location</th>
                                     <th class="px-4 py-3">Guest</th>
                                     <th class="px-4 py-3">Price</th>
                                     <th class="px-4 py-3">Organizer</th>
                                     <th class="px-4 py-3">Reservation Status</th>
                                     <th class="px-4 py-3">Reservation Date</th>
                                     <th class="px-4 py-3">Created date</th>
                                     <th class="px-4 py-3 text-center">Operation</th>
                                 </tr>
                                 </thead>
                                 <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                 @if (isset($reservations))
                                     @foreach ($reservations as $reservation)
                                         <tr
                                             class="bg-gray-50 dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-900 text-gray-700 dark:text-gray-400">
                                             <td class="px-4 py-3 text-sm">{{ $reservation->event->title }}</td>
                                             <td class="px-4 py-3 text-sm">{{ $reservation->event->description }}</td>
                                             <td class="px-4 py-3 text-sm">{{ $reservation->event['category']['category'] }}</td>
                                             <td class="px-4 py-3 text-sm">{{ $reservation->event['location']['location'] }}</td>
                                             <td class="px-4 py-3 text-sm flex flex-col">
                                                 <p class="p-12">{{ $reservation->user->name }}</p>
                                                 <p class="p-12">{{ $reservation->user->email }}</p>
                                             </td>
                                             <td class="px-4 py-3 text-sm">{{ $reservation->event->price }}</td>
                                             <td class="px-4 py-3 text-sm">{{ $reservation->event['user']['name'] }}</td>
                                             <td class="px-4 py-3 text-sm">{{ $reservation->status }}</td>
                                             <td class="px-4 py-3 text-sm">{{ convertTimeFormat($reservation->date, 'd') }}</td>
                                             <td class="px-4 py-3 text-sm">
                                                 {{ $reservation->created_at->format('d-m-Y') }}</td>
                                             <td class="px-4 py-3 text-xs text-center">
                                                 <form action="{{ route('reservations.destroy', $reservation->id) }}"
                                                       method="POST">
                                                     @csrf
                                                     @method('DELETE')
                                                     <button type="submit"
                                                             class=" bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded">
                                                         Delete Reservation
                                                     </button>
                                                 </form>

                                             </td>
                                         </tr>
                                     @endforeach
                                 @else
                                     <tr
                                         class="bg-gray-50 dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-900 text-gray-700 dark:text-gray-400">
                                         List is Empty
                                     </tr>
                                 @endif
                                 </tbody>
                             </table>
                             <div class="my-12 flex justify-center">
                                 {{ $reservations->links() }}
                             </div>
                         </div>
                     </div>

                    {{--  Reservation Request List  --}}

                    <div
                        id="event-request-list"
                        class="hidden w-full overflow-hidden rounded-lg shadow-xs">
                        <div class="w-full overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                <tr
                                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                    <th class="px-4 py-3">Reservation ID</th>
                                    <th class="px-4 py-3">Event Title</th>
                                    <th class="px-4 py-3">Guest</th>
                                    <th class="px-4 py-3">Location</th>
                                    <th class="px-4 py-3">Price</th>
                                    <th class="px-4 py-3">Status</th>
                                    <th class="px-4 py-3">Created date</th>
                                    <th class="px-4 py-3 text-center">Operation</th>
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                @if (count($reservations) !== 0)
                                    @foreach ($reservationsRequest as $reservation)
                                        <tr
                                            class="bg-gray-50 dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-900 text-gray-700 dark:text-gray-400">
                                            <td class="px-4 py-3 text-sm">{{ $reservation->id }}</td>
                                            <td class="px-4 py-3 text-sm">{{ $reservation->event->title }}</td>
                                            <td class="px-4 py-3 text-sm">{{ $reservation['user']['name'] }}</td>
                                            <td class="px-4 py-3 text-sm">{{ $reservation->event['location']['location'] }}</td>
                                            <td class="px-4 py-3 text-sm">{{ $reservation->event->price }}</td>
                                            <td class="px-4 py-3 text-sm">{{ $reservation->status }}</td>
                                            <td class="px-4 py-3 text-sm">
                                                {{ $reservation->created_at->format('d-m-Y') }}</td>
                                            <td class="px-4 py-3 text-xs text-center">
                                                <form action="{{ route('reservations.status', $reservation->id) }}")
                                                      method="POST">
                                                    @csrf
                                                    <input type="hidden" name="eventId" value="{{$reservation->event->id}}">
                                                    <div class="flex flex-row justify-between gap-4">
                                                        <button type="submit" name="accept" value="true"
                                                                class="bg-green-500 hover:bg-green-800 text-white font-semibold py-2 px-4 rounded">
                                                            Accept Reservation
                                                        </button>
                                                        <button type="submit"
                                                                name="cancel" value="true"
                                                                class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded">
                                                            Cancel Reservation
                                                        </button>
                                                    </div>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr
                                        class="bg-gray-50 dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-900 text-gray-700 dark:text-gray-400">
                                        List is Empty
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                            <div class="my-12 flex justify-center">
                                {{ $reservations->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.0/dist/alpine.min.js" defer></script>

<script src="{{ url('/js/dashboard.js') }}"></script>
<script src="{{ url('/js/reservationRequest.js') }}"></script>
