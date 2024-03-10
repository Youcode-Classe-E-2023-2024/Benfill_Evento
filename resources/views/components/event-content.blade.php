<div class="p-6 w-full flex justify-center items-center">
    <h1 class="text-blue-900 font-bold text-[30px]">Unveiling the Magic: Details for the '{{$event->title  }}'
        Experience</h1>
</div>
<div class="flex flex-wrap md h-screen mt-6 pr-6 border-gray-200 border-b-2">
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
            <h1 class="text-6xl font-bold mt-16">{{$event['title']}}</h1>

            <h5 class="mt-6">Quickly!! Buy your tickets</h5>

            <!-- country region island -->
            <div class="flex mt-16 font-light text-gray-500">
                <div class="pr-4">
                    <span class="uppercase">Country</span>
                    <p class="text-2xl text-gray-900 font-semibold pt-2">Japan</p>
                </div>
                <div class="pr-4">
                    <span class="uppercase">Region</span>
                    <p class="text-2xl text-gray-900 font-semibold pt-2">Kanto</p>
                </div>
                <div class="pr-4">
                    <span class="uppercase">island</span>
                    <p class="text-2xl text-gray-900 font-semibold pt-2">Honshu</p>
                </div>
            </div>

            <!-- description -->
            <div
                class="description w-full sm: md:w-2/3 mt-16 text-gray-500 text-sm"
            >
                {{$event['description']}}
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
<div class="mb-[100px] mt-12 px-20">
    <h2>Description</h2>
    <div>
        <p>
            {{$event->description}}
        </p>
    </div>
</div>

<div class="flex justify-center items-center w-full">
    <h1>Other Events</h1>
</div>
