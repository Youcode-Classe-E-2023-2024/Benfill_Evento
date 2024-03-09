<div class="flex flex-wrap md items-center h-screen m-6 pr-6 border-gray-200 border-b-2">
    <div class="bg-white w-full md:w-1/2 h-screen">
        <div class="mx-32">
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

            <button class="bg-green-500 p-6 text-white border-green-700 uppercase mt-5 text-sm font-semibold hover:underline">
                buy now!
            </button>
        </div>
    </div>
    <div class="bg-red-600 w-full md:w-1/2 h-screen">
        <img
            src="{{getPicUrl($event['picture'], '')}}"
            class="h-screen w-full"
            alt=""
        />
    </div>
</div>
