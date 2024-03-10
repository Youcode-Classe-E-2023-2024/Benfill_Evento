<div class="p-6 w-full flex justify-center items-center">
    <h1 class="text-blue-900 font-bold text-[30px]">Unveiling the Magic: Details for the '{{$event->title  }}'
        Experience</h1>
</div>
@dd($event->validation)
<div class="flex flex-wrap md h-screen my-6 pr-6 border-gray-200 border-b-2">
    <div class="bg-white w-full md:w-1/2 h-screen">
        <div class="mx-32 border-2 bg-blueGray-900 flex px-6 flex-col justify-center">
            <div class="flex w-full justify-center mt-6">
                <button
                    class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-cyan-500 to-blue-500 group-hover:from-cyan-500 group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-cyan-200 dark:focus:ring-cyan-800">
                <span
                    class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                    {{$event->category->category}}
                </span>
                </button>
            </div>
            @if($event->validation != 'auto')
                <div class="flex w-full justify-center mt-6">
                <span
                    class="inline-flex items-center m-2 px-3 py-1 bg-yellow-200 hover:bg-yellow-300 rounded-full text-sm font-semibold text-yellow-600">
                <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path
                        d="M0 0h24v24H0V0z"
                        fill="none"/><path
                        d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm3.5-9c.83 0 1.5-.67 1.5-1.5S16.33 8 15.5 8 14 8.67 14 9.5s.67 1.5 1.5 1.5zm-7 0c.83 0 1.5-.67 1.5-1.5S9.33 8 8.5 8 7 8.67 7 9.5 7.67 11 8.5 11zm3.5 6.5c2.33 0 4.31-1.46 5.11-3.5H6.89c.8 2.04 2.78 3.5 5.11 3.5z"/></svg>
                <span class="ml-1">
                  Require Confirmation
                </span>
              </span>
                </div>
            @endif
            <h1 class="text-6xl font-bold text-center mt-16">{{$event['title']}}</h1>

            <h5 class="mt-6 text-center text-red-500 font-bold text-[30px]">Quickly!! Buy your tickets</h5>

            <!-- country region island -->
            <div class="flex flex-col mt-16 font-light text-gray-500">
                <div class="pr-4">
                    <p class="text-2xl text-center text-gray-900 font-semibold pt-2">
                        In {{$event->location->location}}</p>
                </div>
                <div class="pr-4">
                    <p class="text-l text-gray-900 text-center font-semibold pt-2">
                        At {{convertTimeFormat($event->date, "d")}}</p>
                </div>
                <div class="pr-4 mt-6">
                    <p class="text-2xl text-gray-900 text-center font-semibold pt-2">{{$event->price}} MAD</p>
                </div>
                <div class="pr-4 mt-6">
                    <p class="text-2xl text-gray-900 text-center font-semibold pt-2"><span
                            class="@if($event->places <= 10) text-red-500 @else text-green-500 @endif">{{$event->places}}</span>
                        Available Places</p>
                </div>
            </div>
            @if($event->places !== 0)
                <a href="{{route('reserve', $event->slug)}}"
                   class="bg-green-500 py-6 text-center mb-6 text-white border-green-700 uppercase mt-5 text-sm font-semibold hover:underline">
                    buy now!
                </a>
            @else
                <h3 class="text-center font-bold text-red-500">Sold Out</h3>
                <button
                    type="button"
                    class="cursor-not-allowed bg-gray-500 py-6 text-center mb-6 text-white border-green-700 uppercase mt-5 text-sm font-semibold hover:underline">
                    buy now!
                </button>
            @endif
        </div>
    </div>
    <div class="bg-red-600 w-full md:w-1/2 h-[50vh]">
        <img
            src="{{getPicUrl($event['picture'], '')}}"
            class="h-screen w-full"
            alt=""
        />
    </div>
</div>
<div class="mb-[100px] mt-32 px-20">
    <div>
        <h2 class="font-bold pb-6">Description</h2>
        <hr class="my-6">
    </div>
    <div>
        <p>
            {{$event->description}}
        </p>
    </div>
</div>

<div class="flex flex-col justify-center items-center w-full">
    <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse mb-6">
        <h1 class="self-center text-2xl text-blue-500 font-semibold whitespace-nowrap logo">Evento</h1>
    </a>
    <h1 class="font-bold">Other Events</h1>
</div>
