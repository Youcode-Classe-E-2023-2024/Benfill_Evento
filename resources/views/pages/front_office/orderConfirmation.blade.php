@extends('layouts.main')

@section('content')
    <style>
        .fontE {
            font-family: "Dancing Script", cursive;
        }

        .title {
            font-optical-sizing: auto;
            font-weight: 700;
            font-style: normal;
            font-size: 25px;
        }
    </style>
    <div class="flex flex-col items-center border-b bg-white py-4 sm:flex-row sm:px-10 lg:px-20 xl:px-32">
        <div class="mr-12">
            <h1 class="m-6 mr-6 fontE title">Ready for an unforgettable experience? <br><span class="text-blue-500">Click 'Confirm Purchase' and let the excitement begin! 🎉 #EventoThrills"</span>
            </h1>
        </div>
        <div class="mt-4 py-2 text-xs sm:mt-0 sm:ml-auto sm:text-base">
            <div class="relative">
                <ul class="relative flex w-full items-center justify-between space-x-2 sm:space-x-4">
                    <li class="flex items-center space-x-3 text-left sm:space-x-4">
                        <a class="flex h-6 w-6 items-center justify-center rounded-full bg-emerald-200 text-xs font-semibold text-emerald-700"
                           href="#"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                            </svg
                            >
                        </a>
                        <span class="font-semibold text-gray-900">Reserve</span>
                    </li>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                    </svg>
                    <li class="flex items-center space-x-3 text-left sm:space-x-4">
                        <a class="flex h-6 w-6 items-center justify-center rounded-full bg-gray-600 text-xs font-semibold text-white ring ring-gray-600 ring-offset-2"
                           href="#">2</a>
                        <span class="font-semibold text-gray-900">Pay</span>
                    </li>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                    </svg>
                    <li class="flex items-center space-x-3 text-left sm:space-x-4">
                        <a class="flex h-6 w-6 items-center justify-center rounded-full bg-gray-400 text-xs font-semibold text-white"
                           href="#">3</a>
                        <span class="font-semibold text-gray-500">Get Your Ticket!</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="mb-12 grid sm:px-10 lg:grid-cols-2 lg:px-20 xl:px-32">
        <div class="px-4 pt-8">
            <p class="text-xl font-medium">Order Summary</p>
            <p class="text-gray-400">Check your Reservation. And select a suitable paying method.</p>
            <div class="mt-8 space-y-3 rounded-lg border bg-white px-2 py-4 sm:px-6">
                <div class="flex flex-col rounded-lg bg-white sm:flex-row">
                    <img class="m-2 h-24 w-28 rounded-md border object-cover object-center"
                         src="{{getPicUrl($event['picture'], '')}}" alt=""/>
                    <div class="flex w-full flex-col px-4 py-4">
                        <span class="font-semibold">{{$event->title}}</span>
                        <span class="float-right text-gray-400">{{$event->location->location}}</span>
                        <p class="text-lg font-bold">{{$event->price}} MAD</p>
                    </div>
                </div>
            </div>
            <p class="mt-8 text-lg font-medium">Paying Methods</p>
            <div class="mt-5 grid gap-6">
                <div class="relative">
                    <input class="peer hidden" value="cash" id="radio_2" type="radio" name="radio" checked/>
                    <span
                        class="peer-checked:border-gray-700 absolute right-4 top-1/2 box-content block h-3 w-3 -translate-y-1/2 rounded-full border-8 border-gray-300 bg-white"></span>
                    <label
                        class="peer-checked:border-2 peer-checked:border-gray-700 peer-checked:bg-gray-50 flex cursor-pointer select-none rounded-lg border border-gray-300 p-4"
                        for="radio_2">
                        <img class="w-14 object-contain" src="{{url('storage/pictures/cash.png')}}" alt=""/>
                        <div class="ml-5">
                            <span class="mt-2 font-semibold">Pay Cash</span>
                            <p class="text-slate-500 text-sm leading-6">Delivery(PDF): Instant</p>
                        </div>
                    </label>
                </div>
            </div>
        </div>
        <form action="{{route('reserve.store')}}" method="post">
            @csrf
            <input type="hidden" name="eventID" value="{{$event->id}}">

            <div class="mt-10 bg-gray-50 px-4 pt-8 lg:mt-0">
                <p class="text-xl font-medium">Payment Details</p>
                <p class="text-gray-400">Complete your order by providing your payment details.</p>
                <div class="">
                    <!-- Total -->
                    <div class="mt-6 border-t border-b py-2">
                        <div class="flex items-center justify-between">
                            <p class="text-sm font-medium text-gray-900">Subtotal</p>
                            <p class="font-semibold text-gray-900">{{$event->price}} MAD</p>
                        </div>
                        <div class="flex items-center justify-between">
                            <p class="text-sm font-medium text-gray-900">Guests</p>
                            <p class="font-semibold text-gray-900">1</p>
                        </div>
                    </div>
                    <div class="mt-6 flex items-center justify-between">
                        <p class="text-sm font-medium text-gray-900">Total</p>
                        <p class="text-2xl font-semibold text-gray-900">{{$event->price}} MAD</p>
                    </div>
                </div>
                @if($event->places !== 0)
                    <button type="submit"
                            class="mt-4 mb-8 w-full rounded-md bg-gray-900 px-6 py-3 font-medium text-white">Confirm
                        Order
                    </button>
                @else
                    <h3 class="text-center text-red-500 font-bold">Sold Out</h3>
                    <button type="button"
                            class="cursor-not-allowed mt-4 mb-8 w-full rounded-md bg-gray-300 px-6 py-3 font-medium text-white">Confirm
                        Order
                    </button>
                @endif

            </div>
        </form>
    </div>

@endsection
