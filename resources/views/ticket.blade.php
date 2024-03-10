<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ticket</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/charts.css/dist/charts.min.css">
    <link rel="stylesheet" href="{{ url('/css/ticketBooking.css') }}">
    <link
        href="https://fonts.googleapis.com/icon?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Round|Material+Icons+Sharp|Material+Icons+Two+Tone"
        rel="stylesheet"
    />
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet"
    />
</head>
<body>
<main>
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
    <div class="ticket">
        <div class="ticket--start">
            <img src="https://i.ibb.co/W3cK42J/image-1.png"/>
        </div>
        <div class="ticket--center">
            <div class="ticket--center--row">
                <div class="ticket--center--col">
                    <span>Your ticket for</span>
                    <strong>{{$event->title}}</strong>
                </div>
            </div>
            <div class="ticket--center--row">
                <div class="ticket--center--col">
                    <span class="ticket--info--title">Date and time</span>
                    <span class="ticket--info--subtitle">{{convertTimeFormat($event->date, 'd')}}</span>
                </div>
                <div class="ticket--center--col">
                    <span class="ticket--info--title">Location</span>
                    <span class="ticket--info--subtitle">{{$event->location->location}}</span>
                </div>
            </div>
            <div class="ticket--center--row">
                <div class="ticket--center--col">
                    <span class="ticket--info--title">Ticket type</span>
                    <span class="ticket--info--content">{{$event->category->category}}</span>
                </div>
                <div class="ticket--center--col">
                    <span class="ticket--info--title">Order info</span>
                    <span
                        class="ticket--info--content">Order #{{Str::upper(Str::random(4))}}. Ordered By {{$ticket->user->name}}</span>
                </div>
            </div>
        </div>
        <div class="ticket--end">
            <div>
                    <?xml version = "1.0" encoding = "UTF-8"?>
                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                         width="100" height="100" viewBox="0 0 100 100">
                        <rect x="0" y="0" width="100" height="100"
                              fill="#ffffff"/>
                        <g transform="scale(4)">
                            <g transform="translate(0,0)">
                                <path fill-rule="evenodd" d="M10
0L10 1L9 1L9 2L8 2L8 3L9 3L9 5L10 5L10 7L11 7L11 8L12 8L12 9L11 9L11 10L10 10L10 9L9 9L9 6L8
6L8 8L4 8L4 9L3 9L3 8L0 8L0 9L2 9L2 12L0 12L0 13L3 13L3 12L4 12L4 14L5 14L5 15L4 15L4 17L8
17L8 21L9 21L9 22L8 22L8 25L10 25L10 24L12 24L12 25L13 25L13 24L12 24L12 23L10 23L10 22L12
22L12 20L14 20L14 22L13 22L13 23L14 23L14 22L16 22L16 23L15 23L15 25L21 25L21 24L19 24L19
23L21 23L21 21L22 21L22 20L21 20L21 18L22 18L22 19L23 19L23 21L25 21L25 20L24 20L24 19L25
19L25 18L22 18L22 17L21 17L21 16L22 16L22 15L25 15L25 12L23 12L23 13L24 13L24 14L22 14L22
13L21 13L21 14L19 14L19 13L20 13L20 11L25 11L25 9L23 9L23 8L22 8L22 9L21 9L21 10L20 10L20
11L18 11L18 10L19 10L19 8L16 8L16 7L17 7L17 6L16 6L16 3L17 3L17 2L16 2L16 0L14 0L14 1L13
1L13 2L15 2L15 3L14 3L14 5L13 5L13 3L12 3L12 2L11 2L11 3L12 3L12 5L10 5L10 3L9 3L9 2L10 2L10
1L11 1L11 0ZM14 5L14 6L13 6L13 7L12 7L12 6L11 6L11 7L12 7L12 8L13 8L13 7L14 7L14 6L15 6L15
7L16 7L16 6L15 6L15 5ZM14 8L14 9L15 9L15 10L13 10L13 11L14 11L14 12L12 12L12 11L11 11L11
12L12 12L12 14L9 14L9 13L10 13L10 12L8 12L8 14L9 14L9 19L10 19L10 20L9 20L9 21L11 21L11
20L12 20L12 19L10 19L10 15L12 15L12 16L11 16L11 17L12 17L12 16L13 16L13 17L14 17L14 18L13
18L13 19L14 19L14 18L16 18L16 16L15 16L15 15L18 15L18 13L17 13L17 12L18 12L18 11L17 11L17
9L16 9L16 8ZM5 9L5 10L3 10L3 11L4 11L4 12L5 12L5 14L7 14L7 13L6 13L6 12L7 12L7 11L8 11L8
9ZM6 10L6 11L7 11L7 10ZM9 10L9 11L10 11L10 10ZM14 12L14 13L15 13L15 12ZM16 13L16 14L17
14L17 13ZM0 14L0 15L1 15L1 16L0 16L0 17L1 17L1 16L3 16L3 14L2 14L2 15L1 15L1 14ZM13 14L13
15L14 15L14 14ZM6 15L6 16L8 16L8 15ZM19 15L19 16L20 16L20 15ZM24 16L24 17L25 17L25
16ZM17 17L17 20L20 20L20 17ZM18 18L18 19L19 19L19 18ZM15 19L15 21L16 21L16 19ZM17 21L17
23L19 23L19 21ZM22 22L22 23L23 23L23 25L25 25L25 24L24 24L24 23L25 23L25 22L24 22L24 23L23
23L23 22ZM9 23L9 24L10 24L10 23ZM0 0L0 7L7 7L7 0ZM1 1L1 6L6 6L6 1ZM2 2L2 5L5 5L5 2ZM18
0L18 7L25 7L25 0ZM19 1L19 6L24 6L24 1ZM20 2L20 5L23 5L23 2ZM0 18L0 25L7 25L7 18ZM1 19L1
24L6 24L6 19ZM2 20L2 23L5 23L5 20Z" fill="#000000"/>
                            </g>
                        </g>
                    </svg>
            </div>
            <div>
                <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
                    <h1 class="self-center text-2xl text-white font-semibold whitespace-nowrap logo">Evento</h1>
                </a>
            </div>


        </div>
    </div>

</main>
</body>
</html>
