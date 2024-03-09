@extends('layouts.main')

@section('content')
    <div class="flex flex-col items-center justify-center w-full">
        <h1 class="p-12">{{$status}}</h1>
        <div class="flex justify-center mb-12">
            @if(isset($qr))
                <x-ticket :qr="$qr" :ticket="$ticket" :event="$event"/>
            @endif
        </div>

        <div class="flex">
            @if(isset($qr))
                <form action="/ticket/download" method="post">
                    @csrf
                    <input type="hidden" name="ticketId" value="{{$ticket->id}}">
                    <button
                        class="text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                        Download Ticket
                    </button>
                </form>
            @endif
            <a href="/"
               class="text-gray-900 bg-gradient-to-r from-teal-200 to-lime-200 hover:bg-gradient-to-l hover:from-teal-200 hover:to-lime-200 focus:ring-4 focus:outline-none focus:ring-lime-200 dark:focus:ring-teal-700 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                Go Home
            </a>
        </div>
    </div>

@endsection
