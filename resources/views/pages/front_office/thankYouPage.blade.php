@extends('layouts.main')

@section('content')
    <style>
        .logo {
            font-family: "Dancing Script", cursive;
            font-optical-sizing: auto;
            font-weight: 700;
            font-style: normal;
            font-size: 39px;
        }

        :root {
            --primary: #4872b0;
            --grey: #E0E0E0;
        }

        .ticket {
            display: flex;
            font-family: Roboto;
            margin: 16px;
            border: 1px solid var(--grey);
            position: relative;
        }

        .ticket:before,
        .ticket:after {
            content: '';
            width: 32px;
            height: 32px;
            background-color: #fff;
            border: 1px solid var(--grey);
            position: absolute;
            border-top-color: transparent;
            border-left-color: transparent;
            border-radius: 50%;
        }

        .ticket:before {
            transform: rotate(-45deg);
            left: -18px;
            top: 50%;
            margin-top: -16px;
        }

        .ticket:after {
            transform: rotate(135deg);
            right: -18px;
            top: 50%;
            margin-top: -16px;
        }

        .ticket--start:before,
        .ticket--start:after {
            border-right-color: transparent;
        }

        .ticket--start:before {
            top: -2px;
        }

        .ticket--start:after {
            top: 100%;
        }

        .ticket--start > img {
            display: block;
            padding: 24px;
            height: 270px;
        }

        .ticket--start {
            position: relative;
            border-right: 1px dashed var(--grey);
        }

        .ticket--center {
            padding: 24px;
            flex: 1;
        }

        .ticket--center--row {
            display: flex;
        }

        .ticket--center--row:not(:last-child) {
            padding-bottom: 48px;
        }

        .ticket--center--row:first-child span {
            color: var(--primary);
            text-transform: uppercase;
            line-height: 24px;
            font-size: 13px;
            font-weight: 500;
        }

        .ticket--center--row:first-child strong {
            font-size: 20px;
            font-weight: 400;
            text-transform: uppercase;
        }

        .ticket--center--col {
            display: flex;
            flex: 1;
            width: 50%;
            box-sizing: border-box;
        }

        .ticket--center--col:not(:last-child) {
            padding-right: 16px;
        }

        .ticket--end {
            padding: 24px;
            background-color: var(--primary);
            display: flex;
            flex-direction: column;
            position: relative;
        }

        .ticket--end:before,
        .ticket--end:after {
            content: '';
            width: 32px;
            height: 32px;
            background-color: #fff;
            border: 1px solid var(--grey);
            position: absolute;
            border-radius: 50%;
        }

        .ticket--end:before {
            transform: rotate(-45deg);
            right: -18px;
            top: -2px;
            margin-top: -16px;
        }

        .ticket--end:after {
            transform: rotate(-45deg);
            right: -18px;
            top: 100%;
            margin-top: -16px;
        }

        .ticket--end > div:first-child {
            flex: 1;
        }

        .ticket--end > div:first-child > img {
            width: 128px;
            padding: 4px;
            background-color: #fff;
        }

        .ticket--end > div:last-child > img {
            display: block;
            margin: 0 auto;
            filter: brightness(0) invert(1);
            opacity: 0.64;
        }

        .ticket--info--title {
            text-transform: uppercase;
            color: #757575;
            font-size: 13px;
            line-height: 24px;
            font-weight: 600;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .ticket--info--subtitle {
            font-size: 16px;
            line-height: 24px;
            font-weight: 500;
            color: var(--primary);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .ticket--info--content {
            font-size: 13px;
            line-height: 24px;
            font-weight: 500;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

    </style>

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
