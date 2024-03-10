@extends('layouts.main')

@section('content')
    <style>
        [aria-current] .page-link {
            background-color: red !important;
        }

        [rel='prev'], [rel='next'] {
            background-color: rgb(34 197 94 / var(--tw-bg-opacity)) !important;
        }

        .pagination > li :not([rel='prev'],[rel='next'],[aria-current] .page-link) {
            background-color: green !important;
        }
    </style>
    @if(count($reservations) === 0)
        <div class="flex w-full justify-center my-10">
            <h1 class="font-bold">List is Empty</h1>
        </div>
    @endif
    <div id="event-list" class="w-full overflow-hidden rounded-lg shadow-xs p-12 px-[100px]">
        <button
            id="event-list-btn"
            class="relative middle none center rounded-lg bg-gray-500 mb-10 py-3 px-6 font-sans text-xs font-bold uppercase text-white shadow-md shadow-red-500/20 transition-all hover:shadow-lg hover:shadow-red-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                                <span class="inline-block">
                                    My Reservations List
                                </span>

        </button>
        <div class="w-full overflow-x-auto rounded-lg">
            <table class="w-full p-32">
                <thead>
                <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50 ">
                    <th class="px-4 py-3">Event Title</th>
                    <th class="px-4 py-3">Category</th>
                    <th class="px-4 py-3">Location</th>
                    <th class="px-4 py-3">Guest</th>
                    <th class="px-4 py-3">Price</th>
                    <th class="px-4 py-3">Event Date</th>
                    <th class="px-4 py-3">Reservation Status</th>
                    <th class="px-4 py-3 text-center">Tickets</th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y">
                @if (isset($reservations))
                    @foreach ($reservations as $reservation)
                        <tr class="bg-gray-50 hover:bg-gray-100 text-gray-700">
                            <td class="px-4 py-3 text-sm">{{ $reservation->event->title }}</td>
                            <td class="px-4 py-3 text-sm">{{ $reservation->event['category']['category'] }}</td>
                            <td class="px-4 py-3 text-sm">{{ $reservation->event['location']['location'] }}</td>
                            <td class="px-4 py-3 text-sm">{{ $reservation->user->name }}</td>
                            <td class="px-4 py-3 text-sm">{{ $reservation->event->price }}</td>
                            <td class="px-4 py-3 text-sm">{{ convertTimeFormat($reservation->event->date, 'd') }}</td>
                            <td class="px-4 py-3 text-sm">{{ $reservation->status }}</td>
                            <td class="px-4 py-3 text-xs text-center">
                                @if($reservation->status !== 'unconfirmed')
                                    <a href="/tickets/{{$reservation->id}}" class=" bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded">
                                        See Ticket
                                    </a>
                                @else
                                    <h3 class="text-center text-red-500 font-bold">Is not Confirmed Yet </h3>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr class="bg-gray-50 hover:bg-gray-100 text-gray-700">
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


    <script>
        // Initialization for ES Users
        import {
            Ripple,
            initTWE,
        } from "tw-elements";

        initTWE({Ripple});
    </script>
@endsection
