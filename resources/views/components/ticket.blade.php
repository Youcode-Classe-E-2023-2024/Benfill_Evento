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
                <span class="ticket--info--content">{{convertTimeFormat($event->date, 't')}}</span>
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
                <span class="ticket--info--content">Order #{{Str::upper(Str::random(4))}}. Ordered By {{$ticket->user->name}}</span>
            </div>
        </div>
    </div>
    <div class="ticket--end">
        <div>{{$qr}}</div>
        <div>
            <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
                <h1 class="self-center text-2xl text-white font-semibold whitespace-nowrap logo">Evento</h1>
            </a>
        </div>


    </div>
</div>
